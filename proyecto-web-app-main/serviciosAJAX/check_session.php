<?php
session_start();

if (isset($_SESSION["user_obj"])) {
    echo "user_exists";
} else {
    echo "no_user";
}