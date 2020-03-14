      <div id='chpassDialog' title='Change Password'>
         <p>To change your password, enter your existing password below then enter a new password (with confirmation) and click the "Change Password" button.</p> 
         <p class="validateTips"></p>
         <form id='chpass' method='post' action='new.php'>
            <input type='hidden' name='x' id='x' value='chpass'>
            <label for='oldPass' title="Enter your current password">Current Password</label> <input type='password' id='oldPass' name='oldPass' default=''><br>
            <label for='newPass'>New Password</label> <input type='password' id='newPass' name='newPass' class='empty' default=''><br>
            <label for='confirmPass'>Confirm Password</label> <input type='password' id='confirmPass' name='confirmPass' class='empty' default=''><br>
         </form>
         <div id='chpassResults'></div>
         <div id='loading'><h2>Changing Password...</h2><img src="/img/anigears.gif"></div>
      </div>
