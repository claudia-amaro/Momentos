<?php
session_start();

//Destruir a sessão
//unset($_SESSION['user']);
session_destroy();
//session_destroy($_SESSION['user']);

header('Location: ../pages/moments.php');