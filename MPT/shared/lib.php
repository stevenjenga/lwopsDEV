<?php
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	/*
		this function used to remove anything outside of [$availableKeys] :: [$_POST] [$_GET] [$_SESSION]
		params:
			var: [$_POST] [$_GET] [$_SESSION]
			availableKeys: array()
	*/
	function clean_super_register($var, $availableKeys)
	{
		$newVar = array();
		foreach($var as $key => $val)
		{
			if(in_array($key, $availableKeys))
				$newVar[$key] = $val;
		}
		return $newVar;
	}

	/*
		(clean input)(), (clean array)() to validate $_POST before generating tables [config.php]
	*/
	function clean_input($str)
	{
		return preg_replace('/[^a-z0-9-_,`\.= ]/i', '', $str);
	}

	function clean_array($arr)
	{
		$cleaned_array = array();
		foreach($arr as $key => $value)
		{
			if(is_array($value))
				$cleaned_array[clean_input($key)] = clean_array($value);
			else
				$cleaned_array[clean_input($key)] = clean_input($value);
		}
		return $cleaned_array;
	}