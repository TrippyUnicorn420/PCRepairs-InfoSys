<?php

require_once("../php/laziness.php");
$database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

session_start();
$engineer_id = mysqli_fetch_row(mysqli_query($database, "SELECT Engineer_ID FROM Engineers WHERE Username = '{$_SESSION['engineer']}';"))[0]
    or die($database->error);
$take_job = mysqli_query($database, "UPDATE jobtoengineer SET Engineer_ID = $engineer_id WHERE Job_ID = {$_REQUEST['job_id']};") or die($database->error);
$_SESSION["taken_job_id"] = $_REQUEST["job_id"];

header("Location: admin_dash.php");
