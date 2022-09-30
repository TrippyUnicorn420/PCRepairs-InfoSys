<?php

require_once "laziness.php";
$database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

// add device to database
session_start();

var_dump($_REQUEST);
var_dump($_SESSION);
$prepared_statement = mysqli_prepare($database, "INSERT INTO Devices (Manufacturer, Model, Issue, Customer_ID) VALUES (?, ?, ?, ?);");
if (isset($_REQUEST['phone'])) {
    $issues = "{$_REQUEST['p_issue']} - {$_REQUEST['issue']}";
} else {
    $issues = "{$_REQUEST['issue']}";
}
$prepared_statement->bind_param("sssi", $_REQUEST['manufacturer'], $_REQUEST['model'], $issues, $_SESSION['customer_id']);
$prepared_statement->execute() or die($database->error);

$device_id = mysqli_fetch_array(
    mysqli_query($database, "SELECT Device_ID FROM Devices WHERE Manufacturer = '{$_REQUEST['manufacturer']}' AND Model = '{$_REQUEST['model']}' AND Customer_ID = {$_SESSION['customer_id']};")
)[0] or die($database->error);


// add to job table. Prepared statement isn't necessary here because all user input is probably clean (and also I'm lazy)
mysqli_query($database, "INSERT INTO Job (Device_ID, Status, BookTime, Price) VALUES (" . $device_id . ", 'Awaiting device', FROM_UNIXTIME( " . time() . "), 295.00);");
$job_id = mysqli_fetch_array(
    mysqli_query($database, "SELECT Job_ID FROM Job WHERE Device_ID = $device_id;")
)[0] or die($database->error);
mysqli_query($database, "INSERT INTO JobToEngineer (Job_ID, Engineer_ID) VALUES ($job_id, NULL)")
    or die($database->error);
$_SESSION['booked'] = true;

header("Location: ../booked.php");
