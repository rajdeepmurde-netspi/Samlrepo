<?php
// Assertion Consumer Service (ACS)
if (!isset($_GET['SAMLResponse'])) {
    die("No SAMLResponse");
}
$resp = base64_decode($_GET['SAMLResponse']);
// Vulnerabilities:
//  * No signature verification
//  * No strict XML parsing / ignoring external entities
//  * No checking of issuer / audience / timestamp
// Extract NameID with naive regex
if (preg_match('|<saml:NameID>([^<]+)</saml:NameID>|', $resp, $m)) {
    $user = $m[1];
    session_start();
    $_SESSION['user'] = $user;
    echo "Logged in as: ".htmlspecialchars($user);
} else {
    echo "Invalid assertion";
}

