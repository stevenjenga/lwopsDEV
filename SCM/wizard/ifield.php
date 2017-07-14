<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("shared.php");
require_once("check.php");
require_once("lib.php");
if(!validate($_POST["tName"])|| !validate($_POST["fName"]))
{     
    echo "0";
}   
else
{
    $table = clean($_POST["tName"]);
    $field = clean($_POST["fName"]);
  //  echo "table + $table , field $field ++";
    $str = "DESCRIBE  `".$table."`";
   // echo $str;
    $result = sql("DESCRIBE `".$table."`");
   // echo mysql_num_rows($result);
    while($rows = mysql_fetch_array($result,MYSQL_ASSOC)){
     // echo $rows["Field"];  
     if(strtolower($rows["Field"]) == strtolower($field))
     {
       if(strpos(strtolower($rows["Type"]),'int') !== false|| strpos(strtolower($rows["Type"]),'decimal') !== false|| strpos(strtolower($rows["Type"]),'double') !== false|| strpos(strtolower($rows["Type"]),'float') !== false)
       {
           
         
         echo "1";
       }
       else
       {
            
           echo "0";
           
       }

    }
    
   
    }
    
}


?>

