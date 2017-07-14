 <?php
 error_reporting(E_ERROR  | E_PARSE);
 $id = session_id();
if(empty($id))session_start();
session_destroy();
//header("location: ../../wizard/?id=0");
?>

