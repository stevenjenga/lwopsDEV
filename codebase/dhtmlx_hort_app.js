var myLayout, myTabbar,produceGrid, myMenu, myGrid, myGridCalendar, payPeriodGrid,  myDataProcessor, payPeriodDataProcessor, dhxComponent, myCombo, arrayOfRowIds, excelFileTitle, excelFileName;

var monthNames = ["January", "February", "March", "April", "May", "June",
					"July", "August", "September", "October", "November", "December"
				];
				
function isNumeric(n) {}

function get_currentDate_by_obj(d){
/*
#@ d given date object
return an object that content both normal date format and Named date format

*/

	var now = new Date(d);
	var day = ("0" + now.getDate()).slice(-2);
	var month =  now.getMonth()+1;
	var month3 =  now.getMonth();
	console.log(month);
	var month2 = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = (month)+"/"+(day)+"/"+now.getFullYear();
	var normalDate= now.getFullYear()+"/"+month2+"/"+day;
	var namedDate = monthNames[month3]+" "+day+" "+now.getFullYear();
	return {'date1':normalDate,'date2':namedDate};
}


function get_currentDate_Arr(){
	/*

	return an object that content current day, month and year

	*/

	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = (now.getMonth() + 1);
	var month2 = now.getMonth();
	var today = (month)+"/"+(day)+"/"+now.getFullYear();
	return {'day':day,'month':month,'year':now.getFullYear(),'actualMonth':month2};
}


function get_currentDate(){
	/*

	return current date

	*/

	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = (month)+"/"+(day)+"/"+now.getFullYear();
	return today;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	HELPERS get_otherWorkPayroll_data_xml.php
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function exportToExcel(){
	console.log("codebase/grid-excel-php/generate.php?filename="+excelFileName);
	myGrid.toExcel("codebase/grid-excel-php/generate.php?filename="+excelFileName);
}

function initMyGrid(getDataXmlFile){
	myGrid = myLayout.cells('a').attachGrid('gridbox');
	myGrid.setImagePath("skins/web/imgs/dhxgrid_web/");
	myGrid.setDateFormat("%M.%d.%Y");
	myGrid.enableAutoWidth(true);
	myGrid.enableEditEvents(true,false, true);
	console.log("getDataXmlFile => "+getDataXmlFile);
	myGrid.load("functions/"+getDataXmlFile);
	console.log("grid loaded...");
	return myGrid;
}

function produceSpecsGrid(){
	myGrid = initMyGrid("get_hort_produce_data_xml.php");

	myDataProcessor = new dataProcessor("functions/update_hort_produce_data.php"); 
	myDataProcessor.setVerificator(0,not_empty);
	myDataProcessor.setVerificator(1,not_empty);
	myDataProcessor.setVerificator(2,not_empty);
	myDataProcessor.setVerificator(3,not_empty);
	myDataProcessor.setVerificator(4,not_empty);
	myDataProcessor.setVerificator(5,not_empty);
	myDataProcessor.setVerificator(6,not_empty);
	myDataProcessor.attachEvent("onRowMark",function(id){
		if (this.is_invalid(id)=="invalid") 
			return false;
		return true;
	});
	
	myDataProcessor.setTransactionMode("GET", false);
	myDataProcessor.setUpdateMode("off");
	myDataProcessor.init(myGrid);
}

function produceStockGrid(){
	myGrid = initMyGrid("get_hort_produce_stock_data_xml.php");

	myDataProcessor = new dataProcessor("functions/update_hort_produce_stock_data.php"); 
	myDataProcessor.setVerificator(0,not_empty);
	myDataProcessor.setVerificator(1,not_empty);
	myDataProcessor.setVerificator(2,not_empty);
	myDataProcessor.attachEvent("onRowMark",function(id){
		if (this.is_invalid(id)=="invalid") 
			return false;
		return true;
	});
	
	var myCalendar = new dhtmlXCalendarObject("calendarWidget");
	myCalendar.setSensitiveRange("2016-01-01", new Date());
	myCalendar.attachEvent("onClick", function(d){
		document.getElementById("calendarWidget").value=get_currentDate_by_obj(d).date2;	
		myGrid.clearAll();
		myGrid.load("functions/get_hort_produce_stock_data_xml.php?date="+get_currentDate_by_obj(d).date1,function(){  
			myGrid.forEachRow(function(id){ 
			});
		}); 
	});
	
	myCalendar.attachEvent("onHide", function(d){});
	myDataProcessor.setTransactionMode("GET", false);
	myDataProcessor.setUpdateMode("off");
	myDataProcessor.init(myGrid);
}


function plantedCropsGrid(){
	myGrid = initMyGrid("get_hort_crops_data_xml.php");

	myDataProcessor = new dataProcessor("functions/update_hort_crops_data.php"); 
	myDataProcessor.setVerificator(0,not_empty);
	myDataProcessor.setVerificator(1,not_empty);
	myDataProcessor.setVerificator(2,not_empty);
	myDataProcessor.setVerificator(3,not_empty);
	myDataProcessor.setVerificator(4,not_empty);
	myDataProcessor.setVerificator(5,not_empty);
	myDataProcessor.setVerificator(6,not_empty);
	myDataProcessor.attachEvent("onRowMark",function(id){
		if (this.is_invalid(id)=="invalid") 
			return false;
		return true;
	});
	
	myDataProcessor.setTransactionMode("GET", false);
	myDataProcessor.setUpdateMode("off");
	myDataProcessor.init(myGrid);
}

function plantingBedsGrid(){
	myGrid = initMyGrid("get_hort_beds_data_xml.php");

	myDataProcessor = new dataProcessor("functions/update_hort_beds_data.php"); 
	myDataProcessor.setVerificator(0,not_empty);
	myDataProcessor.setVerificator(1,not_empty);
	myDataProcessor.setVerificator(2,not_empty);
	myDataProcessor.setVerificator(3,not_empty);
	myDataProcessor.setVerificator(4,not_empty);
	myDataProcessor.setVerificator(5,not_empty);
	myDataProcessor.setVerificator(6,not_empty);
	myDataProcessor.attachEvent("onRowMark",function(id){
		if (this.is_invalid(id)=="invalid") 
			return false;
		return true;
	});
	
	myDataProcessor.setTransactionMode("GET", false);
	myDataProcessor.setUpdateMode("off");
	myDataProcessor.init(myGrid);
}

function plantNewCropX(row_id, rowIndex){
	console.log('row_id = '+ row_id);
	console.log('rowIndex = '+ rowIndex);
	dateValue = myGrid.cellById(row_id,0).getValue();
	employeeNameValue = myGrid.cellById(row_id,1).getValue();
	employeeOid = myGrid.cellById(row_id,6).getValue();
	attendanceOid = myGrid.cellById(row_id,7).getValue();
	console.log('dateValue = '+ dateValue);
	console.log('employeeNameValue = '+ employeeNameValue);
	console.log('employeeOid = '+ employeeOid);
	console.log('attendanceOid = '+ attendanceOid);	
	myGrid.addRow((new Date()).valueOf(),[dateValue,employeeNameValue,'','','','',employeeOid,attendanceOid],rowIndex);
}

function viewGantt(row_id, rowIndex){
	console.log('row_id = '+ row_id);
	console.log('rowIndex = '+ rowIndex);
	produceBedOid = myGrid.cellById(row_id,12).getValue();
	produceTypeOid = myGrid.cellById(row_id,13).getValue();
	console.log('produceBedOid = '+ produceBedOid);
	console.log('produceTypeOid = '+ produceTypeOid);	
	var myWindow = window.open("hortSchedule.php?ptOid="+produceTypeOid, "", "");
}

function plantNewCrop(row_id, rowIndex){
	var myForm = new dhtmlxForm(containerID,structureAr);//create form(structure below)
	var dp = new dataProcessor("php/data.php");
	dp.init(myForm);
	
	// fill form with data.Where userID is ID or record you want to use to fill the form
	myForm.load("php/data.php?id="+0);

	// create event handler to save data on button click
	// myForm.attachEvent("onButtonClick",function(buttonID){
		// if(buttonID=="my_button"){
			// myForm.save();//no params needed.It uses url that you passed to dataprocessor
		// }
	// })
	
	formData = [
		{type: "settings", position: "label-left", labelWidth: 100, inputWidth: 120},
		{type: "block", inputWidth: "auto", offsetTop: 12, list: [
			{type: "input", label: "Login", value: "p_rossi"},
			{type: "password", label: "Password", value: "123"},
			{type: "checkbox", label: "Remember me", checked: true},
			{type: "button", value: "Proceed", offsetLeft: 70, offsetTop: 14}
		]}
	];
	console.log("Here now");
	myLayout.cells("a").setText('PLANT NEW CROP');
	myForm = myLayout.cells("a").attachForm(formData);
}

function scheduleByDate(){
	console.log("schedule 0...");
	gantt.init("ganttObj");
	gantt.load("functions/get_schedule_data.php");
	console.log("schedule gantt loaded...");
	
	var dp = new gantt.dataProcessor("functions/get_schedule_data.php");
	dp.init(gantt);
	console.log("schedule dp loaded...");
}
function get_currentDate_Arr(){
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = (now.getMonth() + 1);
	var month2 = now.getMonth();
	var today = (month)+"/"+(day)+"/"+now.getFullYear();
	return {'day':day,'month':month,'year':now.getFullYear(),'actualMonth':month2};
}

function setDatePickerDateToToday(){
	var getCurDateArr = get_currentDate_Arr();
	$('#calendarWidget').val(monthNames[getCurDateArr.actualMonth]+" "+getCurDateArr.day+" "+  getCurDateArr.year);					
}

function doOnLoad(){
	myLayout = new dhtmlXLayoutObject({
		parent: "layoutObj",
		pattern: "1C"
	});

	myMenu = myLayout.attachMenu({
		icons_path: "dhtmlxMenu/common/imgs/",
		xml: "dhtmlxMenu/common/dhxmenu_hort.xml",
	});
	
	myLayout.cells("a").setText('PRODUCE SPECIFICATIONS    |    <input type="button" name="produceSpecsUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
	produceSpecsGrid();
	setDatePickerDateToToday();

	myMenu.attachEvent("onClick", function(id, zoneId, cas){

		if(id=="produce_specs"){
			myLayout.cells("a").setText('PRODUCE SPECIFICATIONS    |    <input type="button" name="produceSpecsUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
			produceSpecsGrid();
			setDatePickerDateToToday();			
		}		
		
		else if (id == "produce_stock") {
			myLayout.cells("a").setText('PRODUCE STOCK  |<input id="calendarWidget" type="text" value="" > | <input type="button" name="produceStockUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
			produceStockGrid();
			setDatePickerDateToToday();
		}

		else if (id == "planting_beds") {
			myLayout.cells("a").setText('PLANTING BEDS    |    <input type="button" name="produceStockUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
			plantingBedsGrid();
		}	
		
		else if (id == "scheduled_by_date") {
			myLayout.cells("a").setText('HARVEST SCHEDULE BY DATE');
			scheduleByDate();
		}	

		else if (id == "planted_crops") {
			myLayout.cells("a").setText('HARVEST SCHEDULE BY DATE');
			plantedCropsGrid();
		}

		else if (id == "plant_new_crop") {
			myLayout.cells("a").setText('PLANT NEW CROP');
			plantNewCrop();
		}
		
		else {}
	});
}

function not_empty(value,row_id,column_index){
	if (value=="") {
		myGrid.setCellTextStyle(row_id,column_index,"background-color:red;"); 
		return "Column "+column_index+" cannot be empty!"+"\n";
	}
	return true;
}

function eXcell_viewCropGanttBtn(cell){  
    if (cell){                  
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}   // read-only cell doesn't have edit method

    this.isDisabled = function(){ return true; }
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;     // gets the id of the related row
		var rowIndex=myGrid.getRowIndex(row_id);
		this.setCValue("<input type='button' value='GANTT' onclick='viewGantt("+row_id+","+rowIndex+")'>");
	}
}
eXcell_viewCropGanttBtn.prototype = new eXcell; 

function eXcell_plantNewProduceBtn(cell){  
    if (cell){                  
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}   // read-only cell doesn't have edit method

    this.isDisabled = function(){ return true; }
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;     // gets the id of the related row
		var rowIndex=myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='PLANT NEW' onclick='window.open('hortSchedule.php', '_blank', 'width=100%,height=100%', 'false')'>");
    }
}
eXcell_plantNewProduceBtn.prototype = new eXcell; 

function eXcell_plantProduceBtn(cell){  
    if (cell){                  
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}   // read-only cell doesn't have edit method

    this.isDisabled = function(){ return true; }
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;     // gets the id of the related row
		var rowIndex=myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='PLANT' onclick='plantNewCrop("+row_id+","+rowIndex+")'>");                                      
    }
}
eXcell_plantProduceBtn.prototype = new eXcell; 
			
function two_decimal(num){
	var num= parseFloat(num);
	var n = num.toFixed(2);
	return n;	
}

function two_decimal(num){
	var num= parseFloat(num);
	var n = num.toFixed(2);
	return n;	
}
