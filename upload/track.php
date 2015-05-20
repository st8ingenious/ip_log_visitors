<?php
#Change this according to current page's name 
#$pagename="mycurrentpage";

#OR auto replace with the php file name
$pagename=$_SERVER['PHP_SELF'];

 include_once("./visits/conn.php");
   date_default_timezone_set('Europe/Athens');
   $ipaddress = '';
     if ($_SERVER['HTTP_CLIENT_IP'])
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if($_SERVER['HTTP_X_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if($_SERVER['HTTP_X_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if($_SERVER['HTTP_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if($_SERVER['HTTP_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if($_SERVER['REMOTE_ADDR'])
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = 'UNKNOWN';
  $link=Conection();
   $Sql="insert into visits (data,time,ipcl) values ('$pagename','".date("Y-m-d H:i:s")."','$ipaddress')";     
   mysql_query($Sql,$link);
  
 ?>