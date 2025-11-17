<?php
session_start();

if (isset($_POST['usuario']) && trim($_POST['usuario']) !== '') {
    $_SESSION['usuario'] = trim($_POST['usuario']);
    echo 'Sesion iniciada para ' . $_SESSION['usuario'];
    exit;
}

echo 'Proporciona el usuario via POST';
