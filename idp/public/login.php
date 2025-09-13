<?php
// Very naive IdP login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? 'unknown';
    $relay = $_POST['relayState'] ?? '';
    // build SAMLResponse
    $response = base64_encode("
    <samlp:Response xmlns:samlp=\"urn:oasis:names:tc:SAML:2.0:protocol\" 
       ID=\"_xyz\" IssueInstant=\"".gmdate('c')."\" Version=\"2.0\"
       Destination=\"".$relay."\">
      <saml:Issuer xmlns:saml=\"urn:oasis:names:tc:SAML:2.0:assertion\">http://idp:8001/metadata.php</saml:Issuer>
      <saml:Assertion xmlns:saml=\"urn:oasis:names:tc:SAML:2.0:assertion\">
         <saml:Issuer>http://idp:8001/metadata.php</saml:Issuer>
         <saml:Subject>
           <saml:NameID>".$user."</saml:NameID>
         </saml:Subject>
      </saml:Assertion>
    </samlp:Response>
    ");
    // Vulnerability: No signature, no signing key
    // Also no checks of audience, timestamp, etc.
    $acs = $_POST['ACS'];  // ACS URL of SP
    // redirect with SAMLResponse
    header("Location: $acs?SAMLResponse=".urlencode($response)."&RelayState=".urlencode($relay));
    exit();
}
?>
<form method="POST" action="login.php">
  <input name="username" placeholder="username" />
  <input type="hidden" name="ACS" value="<?php echo htmlspecialchars($_GET['ACS'] ?? '') ?>" />
  <input type="hidden" name="RelayState" value="<?php echo htmlspecialchars($_GET['RelayState'] ?? '') ?>" />
  <button type="submit">Login to IdP</button>
</form>
