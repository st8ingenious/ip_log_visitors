<?php
function Conection(){
$hostname = "localhost";
$database = "visitsdb";
$username = "visitsuser";
$password = "mystrongpassword"; 

   if (!($link=mysql_connect($hostname,$username,$password)))  {
      exit();
   }
   if (!mysql_select_db("$database",$link)){
      exit();
   }
   return $link;
}
?>