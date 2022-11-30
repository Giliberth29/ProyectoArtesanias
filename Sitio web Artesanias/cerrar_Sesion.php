<?php
session_start();

$_SESSION['usuario_info'] = array();
header('Location: html/index.html');
