<?php require("./required/config.php");

session_destroy();
header("Location: login.php");
