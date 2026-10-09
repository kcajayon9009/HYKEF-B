<?php
$con = new mysqli("localhost", "root", "", "hyke_db");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}