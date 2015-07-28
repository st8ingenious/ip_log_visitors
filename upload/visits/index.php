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
<script type="text/javascript" src="jquery-1.3.1.min.js" ></script>
<script type="text/javascript" src="tableExport.js"></script>
<script type="text/javascript" src="jquery.base64.js"></script>

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
<a href="index.php?resolve=true">Resolve IP addresses</a>
</br>(last 1000 visits)
</br>
</br>
<input value="Export as xls" type="button" onclick="$('#exttable').tableExport({type:'excel', escape:'false'})">
</br>
</br>
	<?php
   $link=Conection();
   $result=mysql_query("select * from visits order by id desc ",$link);
   
   echo "<table id=\"exttable\" style=\"display: inline-block; border: 1px solid; vertical-align: top; \">\n
   <caption>Visitors</caption>


<tr>
<td>Page</td>
<td>Date-time</td>
<td>Visitors IP</td>
</tr>";
$apireq=0;

while($row = mysql_fetch_array($result))
  {
	  $ip= $row["ipcl"];
	  if (isset($_GET["resolve"]) && ($_GET["resolve"]=="true")){
	  if ($apireq<1000){
	 $apireq=$apireq+1;
	 
	  

$host1 = 'http://ipinfo.io/'. $ip . '/region';
$host2 = 'http://ipinfo.io/'. $ip . '/city';
$host3 = 'http://ipinfo.io/'. $ip . '/country';
	
	$city = null;
	$country = null;
	$region== null;
	
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$region = curl_exec($ch);
			curl_close ($ch);		
		
		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$city = curl_exec($ch);
			curl_close ($ch);		
			
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host3);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$country = curl_exec($ch);
			curl_close ($ch);		
		
		$ipsa = "<b>IP:</b> {$ip} <br />\n";
		$region=preg_replace( '/[^[:print:]]/', '',$region);
		$city=preg_replace( '/[^[:print:]]/', '',$city);
		$country=preg_replace( '/[^[:print:]]/', '',$country);
		
		if ($region !== 'undefined'){
	    $ipsb = "<b>Region:</b> <span style='color:blue'>{$region}</span> | \n";
		}else{$ipsb=null;}
		
		if ($city !== 'null'){
		$ipsc = "<b>City:</b> <span style='color:blue'>{$city}</span> | \n";
		}else{$ipsc=null;}
		
        $ipsd = "<b>Country:</b> <span style='color:blue'>{$country}</span> \n";		
  } else{
        $ipsa = "<b>IP:</b> {$ip}\n";
	    $ipsb = null;
		$ipsc = null;
        $ipsd = null;}
		
		
  } else{
        $ipsa = "<b>IP:</b> {$ip}\n";
	    $ipsb = null;
		$ipsc = null;
        $ipsd = null;}
		
  echo "<tr>";
  echo "<td>" . $row["data"] . "</td>";
   echo "<td>" . $row["time"] . "</td>";
    echo "<td>" . $ipsa . $ipsb . $ipsc . $ipsd . "</td>";
  echo "</tr>";
  }
echo "</table>";
mysql_free_result($result);
}
?>
</body>
</html>