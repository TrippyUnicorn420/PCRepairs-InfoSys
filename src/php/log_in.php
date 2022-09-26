<?php
require_once "laziness.php";
$database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

$log_this_person_in = mysqli_prepare($database, "SELECT * FROM logindetails WHERE Username = ? AND Password = ?");
$hashed_password = hash("sha256", $_REQUEST['password']);
$log_this_person_in->bind_param("ss", $_REQUEST['email'], $hashed_password);
// $log_this_person_in->bind_param("ss", $_REQUEST['email'], $_REQUEST['password']);
echo var_dump($hashed_password);

$log_this_person_in->execute();

$results = mysqli_fetch_array($log_this_person_in->get_result());
echo var_dump($results);
if (isset($results)) {
    session_start();
    // if an administrator is logging in
    if ($results[2]) {
        // This cookie will only last for two hours. Security is important if you're logging in like this.
        setcookie("admin", "supersecretlogin", time() + (2 * 60 * 60));
        $_SESSION["customer_id"] = "admin";
        header("Location: ../admin.php");
    } else {
        $customer_id = mysqli_fetch_row(mysqli_query($database, "SELECT Customer_ID FROM Customer WHERE Username = " . $_REQUEST['username'] . ";"))[0];
        setcookie("name", $customer_id, time() + (10 * 365 * 24 * 60 * 60));
        $_SESSION["customer_id"] = $customer_id[0];
        $_SESSION["customer_name"] = mysqli_fetch_row(mysqli_query($database, "SELECT Customer_FName FROM Customer WHERE Username = " . $_REQUEST['username'] . ";"))[0];
        $_SESSION["start"] = time();
        header("Location: ../welcome.php");
    }
} else {
    echo "<script>window.alert('Wrong password. Try again.');</script>";
    header("Location: ../login.php");
}
