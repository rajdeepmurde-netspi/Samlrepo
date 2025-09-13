<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<a href=\"login.php\">Login via SAML</a>";
} else {
    echo "Hello, " . htmlspecialchars($_SESSION['user']);
}

