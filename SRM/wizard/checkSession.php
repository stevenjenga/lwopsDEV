<?php
/* check that necessary info thta should be stored in session before step 4 and 5 are existed otherwise system would crash */
	defined('SYSTEM_CONTROL') or die (header('location: ../wizard'));
	function sessionBe4Step4()
	{
		global $_SESSION;
		if(isset(
			$_SESSION["srm_f62014_table"])
			) return true;
		else if(isset(
			$_SESSION["srm_f62014_sql"])
			) return true;
		else return false;
	}
	
	function sessionBe4Step5()
	{
		global $_SESSION;
		if(isset(
			$_SESSION["srm_f62014_fields"],
			$_SESSION["srm_f62014_fields2"])
			) return true;
		else return false;
	}