#Ip Log Visitors

Description     
#Track and log your website's visitors IP addresses
 
How to use:
Change Username and Password in "Login.class.php"
Change Database info in "conn.php"
Upload folder "visits" to your website's root folder
Add database "visitsdb" to your server and import database schema

Setup tracking:
a) Upload "track.php" to your root folder and add "<?php include("./track.php"); ?>" in every page you want to track.
 OR
b) Add the code from "track.php" to all the php file pages you want to track.

Don't forget to set the "pagename" at the beginning of "track.php", by commenting out whichever option you want to use.


To view the log page, visit "http:// yourwebsite.com/visits/"


Copyright (C) 2015  Efstathios Kladis

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    GNU GENERAL PUBLIC LICENSE
    Version 2, June 1991
    _______________________________________________________________________
   
  Disclaimer
The php code for the login process is a part of:
Name: Login.class.php
Description: simple single user login script
Author: ricocheting
Web: http://www.ricocheting.com/code/php
Update: 2010-06-06
Version: 2.1
Copyright 2003 ricocheting.com

This script is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
  _______________________________________________________________________
   	


	
	
 Original can be found at https://github.com/st8ingenious/ip_log_visitors

