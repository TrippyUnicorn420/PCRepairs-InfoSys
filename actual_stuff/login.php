<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/fa18a9841f.js" crossorigin="anonymous"></script>
    <script src="js/look_at_all_these_functions.js"></script>
    <title>Login | PCRepairs</title>
</head>

<body>
    <?php
    require_once "php/laziness.php";
    $database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if (isset($_REQUEST['create'])) {
        $users_insert = mysqli_prepare($database, "INSERT INTO logindetails VALUES ?, ?, false;");
        $hashed_password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT);
        $users_insert->bind_param("ss", $_REQUEST['username'], $hashed_password);
        $users_insert->execute();

        $users_insert = mysqli_prepare($database, "INSERT INTO customer (Customer_FName, Customer_LName, Customer_Email, Username) VALUES ?, ?, ?, ?;");
        $users_insert->bind_param("ssss", $_REQUEST['name'], $_REQUEST['last_name'], $_REQUEST['email'], $_REQUEST['username']);
        $users_insert->execute();

        $customer_id = mysqli_fetch_row(mysqli_query($database, "SELECT Customer_ID FROM Customer WHERE Username = " . $_REQUEST['username'] . ";"))[0];

        echo "<script>
                    document.getElementById('southern_motherfucking_democratic_republicans').innerHTML = 'Welcome, {$_REQUEST['name']}. Logging you in...';
                    document.getElementById('create_form').style.display = 'hidden';
                </script>";

        $cookie_name = $_REQUEST['name'];
        $cookie_value = $customer_id;
        /* I want people to stay logged in until they click logout. This cookie will expire 10 years after its creation. */
        setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60));
        session_start();
        $_SESSION["customer_id"] = $customer_id[0];
        $_SESSION["start"] = time();

        echo "<script>window.frames['login_container'].location = 'choice.php';</script>";
    }

    if (isset($_REQUEST['logging'])) {
        echo var_dump($_REQUEST);
        $log_this_person_in = mysqli_prepare($database, "SELECT * FROM logindetails WHERE Username = ? AND Password = ?");
        $log_this_person_in->bind_param($_REQUEST['email'], password_hash($_REQUEST['password'], PASSWORD_BCRYPT));
        $log_this_person_in->execute();

        $results = mysqli_fetch_array($log_this_person_in->get_result());
        if (isset($results)) {
            // if an administrator is logging in
            if ($results[2]) {
                // This cookie will only last for two hours. Security is important if you're logging in like this.
                setcookie("admin", "supersecretlogin", time() + (2 * 60 * 60));
                $_SESSION["customer_id"] = "admin";
                echo "<script>window.alert('Welcome, admin.');";
            } else {
                $customer_id = mysqli_fetch_row(mysqli_query($database, "SELECT Customer_ID FROM Customer WHERE Username = " . $_REQUEST['username'] . ";"))[0];
                setcookie("name", $customer_id, time() + (10 * 365 * 24 * 60 * 60));
                $_SESSION["customer_id"] = $customer_id[0];
                $_SESSION["start"] = time();
            }

            header("Location: welcome.php");
        } else $_POST['wrong_password'] == true;
        header("Location: login.php");
    }

    ?>

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
        <div class="m-auto w-3/5 grid grid-cols-2 gap-5 place-content-center">
            <article class="m-auto h-auto my-5" id="southern_motherfucking_democratic_republicans">
                <div class="py-5">
                    <h1 class="text-4xl mx-5 font-bold" id="helper_text">
                        Get your device checked or check your repair.
                    </h1>
                </div>
            </article>

            <article id="login_form" class="w-full m-auto h-auto rounded-xl object-cover text-slate-800 shadow-md ease-in-out hover:shadow-2xl hover:underline my-5">
                <?php if (isset($_POST["wrong_password"])) echo "<p>Wrong password. Try again.</p>"; ?>
                <form action="php/log_in.php" method="post">
                    <input type="username" name="email" id="f_username" placeholder="Username..." class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:border-blue-600 focus:outline-none" /><br />
                    <input type="password" name="password" id="f_password" placeholder="Password..." class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:border-blue-600 focus:outline-none" /><br />
                    <input type="submit" value="Log In" class="w-full px-6 py-2.5 bg-nhblue text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-800 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue active-shadow-lg transition duration-150 ease-in-out" />
                </form>
                <br />
                <button class="w-full px-6 py-2.5 bg-nhblue text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-800 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue active-shadow-lg transition duration-150 ease-in-out" onclick="return jikeleza();">
                    Don't have an account? Create one.
                </button>
            </article>

            <article id="create_form" class="w-full m-auto h-auto hidden rounded-xl object-cover shadow-md ease-in-out hover:shadow-2xl hover:underline my-5">
                <form action="php/sign_up.php" method="post">
                    <input type="text" name="name" id="f_name" placeholder="First Name" class="block w-1/2 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:border-blue-600 focus:outline-none">
                    <input type="text" name="last_name" id="f_lname" placeholder="Last Name" class="block w-1/2 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:border-blue-600 focus:outline-none"><br />
                    <input type="text" name="username" id="f_username2" placeholder="Username" class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:border-blue-600 focus:outline-none"><br />
                    <input type="email" name="email" id="f_email" placeholder="Email address" class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:border-blue-600 focus:outline-none"><br />
                    <input type="password" name="password" id="f_password2" placeholder="Password" class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:border-blue-600 focus:outline-none"><br />
                    <input type="submit" value="Sign Up" onclick="checkExists();" class="w-full px-6 py-2.5 bg-nhblue text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-800 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue active-shadow-lg transition duration-150 ease-in-out">
                </form>
                <br />
            </article>
        </div>
    </section>


    <footer class="fixed bottom-0 bg-slate-100 w-full drop-shadow-2xl">
        <div class="m-auto">
            <small class="justify-center">Need help? <a href="contact.html">Contact us.</a></small><br />
            <small class="justify-center">Copyright &copy; 2022 Nerd Herd. All Rights
                Reserved.</small>
        </div>
    </footer>
</body>

</html>