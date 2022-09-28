<?php

require_once "laziness.php";
$database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

// add device to database
session_start();
$prepared_statement = mysqli_prepare($database, "INSERT INTO Devices (Manufacturer, Model, Issue, Customer_ID) VALUES (?, ?, ?, ?);");
$prepared_statement->bind_param("sssi", $_REQUEST['manufacturer'], $_REQUEST['model'], $_REQUEST['issue'], $_SESSION['customer_id']);
$prepared_statement->execute();
