<h1>Permission Denied</h1>
<h3>This user account has not been granted permission to access this section.</h3>
<p>The user account you are logged in with [<?php print $_SESSION['Login']->Email; ?>] does not
   have sufficient access rights to use the "<?php print $process->Process; ?>" component. 
</p>
<p>
   If you would like to request access to this section of the Simple Software application, 
   please contact your application administrator:</p>
<blockquote>
   <?php print "<a href='mailto:".$boss->app->Email."'>".$boss->app->Name.' &lt;'.$boss->app->Email."&gt;</a>";?>
</blockquote>
