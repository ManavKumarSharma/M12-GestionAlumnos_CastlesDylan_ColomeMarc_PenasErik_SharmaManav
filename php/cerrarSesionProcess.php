<?php
session_start();

if (!isset($_SESSION['session_user'])) {
    header('Location: ../view/index.php');
    exit;
}

session_unset();

session_destroy();

header('Location: ../view/index.php');
exit();
?>