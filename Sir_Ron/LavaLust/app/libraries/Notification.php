<?php

class Notification {

    public function __construct() {
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Set a notification message
    public function setMessage($type, $message) {
        $_SESSION['notification'][$type][] = $message;
    }

    // Get and clear notification messages
    public function getMessages() {
        if (isset($_SESSION['notification'])) {
            $messages = $_SESSION['notification'];
            // Clear the notifications after fetching
            unset($_SESSION['notification']);
            return $messages;
        }
        return [];
    }
}
