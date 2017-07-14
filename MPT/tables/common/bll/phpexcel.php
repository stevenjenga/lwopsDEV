<?php
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	/**
	 * this class is built above PHPExcel API to handle export to excel file
	**/
	class PhpToExcel
	{
		public $obj_phpexcel, $sheet;
		
		public function __construct()
		{
			// initialization excel file settings 
			$this->obj_phpexcel = new PHPExcel();
			
			$this->obj_phpexcel
				->getProperties()
					->setCreator("Smart Pivot Table")
					->setLastModifiedBy("Smart Pivot Table")
					->setTitle("Smart Pivot Table")
					->setSubject("Smart Pivot table Generated excel file")
					->setDescription("Smart Pivot table Generated excel file")
					->setKeywords("Smart Pivot table")
					->setCategory("Smart Pivot table");
			
			$this->obj_phpexcel->setActiveSheetIndex(0);
			
			$this->sheet = $this->obj_phpexcel->getActiveSheet();
			$this->sheet->setTitle('Smart Pivot Table');
		}
		
		private $strLen = array();
		private function getGreaterStrLenInCol($colIndex, $str)
		{
			$len = strlen($str);
			$this->strLen[$colIndex] = (isset($this->strLen[$colIndex]) && $this->strLen[$colIndex] < $len) ? $len : ((isset($this->strLen[$colIndex])) ? $this->strLen[$colIndex] :  -1);
		}
		private function getColWidthFixedStatus($columnIndex) // if(strlen > 20): return false; else: return true;
		{
			if($this->strLen[$columnIndex] > 20)
				return false;
			else
				return true;
		}
		
		// set table header
		public function setTableHeader($headers_array)
		{
			$columnIndex = 1;
			foreach($headers_array as $cell)
			{
				$this->sheet->setCellValueByColumnAndRow($columnIndex, 1, $cell);
				$this->getGreaterStrLenInCol($columnIndex, $cell);
				$columnIndex++;
			}
		}
		
		// set table body
		public function setTableData($tableData_array)
		{
			foreach($tableData_array as $row => $value)
			{
				$row += 2;
				foreach($value as $column => $cell)
				{
					$this->sheet->setCellValueByColumnAndRow($column, $row, $cell);
					$this->getGreaterStrLenInCol($column, $cell);
				}
			}
		}
		
		// set table total
		public function setTableTotal($tableTotals_array)
		{
			$currentRow = $this->sheet->getHighestRow() + 1;
			foreach($tableTotals_array as $column => $cell)
			{
				$this->sheet->setCellValueByColumnAndRow($column, $currentRow, $cell);
				$this->getGreaterStrLenInCol($column, $cell);
			}
		}
		
		// execute and make excel file
		public function execute($location, $color = 'blue')
		{
			$this->set_styles($color);
			
			$objWriter = PHPExcel_IOFactory::createWriter($this->obj_phpexcel, 'Excel2007');
			// $objWriter->save(str_replace('.php', '.xlsx', $location));
			
			// We'll be outputting an excel file
			header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

			// It will be called file.xls
			header('Content-Disposition: attachment; filename=index.xlsx');

			// Write file to the browser
			$objWriter->save('php://output');
			
			$this->obj_phpexcel->disconnectWorksheets();
			unset($this->obj_phpexcel);
		}
		
		// set excel style as blue, default, red or orange
		public function set_styles($color)
		{
			$columnsRowsRange = 'A1:' .
				$this->sheet->getHighestColumn() . $this->sheet->getHighestRow();
			
			$headerRange = 'A1:' . $this->sheet->getHighestColumn() . '1';
			
			$firstColumnRange = 'A1:A' . $this->sheet->getHighestRow();
			
			$totalRowRange = 'B' . $this->sheet->getHighestRow() . ':' .
				$this->sheet->getHighestColumn() . $this->sheet->getHighestRow();
			
			$totalFirstColumnRow = 'A' . $this->sheet->getHighestRow();
			
			// set border to `all cells` / table
			$this->sheet->getStyle($columnsRowsRange)->getBorders()->getAllBorders()
			->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			// set alignment
			$this->sheet->getStyle($columnsRowsRange)->getAlignment()
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			
			$this->sheet->getStyle($columnsRowsRange)->getAlignment()
			->setHORIZONTAL(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// make font larger
			$this->sheet->getStyle($columnsRowsRange)->getFont()->setSize(14);
			$this->sheet->getStyle($headerRange)->getFont()->setBold(true);
			$this->sheet->getStyle($firstColumnRange)->getFont()->setBold(true);
			$this->sheet->getStyle($totalRowRange)->getFont()->setBold(true);
			
			// style: blue, default(black), red, orange
			$colors_array = array(
				// backgrounds color
				'blue_header' => '235f9b',
				'blue_firstColumn' => 'f5f5f5',
				'blue_firstColumnLastRow' => '27b5e5',
				'blue_total' => 'd2d2d2',
				// font color
				'blue_headerFontColor' => array('rgb' => 'FFFFFF'),
				'blue_firstColumnFontColor' => array('rgb' => '012852'),
				'blue_firstColumnLastRowFontColor' => array('rgb' => '012852'),
				'blue_totalFontColor' => array('rgb' => '000000'),
				
				'default_header' => '000000',
				'default_firstColumn' => '3a3a3a',
				'default_firstColumnLastRow' => '707070',
				'default_total' => 'efefef',
				
				'default_headerFontColor' => array('rgb' => 'FFFFFF'),
				'default_firstColumnFontColor' => array('rgb' => 'FFFFFF'),
				'default_firstColumnLastRowFontColor' => array('rgb' => 'FFFFFF'),
				'default_totalFontColor' => array('rgb' => '000000'),
				
				'red_header' => 'b50708',
				'red_firstColumn' => '8d0505',
				'red_firstColumnLastRow' => '8f3334',
				'red_total' => 'c48484',
				
				'red_headerFontColor' => array('rgb' => 'FFFFFF'),
				'red_firstColumnFontColor' => array('rgb' => 'FFFFFF'),
				'red_firstColumnLastRowFontColor' => array('rgb' => 'FFFFFF'),
				'red_totalFontColor' => array('rgb' => '000000'),
				
				'orange_header' => 'e05e08',
				'orange_firstColumn' => 'f5f3f4',
				'orange_firstColumnLastRow' => 'f5c188',
				'orange_total' => 'f5d9b4',
				
				'orange_headerFontColor' => array('rgb' => 'FFFFFF'),
				'orange_firstColumnFontColor' => array('rgb' => 'DF5E08'),
				'orange_firstColumnLastRowFontColor' => array('rgb' => 'DF5E08'),
				'orange_totalFontColor' => array('rgb' => '000000')
			);
			
			// colourize totals row
			$colourize_header = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array(
						'rgb' => $colors_array[$color . '_header'],
					),
				),
				'font' => array(
					'color' => $colors_array[$color . '_headerFontColor']
				),
			);
			$colourize_firstColumn = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array(
						'rgb' => $colors_array[$color . '_firstColumn'],
					),
				),
				'font' => array(
					'color' => $colors_array[$color . '_firstColumnFontColor']
				),
			);
			$colourize_firstColumnLastRow = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array(
						'rgb' => $colors_array[$color . '_firstColumnLastRow'],
					),
				),
				'font' => array(
					'color' => $colors_array[$color . '_firstColumnLastRowFontColor']
				),
			);
			$colourize_total = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array(
						'rgb' => $colors_array[$color . '_total'],
					),
				),
				'font' => array(
					'color' => $colors_array[$color . '_totalFontColor']
				),
			);
			$this->sheet->getStyle($headerRange)->applyFromArray($colourize_header);
			$this->sheet->getStyle($firstColumnRange)->applyFromArray($colourize_firstColumn);
			$this->sheet->getStyle($totalRowRange)->applyFromArray($colourize_total);
			$this->sheet->getStyle($totalFirstColumnRow)->applyFromArray($colourize_firstColumnLastRow);
			

			
			// fit auto size
			$colNumber = PHPExcel_Cell::columnIndexFromString($this->sheet->getHighestColumn());
			for($i = 0; $i < $colNumber; $i++)
			{
				$colString = PHPExcel_Cell::stringFromColumnIndex($i);
				
				if($this->getColWidthFixedStatus($i))
					$this->sheet->getColumnDimension($colString)->setWidth(30);
				else
					$this->sheet->getColumnDimension($colString)->setAutoSize(true);
			}
		}
		
		
	}
	
	$obj_PhpToExcel = new PhpToExcel();