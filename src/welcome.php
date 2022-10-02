<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/stars.css">
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/fa18a9841f.js" crossorigin="anonymous"></script>
    <title>Welcome | PCRepairs</title>
</head>

<body>
    <div id="container">
        <canvas id="canvas"></canvas>
        <script src="js/stars.js"></script>
        <div id="overlay">
            <header class="bg-slate-100">
                <a href="/"><img class="float-left w-32 h-32" src="images/pcrepairs.jpeg" /></a>
                <br /><br /><br /><br /><br /><br />
                <nav class="drop-shadow-xl sticky">
                    <div class="bg-slate-100 flex float-left space-x-4 w-1/2">
                        <a class="px-3 py-2 text-white rounded-lg hover:bg-slate-300 hover:text-slate-900 shadow-md bg-nhblue animate-pulse" href="/">Home</a>
                        <a class="px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-300 hover:text-slate-900 hover:shadow-md" href="services.html">Services</a>
                        <a class="px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-300 hover:text-slate-900 hover:shadow-md" href="#">About Us</a>
                        <a class="px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-300 hover:text-slate-900 hover:shadow-md" href="faq.html">FAQ</a>
                    </div>
                    <div class="bg-slate-100 flex justify-end float-right space-x-4 w-1/2">
                        <i class="px-3 py-3 rounded-lg hover:bg-slate-300 hover:shadow-md fa-solid fa-phone"></i>
                        <i class="px-3 py-3 rounded-lg hover:bg-slate-300 hover:shadow-md fa-solid fa-envelope"></i>
                        <i class="px-3 py-3 rounded-lg hover:bg-slate-300 hover:shadow-md fa-solid fa-user"></i>
                        <i class="px-3 py-3 rounded-lg hover:bg-slate-300 hover:shadow-md fa-solid fa-magnifying-glass"></i>
                    </div>
                </nav>
            </header>

            <section class="my-16">
                <article class="bg-white m-auto w-2/5 h-auto bg-cover bg-center rounded-xl object-cover shadow-md ease-in-out hover:shadow-2xl hover:underline">
                    <h1 class="text-4xl mx-5 font-bold">
                        Welcome,
                        <?php session_start();
                        if (!isset($_SESSION['customer_name'])) header("Location: login.php");
                        echo $_SESSION['customer_name']; ?>.
                    </h1>
                    <p class="mx-5">What do you want to do?</p>
                </article>
            </section>

            <div class="m-auto w-3/5 grid grid-cols-2 gap-5 place-content-center">
                <a href="book.html">
                    <article class="m-auto h-auto bg-cover bg-center rounded-xl bg-macnifying-glass object-cover text-white shadow-md ease-in-out hover:shadow-2xl hover:underline my-5">
                        <br /><br /><br /><br /><br /><br /><br />

                        <div class="py-5">
                            <h1 class="text-4xl mx-5 font-bold">
                                Book a device for repair. >
                            </h1>
                            <p class="mx-5">Entrust us with your beloved.</p>
                        </div>
                    </article>
                </a>

                <a href="n_dashboard.php">
                    <article class="m-auto h-auto bg-cover bg-center rounded-xl bg-squaw object-cover text-white shadow-md ease-in-out hover:shadow-2xl hover:underline my-5">
                        <br /><br /><br /><br /><br /><br /><br />

                        <div class="py-5">
                            <h1 class="text-4xl mx-5 font-bold">
                                Check on a repair. >
                            </h1>
                            <p class="mx-5">
                                See how your beloved is doing in our care.
                            </p>
                        </div>
                    </article>
                </a>
            </div>

            <section>
                <div class="m-auto w-3/5 grid grid-cols-2 gap-5 place-content-center">
                    <a href="php/log_out.php">
                        <article class="m-auto h-auto bg-cover bg-center rounded-xl flex bg-white object-cover shadow-md ease-in-out hover:shadow-2xl my-5">
                            <i class="px-3 py-3 fa-solid fa-left-long-to-line"></i>
                            <p class="px-3 py-3">Log Out</p>
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

            <footer class="fixed bottom-0 bg-slate-100 w-full drop-shadow-2xl">
                <div class="m-auto">
                    <small class="justify-center">Need help? <a href="contact.html">Contact us.</a></small><br />
                    <small class="justify-center">Copyright &copy; 2022 Nerd Herd. All Rights
                        Reserved.</small>
                </div>
            </footer>
            <script src="bundle.js"></script>
        </div>
    </div>
</body>

</html>