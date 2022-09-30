<?php

// log this person out by destroying every single one of the things we created in their browser
session_start();
session_unset();
session_destroy();
setcookie('name', 0, time() - 1, '/');
header("Location: ../index.html");
