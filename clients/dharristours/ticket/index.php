<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    $in = $_REQUEST;

    if (array_key_exists('id', $in)) {
        $sql = "select * from Job where JobID='".mysqli_real_escape_string($link, $in['id'])."';";
        $results = mysqli_query($link, $sql);
        $current = mysqli_fetch_object($results);

        $results = mysqli_query($link, "select * from Request where JobID='".mysqli_real_escape_string($link, $in['id'])."';");
        $req = mysqli_fetch_object($results);

    }
    
    print_r($in);
    print_r($current);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Lexend", "Helvetica Neue", "Helvetica", sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color:#000;
        }

        header {
            background-color: #999;
            color: #eee;
            height: 0vh;
        }

        main {
            background-color: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        footer {
            background-color: #666;
            color: #eee;
            height: 0vh;
        }

        li {
            display: flex;
            flex-direction: row;
            white-space: nowrap;
        }
    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<main>
<div class="feedback" id="oldX"></div><div class="feedback" id="oldY"></div>
<div class="table">
  <div class="table-cell">
    <div id="ticket">
      <div class="row perforated first">
        <img class="logo" src="https://dharristours.simpsf.com/clients/dharristours/img/logo2.png" />
        <div class="right">
          <div class="label">Request Number</div>
          <div class="num"><?php print $current->RequestID; ?></div>
        </div>
      </div>
      <div class="row perforated destinations">
        <div class="waypoint">
          <div class="label">Pickup</div>
          <div class="airport"><?php print preg_replace("|([\-/,])|", "$1<br>\n", $current->PickupLocation); ?></div>
        </div>
        <?php
            $waypoints = preg_split("/\|/", $current->DropOffLocation);
            if (count($waypoints)) {
                foreach ($waypoints as $idx=>$waypoint) {
                    print "<div class='waypoint'><div class='label'>Stop #".($idx + 1)."</div>";
                    print "<div class='airport'>{$waypoint}</div></div>";
                }
            }
        ?>
        <div class="waypoint">
          <div class="label">Final Destination</div>
          <div class="airport"><?php print $current->FinalDropOffLocation; ?></div>
        </div>
      </div>
      <div class="row normRow">
        <div>
          <div class="label">Passengers</div>
          <div class="col"><?php print $current->NumberOfItems; ?></div>
        </div>
        
      </div>
      <div class="row normRow">
        <div class="col6">
          <div class="label">Departs in</div>
          <div class="countdown">---</div>
        </div>
        <div class="col6">
        </div>
      </div>
      <div class="row normRow">
      
        <div class="col6">
          <div class="label">Departs at</div>
          <div>8:00am</div>
        </div>
        <div class="col6">
          <div class="label">Arrives at</div>
          <div>10:35am</div>
        </div>
        
      </div>
      <div class="row">
        <div class="sparkler"></div>
      <img id="qr" src='https://quickchart.io/qr?text=https://dharristours.simpsf.com/portal/trips/view-quote.php?id=<?php print $in['id']; ?>&size=200' alt=''><div class="smalltext">Hologram must change for ticket to be valid</div>
      </div>
    </div>
  </div>
</div>
</main>
<script>
(function() {
    const app = {
        data: {
            job: <?php print json_encode($current); ?>,
            request: <?php print json_encode($req); ?>
        },
        state: {
            loaded: false,
            oldX: 0,
            oldY: 0
        },
        handleOrientation: function(e) {
            console.dir(e);    
            //grab the accelerometer values
            let myx = e.gamma; //exaggerate the effect
            let myy = e.beta ;
            let mya = e.alpha;
            
            if ((myx != app.state.oldX) || (myy != app.state.oldY)) {
                app.sparkle();
            }
            app.state.oldX = myx;
            app.state.oldY = myy;
        },
        setupOrientation: function() {
            if (window.DeviceOrientationEvent) {
                //wireup the event
                if (typeof DeviceMotionEvent.requestPermission === 'function') {
                    app.doSparkle();
                    // Handle iOS 13+ devices.
                    DeviceMotionEvent.requestPermission()
                      .then((state) => {
                        if (state === 'granted') {
                          window.addEventListener('devicemotion', app.handleOrientation);
                        } else {
                          console.error('Request to access the orientation was rejected');
                        }
                      })
                      .catch(console.error);
                } else {
                    // Handle regular non iOS 13+ devices.
                    window.addEventListener('deviceorientation', app.handleOrientation, false);
                }
            }
            return false;
        },
        init: function() {
            app.generateSparkles();
            document.querySelector("main").addEventListener("mousemove", app.sparkle);
            app.setupOrientation();
            app.state.loaded = true;
        },
        doSparkle: function() {
            app.sparkle();
            setTimeout(app.doSparkle, 5000);
        },
        fetch: function(url, callback) {
            fetch(url).then(response=>response.json()).then(data=>{
                app.data = data;
                app.state.loaded = true;
                if (callback && typeof(callback) === "function") {
                    callback(data);
                }
            });
        },
        display: function(data, tgt) {
            let out = "<table><thead><tr>";
            const keys = Object.keys(data[0]);
            if (keys) {
                keys.forEach(key => {
                    out += `<th>${key}</th>`;
                });
            }
            out += "</tr></thead><tbody>";
            data.forEach(item=>{
                out += `<tr>`;
                keys.forEach(key => {
                    out += `<td>${item[i]}</td>`;
                });
                out += `</tr>`;
            });
            out += "</tbody></table>";

            if (tgt) {
                tgt.innerHTML = out;
            }
            return out;
        },
        sparkle: function() {
            document.querySelectorAll('.sparkler>.square').forEach((item) => {
              item.style.backgroundColor = app.getColor();
              item.style.opacity = Math.random() + 0.3;
            });
        },
        generateSparkles: function() {
            var container = document.querySelector('.sparkler');
            var i = 0;
            for (i = 0; i < 64; i = i + 1) {
              var spark = document.createElement('div');
              spark.className = 'square';
              spark.style.backgroundColor = app.getColor();
              container.appendChild(spark);
            }
        },
        getColor: function() {
            var red = Math.floor(Math.random()*(255-200+1)+200)
            var green = Math.floor(Math.random()*(255-175+1)+175);
            var blue = Math.floor(Math.random()*(55-0+1)+0);
            return 'rgb('+ red + ',' + green +',' + blue + ', ' + Math.random() + ')';
        }

    }
    window.app = app;
    app.init();
})();
</script>
</body>

</html>
