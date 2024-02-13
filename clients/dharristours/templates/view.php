<?php
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
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
            font-size: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color:#aaa;
        }

        header {
            background-color: #999;
            color: #eee;
            height: 0vh;
        }

        main {
            background-color: #aaa;
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
        #customButtons {
            display: none;
        }
        label {
            width: 10rem;
            display: inline-block;
            text-align: right;
            margin-right: 0.5rem;
            font-size: 18px;
        }
        .contentField {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            margin-bottom: 0.25rem;
        }

        input,select {
            font-size: 18px;
            height: 1.7rem;
        }
        input[type='checkbox'] {
            height: 1.5rem;
            margin: 0 0.25rem 0 2rem;
        }
        fieldset {
            background-color:#ccc;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>
<body>
<main>
<?php
    if (isset($_REQUEST['rsc'])) {
        if (isset($_REQUEST['id'])) {
            $current = $boss->getObjectRelated($_REQUEST['rsc'], $_REQUEST['id']);
        }
    }
    if (isset($_REQUEST['tpl'])) {
        include($_REQUEST['tpl']);
    }
?>
</main>
<script>
simpleConfig = {
    current: <?php print json_encode($current); ?>,
    record: <?php print json_encode($current); ?>
};


(function() {
const $ = str => document.querySelector(str);
const $$ = str => document.querySelectorAll(str);

    const app = {
        data: {},
        state: {
            loaded: false
        },
        init: function() {
            if (window.updateTime) {
                setTime('Pickup', simpleConfig.current.PickupTime);
                setTime('DropOff', simpleConfig.current.DropOffTime);
            }
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
