<form id="chpass" name="chpass">
   <h1 class="boxHeading">Change Password</h1>
   <fieldset>
      <label>Current Password:</label> <input type='password' id='curpw' name='curpw' value='' /><br/>
      <label>New Password:</label> <input type='password' id='newpw' name='newpw' value='' /><br/>
      <label>Confirm Password:</label> <input type='password' id='confirmpw' name='confirmpw' value='' /><br/>
   </fieldset>
   <script>
      $("#chpass").submit(function() {
         if ($("#newpw").val() !== $("#confirmpw").val()) {
            
         }
      });
   </script>

</form>

