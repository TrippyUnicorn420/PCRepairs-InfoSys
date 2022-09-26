<?php
require_once "laziness.php";
$database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$admin = 0;

$users_insert = mysqli_prepare($database, "INSERT INTO logindetails VALUES (?, ?, ?)") or die($database->error);
$hashed_password = hash("sha256", $_REQUEST['password']);
$users_insert->bind_param("ssi", $_REQUEST['username'], $hashed_password, $admin);
$users_insert->execute();

$users_insert = mysqli_prepare($database, "INSERT INTO customer (Customer_FName, Customer_LName, Customer_Email, Username) VALUES (?, ?, ?, ?);");
$users_insert->bind_param("ssss", $_REQUEST['name'], $_REQUEST['last_name'], $_REQUEST['email'], $_REQUEST['username']);
$users_insert->execute();

$get_customer_id = mysqli_prepare($database, "SELECT Customer_ID, Customer_FName FROM Customer WHERE Username = ?") or die($database->error);
$get_customer_id->bind_param("s", $_REQUEST['username']);
$get_customer_id->execute();
$customer_id = mysqli_fetch_array($get_customer_id->get_result());

$cookie_name = $_REQUEST['name'];
$cookie_value = $customer_id;
/* I want people to stay logged in until they click logout. This cookie will expire 10 years after its creation. */
setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60));
session_start();
$_SESSION["name"] = $_REQUEST['name'];
$_SESSION["customer_id"] = $customer_id;
$_SESSION["start"] = time();

header("Location: ../welcome.php");
