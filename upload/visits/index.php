<?php
include_once("conn.php");
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
   $Sql="insert into visits (data,time,ipcl) values ('Visits_log_view_page','".date("Y-m-d H:i:s")."','$ipaddress')";     
   mysql_query($Sql,$link);
  
session_start(); // start session cookies
require("Login.class.php"); // pull in file
$login = new Login; // create object login

$login->authorize(); // make user login

?>

<html>
<head>
<META HTTP-EQUIV='CACHE-CONTROL' CONTENT='NO-CACHE' >
<meta name='viewport' content='width=device-width, initial-scale=0.5'>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>Visits</title>
   <style>
th,td,tr
{
border:1px solid black;
}
.wo {
	text-align: center;
}
</style>
</head>
<body class="wo">
<h1>Visits log</h1>
<?php
$link=Conection();
   $Sql="insert into visits (data,time,ipcl) values ('Logged-in-Visits_log_view_page','".date("Y-m-d H:i:s")."','$ipaddress')";     
   mysql_query($Sql,$link);
#Clear log with "http:// . . . /index.php?erase=true"
if (isset($_GET["erase"]) && ($_GET["erase"]=="true"))
	{
		$link=Conection();
$Sql="TRUNCATE TABLE visits";
    mysql_query($Sql ,$link);
	 $Sql="insert into visits (data,time,ipcl) values ('clear-reset','".date("Y-m-d H:i:s")."','$ipaddress')";     
   mysql_query($Sql,$link);
	 mysql_free_result($result);
?>
</br>
LOG ERASED!! </br>
<a href="./index.php">back</a>
<?php
	}
else{
	?>
<a href="index.php?action=clear_login">Logout</a>
</br>
</br>
<a href="index.php?erase=true">! ! CLEAR LOG ! !</a>
</br>
</br>
	<?php
   $link=Conection();
   $result=mysql_query("select * from visits order by id desc ",$link);
   echo "<table style=\"display: inline-block; border: 1px solid; vertical-align: top; \">\n
   <caption>Visitors</caption>

<tr>
<th>Page</th>
<th>Date-time</th>
<th>IP</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row["data"] . "</td>";
   echo "<td>" . $row["time"] . "</td>";
    echo "<td>" . $row["ipcl"] . "</td>";
  echo "</tr>";
  }
echo "</table>";
mysql_free_result($result);
}
?>
</body>
</html>