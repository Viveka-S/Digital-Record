<?php
session_start();
session_destroy();
header("Location: Faculty Login.php");
?>