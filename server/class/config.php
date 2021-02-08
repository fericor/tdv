<?php
    $DB_HOST = 'db5000349226.hosting-data.io';
    $DB_USER = 'dbu487824';
    $DB_PASS = 'Swv11w9x**';
    $DB_NAME = 'dbs339303';

    /*$DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = 'root';
    $DB_NAME = 'tdv';*/

    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }