<?php
$servername = "66.85.132.90";
$username = "root_autogas";
$password = "19341986Chipi**";
$dbname = "paymed";

$mysqli = new mysqli($servername, $username, $password, $dbname);
$mysqli->set_charset("utf8");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
