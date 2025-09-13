<?php
// Entry point: redirect user to login form with ACS and RelayState
$acs = $_GET['ACS'] ?? '';
$relay = $_GET['RelayState'] ?? '';
?>
<!doctype html>
<html><body>
  <a href="login.php?ACS=<?php echo urlencode($acs) ?>&RelayState=<?php echo urlencode($relay) ?>">Login at IdP</a>
</body></html>
