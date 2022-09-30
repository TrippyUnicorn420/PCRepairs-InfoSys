<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" />
    <title>Look, repair deets!</title>
</head>

<body class="bg-white">
    <?php
    require_once("laziness.php");
    $database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    $oh_my_god_this_join = "SELECT Manufacturer, Model, Status, BookTime, FinishTime, Price, Message, Issue FROM Job INNER JOIN Devices ON Job.Device_ID = Devices.Device_ID WHERE Job_ID = {$_REQUEST['job_id']};";
    $result_set = mysqli_query($database, $oh_my_god_this_join);
    $row = mysqli_fetch_row($result_set);
    ?>

    <h1 class="text-4xl mx-5 font-bold">
        <?php
        echo "{$row[0]} {$row[1]}";
        ?>
    </h1>
    <br>
    <div class="mx-5">
        <p><b>Issue: </b> <?php echo $row[7] ?></p>
        <p><b>Time booked: </b> <?php echo $row[3] ?></p>
        <?php if (isset($row[4])) echo "<p><b>Time finished: {$row[4]} </b></p>"  ?>
        <p><b>Total Repair Cost: </b> R<?php echo $row[5] ?></p>
        <?php if (isset($row[6])) echo "<p><b>Messages from repair engineer: {$row[6]} </b></p>"  ?>
    </div>



</body>

</html>