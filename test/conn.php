<?php
$conn= new mysqli("localhost", "root", "", "task");

if($conn->connect_error){
    die("Connection Failed: ". $conn->connect_error);
}