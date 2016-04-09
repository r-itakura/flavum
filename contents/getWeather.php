<?php
$url = 'http://weather.livedoor.com/forecast/webservice/json/v1?city=130010';
//header ( 'Content-Type: application/json; charset=utf-8' );
echo file_get_contents ( $url );
?>