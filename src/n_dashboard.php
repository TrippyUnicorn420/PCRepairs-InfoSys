<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/fa18a9841f.js" crossorigin="anonymous"></script>
    <script src="js/look_at_all_these_functions.js"></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/stars.css" />
    <title>Dashboard | PCRepairs</title>
</head>

<body>
    <?php
    require_once("php/laziness.php");
    session_start();
    $database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    $look_at_this_inner_join = "SELECT Job.Job_ID, Manufacturer, Model, Status FROM Job INNER JOIN Devices ON Job.Device_ID = Devices.Device_ID WHERE Devices.Customer_ID = '{$_SESSION['customer_id']}';";
    $result_set = mysqli_query($database, $look_at_this_inner_join);
    ?>

    <div id="container">
        <canvas id="canvas"></canvas>
        <script src="js/stars.js"></script>
        <div id="overlay">
            <header class="bg-white">
                <a href="/"><img class="float-left w-32 h-32" src="images/pcrepairs.jpeg" /></a>
                <br /><br /><br /><br /><br /><br />
                <nav class="drop-shadow-xl sticky">
                    <div class="bg-white flex float-left space-x-4 w-1/2">
                        <a class="px-3 py-2 text-white rounded-lg hover:bg-slate-300 hover:text-slate-900 shadow-md bg-nhblue animate-pulse" href="/">Home</a>
                        <a class="px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-300 hover:text-slate-900 hover:shadow-md" href="services.html">Services</a>
                        <a class="px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-300 hover:text-slate-900 hover:shadow-md" href="about_us.html">About Us</a>
                        <a class="px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-300 hover:text-slate-900 hover:shadow-md" href="faq.html">FAQ</a>
                    </div>
                    <div class="bg-white flex justify-end float-right space-x-4 w-1/2">
                        <i class="px-3 py-3 rounded-lg hover:bg-slate-300 hover:shadow-md fa-solid fa-phone"></i>
                        <i class="px-3 py-3 rounded-lg hover:bg-slate-300 hover:shadow-md fa-solid fa-envelope"></i>
                        <i class="px-3 py-3 rounded-lg hover:bg-slate-300 hover:shadow-md fa-solid fa-user"></i>
                        <i class="px-3 py-3 rounded-lg hover:bg-slate-300 hover:shadow-md fa-solid fa-magnifying-glass"></i>
                    </div>
                </nav>
            </header>

            <section class="my-16 mx-5 flex place-content-center">
                <article class="h-auto mx-5 w-2/5 bg-cover bg-white bg-center rounded-xl object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                    <div>
                        <h1 class="text-4xl mx-5 font-bold">
                            Here are all your active repair jobs.
                        </h1>
                        <p class="mx-5">
                            Click on one to see more information.
                        </p>
                    </div>
                    <div class="p-5">
                        <?php
                        if ($result_set) {
                            while ($row = mysqli_fetch_array($result_set)) {
                                echo "<div class=\"device w-auto p-4 m-0 border drop-shadow-lg hover:bg-slate-100 hover:shadow-2xl hover:cursor-pointer bg-slate-50\" onclick=\"clearBlues(); document.getElementById('iframe').src = 'php/repair_deets.php?job_id={$row[0]}'; this.style.backgroundColor = 'rgb(2 128 178)'; this.style.color = '#FFFFFF';\" id=\"device_{$row[0]}\">
                                        <p>{$row[1]} {$row[2]}</p>
                                        <p class=\"text-xs\">Status: {$row[3]}</p>
                                    </div>";
                            }
                        } else {
                            echo "<div class=\"w-auto p-4 m-0 border drop-shadow-lg hover:bg-slate-100 hover:shadow-2xl hover:cursor-pointer bg-slate-50\" onclick=\"document.getElementById('iframe').src = 'https\://youtube.com/embed/dQw4w9WgXcQ';\">
                                        <p>You have no active repair jobs.</p>
                                    </div>";
                        }

                        ?>
                    </div>
                </article>
                <article class="h-auto mx-10 w-3/5 bg-cover bg-center rounded-xl object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                    <iframe class="w-full h-full rounded-xl" id="iframe"></iframe>
                </article>
            </section>

            <section>
                <div class="m-auto w-3/5 grid grid-cols-2 gap-5 place-content-center">
                    <a href="welcome.php">
                        <article class="m-auto h-auto bg-cover bg-center rounded-xl flex bg-white object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                            <i class="px-3 py-3 fa-solid fa-left"></i>
                            <p class="px-3 py-3">Go back</p>
                        </article>
                    </a>

                    <a href=" #">
                        <article class="m-auto h-auto bg-cover bg-center rounded-xl flex bg-white object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                            <i class="px-3 py-3 fa-solid fa-comment"></i>
                            <p class="py-3">Contact us</p>
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