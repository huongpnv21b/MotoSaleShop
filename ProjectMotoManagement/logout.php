<?php
session_start();
unset($_SESSION['log']);
unset($_SESSION['name']);
session_destroy();
header("location:index.html");
?>