<?php
	$selected_style = (isset($_SESSION[ $form_prefix . 'selected_style'])) ? $_SESSION[ $form_prefix . 'selected_style'] : '';
	$style_array = array(
		'red', 'blue', 'soft-grey', 'black'
	);
	
	function print_styles_names()
	{
		global $selected_style, $style_array, $form_prefix;
		$selected_style = get_default_value('selected_style');
		foreach($style_array as $i => $formatted_css_name)
		{
			if($i == 0 && empty($selected_style)) $selected_style  = $formatted_css_name;
			if($selected_style == $formatted_css_name) echo "<option selected>" . $formatted_css_name. "</option>";			
			else echo "<option>" . $formatted_css_name. "</option>";
		}	
	}

	function get_default_value($var)
	{		
		global $form_prefix;
		if($var == 'selected_style') $s_var = 'selected_style';
		if(!empty($_POST[$var])) return $_POST[$var];
		else if(!empty($_SESSION[ $form_prefix . $s_var])) return $_SESSION[ $form_prefix . $s_var];
		else if($var == 'selected_style') return 'blue';
	}
	
	