<?php
require_once 'config.php';
require 'session_start.php';
if(isset($_SESSION['login'])) {
    unset($_SESSION['login']);
}
if(isset($_SESSION['name'])) {
    unset($_SESSION['name']);
}
if(isset($_SESSION['esAdmin'])) {
    unset($_SESSION['esAdmin']);
}
session_destroy();
header ('Location: ../estrenos.php');