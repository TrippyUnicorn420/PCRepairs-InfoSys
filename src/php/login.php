<?php

require_once "laziness.php";

$database = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

// creating the log in/sign up forms
if (!isset($_SESSION['user_name']) && !isset($_REQUEST['username'])) {
    $query = "SELECT username FROM logindetails";
    $results = mysqli_query($database, $query);
    $usernames = mysqli_fetch_array($results);

    echo "<section class=\"my-16\">
            <div
                class=\"m-auto w-3/5 grid grid-cols-2 gap-5 place-content-center\"
            >
                <article class=\"m-auto h-auto my-5\"  id=\"southern_motherfucking_democratic_republicans\">
                    <div class=\"py-5\">
                        <h1 class=\"text-4xl mx-5 font-bold\" id=\"helper_text\">
                            Get your device checked or check your repair.
                        </h1>
                    </div>
                </article>

                <article id=\"login_form\"
                    class=\"m-auto h-auto bg-cover bg-center rounded-xl bg-squaw object-cover text-white shadow-md ease-in-out hover:shadow-2xl hover:underline my-5\"
                >
                    <form action=\"login.php?logging=yup\" method=\"post\">
                        <input type=\"username\" name=\"email\" id=\"f_username\" placeholder=\"Username...\"><br />
                        <input type=\"password\" name=\"password\" id=\"f_password\" placeholder=\"Password...\"><br />
                        <input type=\"submit\" value=\"Log In\">
                    </form>
                    <br />
                    <a onclick=\"document.getelementbyid('login_form').style.display = 'none';
                                document.getelementbyid('create_form').style.display = 'block';
                                document.getelementbyid('helper_text').innerhtml = 'Let's create your account and get you going.';\">Don't have an account? Create one.</a>
                </article>

                <article id=\"create_form\"
                    class=\"m-auto h-auto bg-cover bg-center hidden rounded-xl bg-squaw object-cover text-white shadow-md ease-in-out hover:shadow-2xl hover:underline my-5\"
                >
                    <form action=\"login.php?create=yes\" method=\"post\">
                        <input type=\"text\" name=\"name\" id=\"f_name\" placeholder=\"First Name\">
                        <input type=\"text\" name=\"last_name\" id=\"f_lname\" placeholder=\"Last Name\"><br />
                        <input type=\"text\" name=\"username\" id=\"f_username2\" placeholder=\"Username\"><br />
                        <input type=\"email\" name=\"email\" id=\"f_email\" placeholder=\"Email address\"><br />
                        <input type=\"password\" name=\"password\" id=\"f_password2\" placeholder=\"Password\"><br />
                        <input type=\"submit\" value=\"Sign Up\" onclick=\"checkExists();\">
                    </form>
                    <br />
                    <a onclick=\"document.getElementById('login_form').style.display = 'none'; document.getElementById('create_form').style.display = 'block';\">Don't have an account? Create one.</a>
                </article>
            </div>
        </section>";

    // check if a username already exists
    echo "<script>
                var usernames = " . json_encode($usernames) . ";
                var username_field = document.getElementById('f_username');
                username_field.addEventListener('focusout', checkExists);

                function checkExists() {
                    if (usernames.contains(username_vield.value)) {
                        window.alert('That username is taken.');
                        username_field.style.borderColor = 'red';
                        preventDefault();
                    }
                    else {
                        username_field.style.borderColor = 'green';
                        return true;
                    }
                }
            </script>document.getElementbyId('southern_motherfucking_democratic_republicans')";
}

// the flow from the account creation process

if (isset($_REQUEST['create'])) {
    $users_insert = mysqli_prepare($database, "INSERT INTO logindetails VALUES ?, ?, false;");
    $hashed_password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT);
    $users_insert->bind_param("ss", $_REQUEST['username'], $hashed_password);
    $users_insert->execute();

    $users_insert = mysqli_prepare($database, "INSERT INTO customer VALUES ?, ?, ?, ?;");
    $users_insert->bind_param("ssss", $_REQUEST['name'], $_REQUEST['last_name'], $_REQUEST['email'], $_REQUEST['username']);
    $users_insert->execute();

    echo "<script>
            document.getElementById('southern_motherfucking_democratic_republicans').innerHTML = 'Welcome, {$_REQUEST['name']}. Logging you in...';
            document.getElementById('create_form').style.display = 'hidden';
        </script>";

    $cookie_name = $_REQUEST['name'];
    $cookie_value = password_hash($_REQUEST['name'], PASSWORD_BCRYPT);
    /* I want people to stay logged in until they click logout. This cookie will expire 10 years after its creation. */
    setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60));
    session_start();
    $_SESSION["username"] = $_REQUEST["username"];
    $_SESSION["start"] = time();

    echo "<script>window.frames['login_container'].location = 'choice.php';</script>";
}
