<?php
$IP =  $_POST['IP']
$json = file_get_contents('http://192.168.0.191/getData.json');
$obj = json_decode($json);
echo $obj->uptime;
?>