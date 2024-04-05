<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    
    $in = $_REQUEST;
    $out = new stdClass();

    if (array_key_exists('z', $in)) {
        $query = base64_decode($in['z']);
        $parts = preg_split("/=/", $query);
        $id = $parts[1];

        $sql = "UPDATE Request set ClientConfirmed=1 WHERE RequestID='".mysqli_real_escape_string($link, $id)."'";
        
        file_put_contents("/tmp/confirmations.log", date("Y-m-d h:i:s") . ": Updated RequestID $id with ClientConfirmed=1\n", FILE_APPEND);
        $result = mysqli_query($link, $sql);
        $updated = mysqli_affected_rows($link);
        $out->updated = $updated;
        $out->status = "ok";
        $result = mysqli_query($link, "SELECT * from Request WHERE RequestID={$id}");
        if ($result) {
            $rec = mysqli_fetch_object($result);
            $out->data = $rec;
        }

    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>D Harris Tours | Bus Quote Confirmation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Lexend", "Helvetica Neue", "Helvetica", sans-serif;
            margin: 0;
            padding: 0;
            font-size: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color:#fff;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<main>
<img src="/files/img/logo2.png">
<h1>Your quote approval has been received. </h1>
<h2>Check your email for details about your request.</h2>
<hr>
<p style="font-size: 1.5em;"><em>PLEASE NOTE:</em> All jobs require payment information for a credit card, purchase order or check, 7 days before the scheduled trip date in order for a reservation to be confirmed. You can view and update the details of your trip request by visiting the D Harris Tours Customer Portal at <a href="https://dharristours.simpsf.com/portal/trips/view-quote.php?id=<?php print $id; ?>" target="_blank">https://dharristours.simpsf.com/portal/trips/view-quote.php?id=<?php print $id; ?></a></p>
<a href="https://dharristours.simpsf.com/portal/">Click here to go to D Harris Tours Customer Portal</a>
</main>
<script>
const $ = str => document.querySelector(str);
const $$ = str => document.querySelectorAll(str);

(function() {
    const app = {
        data: {},
        state: {
            loaded: false
        },
        init: function() {
            app.state.loaded = true;
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
        }
    }
    window.app = app;
    app.init();
})();
</script>
</body>

</html>
