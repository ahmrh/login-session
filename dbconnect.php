<?php
    $conn = mysqli_connect("localhost", "root", "", "logindb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
