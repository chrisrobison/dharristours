<?php
    file_put_contents("unsub.txt", $_REQUEST['email']."\n", FILE_APPEND);
?>
<main>
<h1>Unsubscribe</h1>

<p>The email address <a href="mail:<?php print $_REQUEST['email']; ?>"><?php print $_REQUEST['email']; ?></a> has been unsubscribed from D Harris Tours Trip Notifications.</p>
<p>To resubscribe to these notifications, you may do so via our <a href="https://dharristours.simpsf.com/portal/">Customer Portal</a> at https://dharristours.simpsf.com/portal/.</p>
</main>

