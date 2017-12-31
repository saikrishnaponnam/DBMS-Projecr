<?php
//connect to server
$servername="localhost";
$username="root";
$password="dragon256";
$db="cfadb";

//create connection
$conn=new mysqli($servername,$username,$password);

// create database
$sql ="CREATE  SCHEMA IF NOT EXISTS `cfadb` DEFAULT CHARACTER SET utf8 ";
$conn->query($sql);

//$sql="CREATE DATABASE IF NOT EXISTS cfadb";
//$conn->query($sql);
$conn=new mysqli($servername,$username,$password,$db);
?>