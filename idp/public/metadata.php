<?php
// Simple metadata for IdP
header('Content-Type: application/xml');
echo <<<XML
<EntityDescriptor entityID="http://idp:8001/metadata.php"
    xmlns="urn:oasis:names:tc:SAML:2.0:metadata">
  <IDPSSODescriptor protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol">
    <SingleSignOnService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect"
      Location="http://idp:8001/sso.php"/>
  </IDPSSODescriptor>
</EntityDescriptor>
XML;
