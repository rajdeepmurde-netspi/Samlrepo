<?php
// SP initiates SAML login
$relay = 'http://sp:8000/acs.php';
$idp_metadata = file_get_contents('http://idp:8001/metadata.php');
// parse metadata to get sso URL (naively)
if (preg_match('/Location="([^"]+)"/', $idp_metadata, $m)) {
    $idp_sso = $m[1];
} else {
    die("Can't get IdP SSO URL");
}
header("Location: $idp_sso?ACS=".urlencode($relay)."&RelayState=foobar");
exit();

