<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/fa18a9841f.js" crossorigin="anonymous"></script>
    <script src="js/look_at_all_these_functions.js"></script>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../css/stars.css" />
    <title>Engineer Dashboard | PCRepairs</title>
</head>

<body>
    <?php
    require_once("../php/laziness.php");
    $database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    session_start();

    if ($_SESSION['admin'] != "admin") {
        header("Location: index.html");
    }
    $oh_my_god_this_query = "SELECT Job.Job_ID, Manufacturer, Model, Issue FROM jobtoengineer INNER JOIN Job ON Job.Job_ID = jobtoengineer.Job_ID INNER JOIN Devices ON Job.Device_ID = Devices.Device_ID WHERE Engineer_ID IS NULL;";
    $more_tame_query_but_omg_none_the_less = "SELECT Manufacturer, Model, Issue FROM jobtoengineer INNER JOIN Job ON Job.Job_ID = jobtoengineers.Job_ID INNER JOIN Devices ON Job.Device_ID = Devices.Device_ID WHERE Username = '{$_SESSION['engineer']}';";

    $unclaimed_jobs = mysqli_query($database, $oh_my_god_this_query);
    $my_jobs = mysqli_query($database, $more_tame_query_but_omg_none_the_less) or die($database->error);
    ?>
    <div id="container">
        <canvas id="canvas"></canvas>
        <script src="../js/stars.js"></script>
        <div id="overlay">
            <header class="bg-white shadow-2xl">
                <a href="/"><img class="float-left w-32 h-32" src="../images/pcrepairs.jpeg" /></a>
                <br /><br /><br /><br /><br /><br />

            </header>

            <?php
            if (isset($_SESSION["taken_job_id"])) {
                echo "<article class=\"h-auto mx-5 w-full bg-cover bg-white bg-center rounded-xl object-cover shadow-md ease-in-out hover:shadow-2xl my-5\">
                <p>You have taken Job #{$_SESSION['taken_job_id']}.</p>
                </article>";
                unset($_SESSION["taken_job_id"]);
            }
            ?>

            <section class="my-16 mx-5 flex place-content-center">
                <article class="h-auto mx-5 w-full bg-cover bg-white bg-center rounded-xl object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                    <div>
                        <h1 class="text-4xl mx-5 font-bold">
                            Unassigned Repair Jobs
                        </h1>
                    </div>
                    <div class="p-5">
                        <?php
                        if ($unclaimed_jobs->lengths) {
                            while ($row = mysqli_fetch_array($unclaimed_jobs)) {
                                echo "<div class=\"device w-auto p-4 m-0 border drop-shadow-lg hover:bg-slate-100 hover:shadow-2xl hover:cursor-pointer bg-slate-50\" onclick=\"clearBlues(); document.getElementById('iframe').src = 'php/repair_deets.php?job_id={$row[0]}'; this.style.backgroundColor = 'rgb(2 128 178)'; this.style.color = '#FFFFFF';\" id=\"device_{$row[0]}\">
                                        <p>{$row[1]} {$row[2]}</p>
                                        <p class=\"text-xs\">Issue: {$row[3]}</p>
                                        <a href=take.php?job_id={$row[0]}>Take</a>
                                    </div>";
                            }
                        } else {
                            echo "<div class=\"w-auto p-4 m-0 border drop-shadow-lg hover:bg-slate-100 hover:shadow-2xl hover:cursor-pointer bg-slate-50\" onclick=\"document.getElementById('iframe').src = 'https\://youtube.com/embed/dQw4w9WgXcQ';\">
                                        <p>There are no unassigned jobs.</p>
                                    </div>";
                        }

                        ?>
                    </div>
                </article>
            </section>

            <section class="my-16 mx-5 flex place-content-center">
                <article class="h-auto mx-5 w-full bg-cover bg-white bg-center rounded-xl object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                    <div>
                        <h1 class="text-4xl mx-5 font-bold">
                            My repair jobs
                        </h1>
                    </div>
                    <div class="p-5">
                        <?php
                        if ($my_jobs) {
                            while ($row = mysqli_fetch_array($my_jobs)) {
                                echo "<div class=\"device w-auto p-4 m-0 border drop-shadow-lg hover:bg-slate-100 hover:shadow-2xl hover:cursor-pointer bg-slate-50\" onclick=\"clearBlues(); document.getElementById('iframe').src = 'php/repair_deets.php?job_id={$row[0]}'; this.style.backgroundColor = 'rgb(2 128 178)'; this.style.color = '#FFFFFF';\" id=\"device_{$row[0]}\">
                                        <p>{$row[1]} {$row[2]}</p>
                                        <p class=\"text-xs\">Issue: {$row[3]}</p>
                                    </div>";
                            }
                        } else {
                            echo "<div class=\"w-auto p-4 m-0 border drop-shadow-lg hover:bg-slate-100 hover:shadow-2xl hover:cursor-pointer bg-slate-50\" onclick=\"document.getElementById('iframe').src = 'https\://youtube.com/embed/dQw4w9WgXcQ';\">
                                        <p>You have no active jobs.</p>
                                    </div>";
                        }

                        ?>
                    </div>
                </article>
            </section>

            <section>
                <div class="m-auto w-3/5 grid grid-cols-2 gap-5 place-content-center">
                    <a href="../php/log_out.php">
                        <article class="m-auto h-auto bg-cover bg-center rounded-xl flex bg-white object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                            <i class="px-3 py-3 fa-solid fa-left"></i>
                            <p class="px-3 py-3">Log Out</p>
                        </article>
                    </a>

                    <a href=" #">
                        <article class="m-auto h-auto bg-cover bg-center rounded-xl flex bg-white object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                            <i class="px-3 py-3 fa-solid fa-cart-shopping"></i>
                            <p class="py-3">Requisition A Part</p>
                        </article>
                    </a>
                </div>
            </section>

            <footer class=" fixed bottom-0 bg-white w-full drop-shadow-2xl">
                <div class="m-auto">
                    <small class="justify-center">Need help?
                        <a href="contact.html">Contact us.</a></small><br />
                    <small class="justify-center">Copyright &copy; 2022 Nerd Herd. All Rights
                        Reserved.</small>
                </div>
            </footer>
            <script src="bundle.js"></script>
        </div>
    </div>
</body>

</html>