<?php
if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    try {
        // Start the session
        session_start();
    } catch (Exception $e) {
        // Handle the exception, e.g., log the error
        error_log("Error starting session: " . $e->getMessage());
    }
}
