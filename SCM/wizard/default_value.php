<?php
	/*
		for input type text set default value in first parameter 
		>> function input_txt_default_value(your default value, $selectedValue);

	--------------------------------------------------------------------------------------

		for input type checkbox set default value in first parameter ('checked' or '')  
		>> function input_checkbox_default_value(your default value, $selectedValue);

	--------------------------------------------------------------------------------------

		for select set default value in first parameter but choose it from options values
		>> function select_default_value(your default value from options values, $selectedValue, $options);
		here you can increase or decrease options in $options for each select
	*/
	function static_default_value($id, $is_horizontal=false, $is_pie=false, $selectedValue='*scm_static_default_value')
	{

		// General
		if($id === 'graph_title') input_txt_default_value('', $selectedValue);
		else if($id === 'graph_title_position') 
		{
			$options = '
			<option value="top">top</option>
			<option value="bottom">bottom</option>
			<option value="right">right</option>
			<option value="left">left</option>';

			select_default_value('bottom', $selectedValue, $options);
		}
		else if($id === 'graph_title_colour') input_txt_default_value('#000000', $selectedValue);
		
		else if($id === 'width') input_txt_default_value(400, $selectedValue);
		else if($id === 'height') input_txt_default_value(300, $selectedValue);
		else if($id === 'pad_top') input_txt_default_value(10, $selectedValue);
		else if($id === 'pad_bottom') input_txt_default_value(10, $selectedValue);
		else if($id === 'pad_left') input_txt_default_value(10, $selectedValue);
		else if($id === 'pad_right') input_txt_default_value(10, $selectedValue);
		
		else if($id === 'stroke_colour') input_txt_default_value('#000000', $selectedValue);
		else if($id === 'stroke_width') input_txt_default_value(1, $selectedValue);
		else if($id === 'back_colour') input_txt_default_value('#FFFFFF', $selectedValue);
		else if($id === 'back_round') input_txt_default_value(0, $selectedValue);
		else if($id === 'back_stroke_width') input_txt_default_value(1, $selectedValue);
		else if($id === 'back_stroke_colour') input_txt_default_value('#000000', $selectedValue);
		// -----------------------------------------------------
		// legend
		else if($id === 'legend_text_side')
		{
			$options = '
			<option value="left">left</option>
			<option value="right">right</option>';

			select_default_value('right', $selectedValue, $options);
		}
		else if($id === 'legend_draggable')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('true', $selectedValue, $options);
		} 
		else if($id === 'legend_autohide')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		} 

		else if($id === 'legend_title') input_txt_default_value('', $selectedValue);
		else if($id === 'legend_title_colour') input_txt_default_value('#000000', $selectedValue);
		else if($id === 'legend_title_font') 
		{
			$options = '
			<option value="monospace">monospace </option>
			<option value="sans-serif">sans-serif </option>
			<option value="Helvetica">Helvetica </option>
			<option value="Arial">Arial </option>
			<option value="Times">Times </option>
			<option value="Times New Roman">Times New Roman </option>';

			select_default_value('sans-serif', $selectedValue, $options);
		}
		else if($id === 'legend_title_font_size') input_txt_default_value(10, $selectedValue);
		else if($id === 'legend_title_font_weight')
		{
			$options = '
			<option value="normal">normal</option>
			<option value="bold">bold</option>';

			select_default_value('normal', $selectedValue, $options);
		} 
		else if($id === 'legend_position_1')
		{ 
			$options = '
			<option value="inner">inner</option>
			<option value="outer">outer</option>';

			select_default_value('outer', $selectedValue, $options);
		}
		else if($id === 'legend_position_2')
		{
			$options = '
			<option value="top">top</option>
			<option value="bottom">bottom</option>';

			select_default_value('bottom', $selectedValue, $options);
		} 
		else if($id === 'legend_position_3')
		{
			$options = '
			<option value="left">left</option>
			<option value="right">right</option>';

			select_default_value('right', $selectedValue, $options);
		}
		else if($id === 'legend_padding') input_txt_default_value(5, $selectedValue);
		else if($id === 'legend_entry_width') input_txt_default_value(20, $selectedValue);
		else if($id === 'legend_entry_height') input_txt_default_value(20, $selectedValue);
		else if($id === 'legend_font')
		{
			$options = '
			<option value="monospace">monospace </option>
			<option value="sans-serif">sans-serif </option>
			<option value="Helvetica">Helvetica </option>
			<option value="Arial">Arial </option>
			<option value="Times">Times </option>
			<option value="Times New Roman">Times New Roman </option>';

			select_default_value('sans-serif', $selectedValue, $options);
		} 
		else if($id === 'legend_font_size') input_txt_default_value(10, $selectedValue);
		else if($id === 'legend_font_weight')
		{
			$options = '
			<option value="normal">normal</option>
			<option value="bold">bold</option>';

			select_default_value('normal', $selectedValue, $options);
		} 
		else if($id === 'legend_colour') input_txt_default_value('#000000', $selectedValue);
		else if($id === 'legend_back_colour') input_txt_default_value('#FFFFFF', $selectedValue);
		else if($id === 'legend_round') input_txt_default_value(0, $selectedValue);
		else if($id === 'legend_stroke_colour') input_txt_default_value('#000000', $selectedValue);
		else if($id === 'legend_stroke_width') input_txt_default_value(1, $selectedValue);
		else if($id === 'legend_shadow_opacity')
		{
			$options = '
			<option value="0">none</option>
			<option value="0.1">10%</option>
			<option value="0.2">20%</option>
			<option value="0.3">30%</option>
			<option value="0.4">40%</option>
			<option value="0.5">50%</option>
			<option value="0.6">60%</option>
			<option value="0.7">70%</option>
			<option value="0.8">80%</option>
			<option value="0.9">90%</option>
			<option value="1">100%</option>';

			select_default_value('0.6', $selectedValue, $options);
		}
		// ------------------------------------------------
		// tooltip
		else if($id === 'show_tooltips')
		{ // if you need to make it unchecked set it '' instead of 'checked'
			input_checkbox_default_value('checked', $selectedValue);
		} 
		else if($id === 'tooltip_font')
		{
			$options = '
			<option value="monospace">monospace </option>
			<option value="sans-serif">sans-serif </option>
			<option value="Helvetica">Helvetica </option>
			<option value="Arial">Arial </option>
			<option value="Times">Times </option>
			<option value="Times New Roman">Times New Roman </option>';

			select_default_value('sans-serif', $selectedValue, $options);
		} 
		else if($id === 'tooltip_font_size') input_txt_default_value(10, $selectedValue);
		else if($id === 'tooltip_font_weight')
		{
			$options = '
			<option value="normal">normal</option>
			<option value="bold">bold</option>';

			select_default_value('normal', $selectedValue, $options);
		}
		else if($id === 'tooltip_colour') input_txt_default_value('#000000', $selectedValue);
		else if($id === 'tooltip_stroke_width') input_txt_default_value(1, $selectedValue);
		else if($id === 'tooltip_round') input_txt_default_value(0, $selectedValue);
		else if($id === 'tooltip_back_colour') input_txt_default_value('#FFFFCC', $selectedValue);
		else if($id === 'tooltip_padding') input_txt_default_value(3, $selectedValue);
		else if($id === 'tooltip_shadow_opacity') 
		{
			$options = '
			<option value="0">none</option>
			<option value="0.1">10%</option>
			<option value="0.2">20%</option>
			<option value="0.3">30%</option>
			<option value="0.4">40%</option>
			<option value="0.5">50%</option>
			<option value="0.6">60%</option>
			<option value="0.7">70%</option>
			<option value="0.8">80%</option>
			<option value="0.9">90%</option>
			<option value="1">100%</option>';

			select_default_value('0.3', $selectedValue, $options);
		} 
		// -------------------------------------------
		// Axes
		// label
		else if($id === 'label_v') input_txt_default_value('', $selectedValue);
		else if($id === 'label_h') input_txt_default_value('', $selectedValue);
		else if($id === 'label_colour' && $is_pie == false) input_txt_default_value('#000000', $selectedValue);
		else if($id === 'label_font' && $is_pie == false) 
		{
			$options = '
			<option value="monospace">monospace </option>
			<option value="sans-serif">sans-serif </option>
			<option value="Helvetica">Helvetica </option>
			<option value="Arial">Arial </option>
			<option value="Times">Times </option>
			<option value="Times New Roman">Times New Roman </option>';

			select_default_value('sans-serif', $selectedValue, $options);
		} 
		else if($id === 'label_font_size' && $is_pie == false) input_txt_default_value(10, $selectedValue);
		else if($id === 'label_font_weight' && $is_pie == false) 
		{
			$options = '
			<option value="normal">normal</option>
			<option value="bold">bold</option>';

			select_default_value('normal', $selectedValue, $options);
		}
		// Axes properties
		else if($id === 'show_divisions')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('true', $selectedValue, $options);
		}
		else if($id === 'show_subdivisions')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		}
		else if($id === 'axis_colour') input_txt_default_value('#000000', $selectedValue);
		else if($id === 'axis_stroke_width') input_txt_default_value(2, $selectedValue);
		else if($id === 'axis_text_angle_v') input_txt_default_value(0, $selectedValue);
		else if($id === 'axis_text_angle_h') input_txt_default_value(-45, $selectedValue);
		else if($id === 'axis_font')
		{
			$options = '
			<option value="monospace">monospace </option>
			<option value="sans-serif">sans-serif </option>
			<option value="Helvetica">Helvetica </option>
			<option value="Arial">Arial </option>
			<option value="Times">Times </option>
			<option value="Times New Roman">Times New Roman </option>';

			select_default_value('Arial', $selectedValue, $options);
		} 
		else if($id === 'axis_font_size') input_txt_default_value(11, $selectedValue);
		else if($id === 'axis_text_position') 
		{
			$options = '
			<option value="outside">outside graph</option>
			<option value="inside">inside graph</option>';

			select_default_value('outside', $selectedValue, $options);
		}
		else if($id === 'axis_text_colour') input_txt_default_value('#000000', $selectedValue);
		
		// grid properties
		else if($id === 'show_grid_v')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('true', $selectedValue, $options);
		} 
		else if($id === 'show_grid_h')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('true', $selectedValue, $options);
		}
		else if($id === 'grid_colour') input_txt_default_value('#DCDCDC', $selectedValue);
		// --------------------------------------------
		// scale (general_grid_based.php, common_bar_setting.php, common_line_scatter_setting.php)
		// is_horizontal = false
		else if($id === 'axis_min_v' && $is_horizontal == false) input_txt_default_value(0, $selectedValue);
		else if($id === 'axis_max_v' && $is_horizontal == false) input_txt_default_value(0, $selectedValue);
		else if($id === 'grid_division_v' && $is_horizontal == false) input_txt_default_value(20, $selectedValue);
		else if($id === 'subdivision_v' && $is_horizontal == false) input_txt_default_value(5, $selectedValue);
		// is_horizontal = true
		else if($id === 'axis_min_v' && $is_horizontal == true) input_txt_default_value(0, $selectedValue);
		else if($id === 'axis_max_v' && $is_horizontal == true) input_txt_default_value(0, $selectedValue);
		else if($id === 'grid_division_v' && $is_horizontal == true) input_txt_default_value(1, $selectedValue);
		else if($id === 'subdivision_v' && $is_horizontal == true) input_txt_default_value(0.5, $selectedValue);
		

		// is_horizontal = false
		else if($id === 'axis_min_h' && $is_horizontal == false) input_txt_default_value(0, $selectedValue);
		else if($id === 'axis_max_h' && $is_horizontal == false) input_txt_default_value(0, $selectedValue);
		else if($id === 'grid_division_h' && $is_horizontal == false) input_txt_default_value(1, $selectedValue);
		else if($id === 'subdivision_h' && $is_horizontal == false) input_txt_default_value(0.5, $selectedValue);
		// is_horizontal = true
		else if($id === 'axis_min_h' && $is_horizontal == true) input_txt_default_value(0, $selectedValue);
		else if($id === 'axis_max_h' && $is_horizontal == true) input_txt_default_value(0, $selectedValue);
		else if($id === 'grid_division_h' && $is_horizontal == true) input_txt_default_value(10, $selectedValue);
		else if($id === 'subdivision_h' && $is_horizontal == true) input_txt_default_value(5, $selectedValue);

		// stacked
		else if($id === 'show_bar_totals') 
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		}
		else if($id === 'bar_total_font_size') input_txt_default_value(10, $selectedValue);
		else if($id === 'bar_total_colour') input_txt_default_value('#000000', $selectedValue);
		// grouped
		else if($id === 'group_space') input_txt_default_value(3, $selectedValue);
		// common_bar_setting
		else if($id === 'bar_space') input_txt_default_value(10, $selectedValue);		
		else if($id === 'show_bar_labels')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		}
		else if($id === 'bar_label_font_size') input_txt_default_value(10, $selectedValue);
		else if($id === 'bar_label_colour') input_txt_default_value('#000000', $selectedValue);
		else if($id === 'units_label' && $is_pie == false) input_txt_default_value('', $selectedValue);
		else if($id === 'units_before_label' && $is_pie == false) input_txt_default_value('', $selectedValue);

		// marker
		else if($id === 'marker_size') input_txt_default_value(2, $selectedValue);
		else if($id === 'marker_type')
		{
			$options = '
			<option value="circle">circle</option>
			<option value="square">square</option>
			<option value="triangle">triangle</option>
			<option value="cross">cross</option>
			<option value="x">x</option>
			<option value="pentagon">pentagon</option>
			<option value="diamond">diamond</option>
			<option value="hexagon">hexagon</option>
			<option value="octagon">octagon</option>
			<option value="asterisk">asterisk</option>
			<option value="threestar">three star</option>
			<option value="fourstar">four star</option>
			<option value="eightstar">eight star</option>';

			select_default_value('circle', $selectedValue, $options);
		}
		else if($id === 'marker_colour') input_txt_default_value('#FF0000', $selectedValue);
		else if($id === 'marker_stroke_width') input_txt_default_value(0, $selectedValue);
		else if($id === 'marker_stroke_colour') input_txt_default_value('#000000', $selectedValue);
		// line
		else if($id === 'line_stroke_width') input_txt_default_value(2, $selectedValue);
		else if($id === 'line_dash')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		}
		else if($id === 'fill_under') 
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('true', $selectedValue, $options);
		} 
		else if($id === 'fill_opacity')
		{
			$options = '
			<option value="0">none</option>
			<option value="0.1">10%</option>
			<option value="0.2">20%</option>
			<option value="0.3">30%</option>
			<option value="0.4">40%</option>
			<option value="0.5">50%</option>
			<option value="0.6">60%</option>
			<option value="0.7">70%</option>
			<option value="0.8">80%</option>
			<option value="0.9">90%</option>
			<option value="1">100%</option>';

			select_default_value('0.3', $selectedValue, $options);
		} 
		// scatter
		else if($id === 'best_fit') 
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		} 
		else if($id === 'best_fit_colour')  input_txt_default_value('#000000', $selectedValue);
		else if($id === 'best_fit_width')  input_txt_default_value(1, $selectedValue);
		else if($id === 'best_fit_dash') 
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		}
		// --------------------------------------------
		// pie graph (pie_3d_graph.php, pie_graph.php)
		// pie graph
		else if($id === 'aspect_ratio') input_txt_default_value(1.0, $selectedValue);
		else if($id === 'sort') 
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('true', $selectedValue, $options);
		}
		else if($id === 'reverse') 
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		}
		else if($id === 'start_angle') input_txt_default_value(0, $selectedValue);
		else if($id === 'show_labels')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('true', $selectedValue, $options);
		}
		else if($id === 'show_label_key')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('true', $selectedValue, $options);
		}
		else if($id === 'show_label_amount')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		}
		else if($id === 'units_label' && $is_pie == true) input_txt_default_value('', $selectedValue);
		else if($id === 'units_before_label' && $is_pie == true) input_txt_default_value('', $selectedValue);
		else if($id === 'show_label_percent')
		{
			$options = '
			<option value="true">true</option>
			<option value="false">false</option>';

			select_default_value('false', $selectedValue, $options);
		}
		else if($id === 'label_percent_decimals') input_txt_default_value(2, $selectedValue);
		else if($id === 'label_colour'  && $is_pie == true) input_txt_default_value('#FFFFFF', $selectedValue);
		else if($id === 'label_back_colour') input_txt_default_value('#000000', $selectedValue);
		else if($id === 'label_font'  && $is_pie == true)
		{
			$options = '
			<option value="monospace">monospace </option>
			<option value="sans-serif">sans-serif </option>
			<option value="Helvetica">Helvetica </option>
			<option value="Arial">Arial </option>
			<option value="Times">Times </option>
			<option value="Times New Roman">Times New Roman </option>';

			select_default_value('sans-serif', $selectedValue, $options);
		}
		else if($id === 'label_font_size' && $is_pie == true) input_txt_default_value(10, $selectedValue);
		else if($id === 'label_font_weight' && $is_pie == true)
		{
			$options = '
			<option value="normal">normal</option>
			<option value="bold">bold</option>';
			select_default_value('normal', $selectedValue, $options);
		}
		else if($id === 'label_fade_in_speed') input_txt_default_value(0, $selectedValue);
		else if($id === 'label_fade_out_speed') input_txt_default_value(0, $selectedValue);
		// pie 3d garph
		else if($id === 'depth') input_txt_default_value(10, $selectedValue);
	}

	// this set default value from session if set or static default value
	function default_value($id, $is_horizontal=false, $is_pie=false)
	{
		if(isset($_SESSION['cu_preview']) && $_SESSION['cu_preview'] === 'preview_chart')
		{
			if( isset($_SESSION['cu_XPost'][$id]) )
			{
				$selectedValue = $_SESSION['cu_XPost'][$id];
				static_default_value($id, $is_horizontal, $is_pie, $selectedValue);
			}else{
				static_default_value($id, $is_horizontal, $is_pie, '');
			}

		}
		else
		{
			static_default_value($id, $is_horizontal, $is_pie);
		}
	}
	// this set default value for input type text
	function input_txt_default_value($staticDefaultValue, $selectedValue)
	{
		echo ($selectedValue == '*scm_static_default_value') ? $staticDefaultValue : $selectedValue;
	}
	// this set default value for input type checkbox
	function input_checkbox_default_value($staticDefaultValue, $selectedValue)
	{
		if($selectedValue == 'on') $selectedValue = 'checked';
		echo ($selectedValue == '*scm_static_default_value') ? $staticDefaultValue : $selectedValue;
	}
	// this set default value for select
	function select_default_value($staticDefaultValue, $selectedValue, $options)
	{
		$selectedValue = ($selectedValue == '*scm_static_default_value') ? $staticDefaultValue : $selectedValue;
		$options = str_replace('selected', '', $options);
		$value = $selectedValue.'"';
		$selected = $selectedValue.'" selected';
		$options = str_replace($value, $selected, $options);
		echo $options;
	}