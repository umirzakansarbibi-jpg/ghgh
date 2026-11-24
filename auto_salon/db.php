<?php
session_start();

$conn = new mysqli("localhost", "root", "", "auto_salon");

if ($conn->connect_error) {
    die("Database error");
}

$conn->set_charset("utf8mb4");
?>