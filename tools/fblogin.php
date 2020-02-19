<!DOCTYPE html>
<html>
  <head>
    <title>Facebook Client-side Authentication Example</title>
    <style>
      #me-dump { margin: 1em; }
      #me-dump label { display: inline-block; font-weight: bold; text-align:right; width:7em; }
   </style>
  </head>
  <body>
    <div id="fb-root"></div>
    <h1>Facebook Client-side Authentication Example</h1>
   <div class="fb-login-button">Login with Facebook</div>

      <div id="auth-status">
        <div id="auth-loggedout">
          <a href="#" id="auth-loginlink">Login</a>
        </div>
        <div id="auth-loggedin" style="display:none">
          Hi, <span id="auth-displayname"></span>  
        (<a href="#" id="auth-logoutlink">logout</a>)
      </div>
      <div id="me-dump"></div>
    </div>

   </body>
    <script>
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));

      // Init the SDK upon load
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '173610695992707', // App ID
          channelUrl : '//'+window.location.hostname+'/channel', // Path to your Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });

        // listen for and handle auth.statusChange events
        FB.Event.subscribe('auth.statusChange', function(response) {
          if (response.authResponse) {
            // user has auth'd your app and is logged into Facebook
            FB.api('/me', function(me){
              if (me.name) {
                document.getElementById('auth-displayname').innerHTML = me.name;
                
                out = "";
                for (var i in me) {
                  if (me.hasOwnProperty(i)) {
                     out += "<div class='item'><label>" + i + ":</label> <span>" + me[i] + "</span></div>\n";
                  }
                }
                document.getElementById("me-dump").innerHTML = out;

              }
            })
            document.getElementById('auth-loggedout').style.display = 'none';
            document.getElementById('auth-loggedin').style.display = 'block';
          } else {
            // user has not auth'd your app, or is not logged into Facebook
            document.getElementById('auth-loggedout').style.display = 'block';
            document.getElementById('auth-loggedin').style.display = 'none';
          }
        });

        // respond to clicks on the login and logout links
        document.getElementById('auth-loginlink').addEventListener('click', function(){
          FB.login();
        });
        document.getElementById('auth-logoutlink').addEventListener('click', function(){
          FB.logout();
        }); 
      } 
    </script>

   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         
      });
   </script>
</html>
