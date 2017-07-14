<?php
	// this function to make call back in filter_input_array() function
	function clean_input($str)
	{
		$str = strip_tags($str);
		$str = (get_magic_quotes_gpc()) ? stripslashes($str) : $str;
		$str = trim($str);
		$str = preg_replace('/[\\"\'[{;&}|<>\/]/i', '', $str);
		return $str;
	}
	
	// this function to return array with cleared values from $_POST array and it take $_POST as parameter
	function clean_global_array($arr)
	{
		$clean_arr = array();
		foreach($arr as $key => $value)
		{
			$clean_arr[] = 
				filter_input_array(
					INPUT_POST,
					array(
						"$key" => array(
							'filter' => FILTER_CALLBACK,
							'options' => 'clean_input'
						)
					)
				);
		}
		$clean_array = array();
		// this loop to make this array n instead of n^2
		foreach($clean_arr as  $key => $value)
		{
			foreach($value as $k => $val)
			$clean_array[$k] = $val;
		}
		return $clean_array;
	}
        
        function clean_input_array($arr){
            $clean = array();
            foreach($arr as $k=>$v)
            {
                if(is_array($v))
                 $clean[clean_input($k)]=clean_input_array($v);   
                    else
                 $clean[clean_input($k)] = clean_input($v);      
            }
            return $clean;
           
            
        }