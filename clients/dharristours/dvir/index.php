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
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        header {
            height: 15vh;
        }

        main {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
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
        .file a {
         text-decoration:none;
         color: #000;
         transition: all 200ms linear;
         transform: scale(1);
        }
        .file a:hover {
         text-decoration: underline;
         color: #00c;
         transform: scale(1.1);
         }
        .file {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         border: 1px solid #0006;
         margin: 1rem;
         padding: 1rem;
         transition: all 200ms linear;
         transform: scale(1);
         }
         .file:hover {
            transform: scale(1.1);
            box-shadow: 5px 5px 5px #0006;
         }
         .file div { text-align: center; }

        .preview {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 43rem;
            border: 2rem solid #05c;
            top: 0vh;
            box-shadow: 0.25rem 1rem 1rem #0006;
            background:#fff;
        }
        #preview img {
            border-top: 1rem solid #fff;
            border-bottom: 2rem solid #fff;
            width: 25rem;
        }
        #preview.zoom img {
            width: 816px;
            height: 1043px;
            
        }
        .preview .click-button, #submitButton, #makePDF {
          height: 4rem;
          width: 15rem;
          margin: 0 auto;
          cursor: pointer;
          border-radius: 1rem;
          display: block;
        }
        /* .preview .click-button:before, #submitButton:before {
          content: "";
          height: 3.5rem;
        width: 15rem;
          border: 4px solid #04f;
          display: block;
          border-radius: 1rem;
          position: relative;
          top: -0.5rem;
          left: -0.5rem;
          opacity: 0.9;
          visibility: hidden;
        }
        .preview .click-button:hover:before, #submitButton:hover:before {
          visibility: visible;
          transform: scale(1.4);
          opacity: 0;
          transition: all ease-out 0.4s;
        }
        */
        #btns {
        display: flex;
        }
        .preview .popup {
            display:flex;
        flex-direction: column;
        align-items:center;
          background-color: #fff;
          border-radius: 6px;
          padding: 0rem 2rem 1rem 2rem;
          text-align: center;
          top: 0px;
          left: 0px;
          margin: 0 auto;
          visibility: hidden;
          transform: scale(0);
          transition: all ease-out 0.3s;
          align-content: center;
        }
        .preview.open .popup {
          visibility: visible;
          transform: scale(1);
          transition: all ease-out 0.3s;
        }
        .preview .popup .logo {
          height: 50px;
          display:none;
          width: 56rem;
          align-content: flex-start;
          font-size:38px;
          justify-items:center;
        justify-content:center;
          margin: 0 auto 0px;
        }
        .preview .info {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
        }
        .preview .popup h1,
        .preview .popup p,
        .preview .popup .logo,
        .preview .popup .btn {
          opacity: 0;
          transform: translateY(-10px);
          transition: all ease-out 0.5s;
        }
        .preview.open .popup h1,
        .preview.open .popup p,
        .preview.open .popup .logo,
        .preview.open .popup .btn {
          opacity: 1;
          transform: translateY(0);
          transition: all ease-out 0.5s;
          transition-delay: 0.5s;
        }
        .preview.open .popup .logo {
          transition-delay: 0.2s;
        }
        .preview.open .popup h1 {
          transition-delay: 0.4s;
        }
        .preview.open .popup p {
          transition-delay: 0.6s;
        }
        .preview.open .popup .btn {
          transition-delay: 0.8s;
        }
        .preview .popup h1 {
          color: #655f5f;
          margin-bottom: 20px;
        }
        .preview .popup p {
          color: #909090;
          line-height: 22px;
          padding: 0 20px;
        }
        .preview .btn {
          color: #fff;
          padding: 12px 20px;
          border-radius: 6px;
          background-color: #03A9F4;
          display: inline-block;
          margin-top: 20px;
        }
        div#preview {
        height:34rem;
        overflow:scroll;
        cursor:zoom-in;
        display:inline-block;
        background:#fff;
        border: 3px inset;
        }
        dialog::backdrop {
          background-color: rgb(0 0 0 / 0);
          transition:
            display 0.7s allow-discrete,
            overlay 0.7s allow-discrete,
            background-color 0.7s;
          /* Equivalent to
          transition: all 0.7s allow-discrete; */
        }

        dialog[open]::backdrop {
          background-color: rgb(0 0 0 / 0.5);
        }
        dialog[open] {
          opacity: 1;
          transform: scaleY(1);
        }

        /*   Closed state of the dialog   */
        dialog {
          opacity: 0;
          transform: scaleY(0);
          transition:
            opacity 0.7s ease-out,
            transform 0.7s ease-out,
            overlay 0.7s ease-out allow-discrete,
            display 0.7s ease-out allow-discrete;
          /* Equivalent to
          transition: all 0.7s allow-discrete; */
        }

        /*   Before-open state  */
        /* Needs to be after the previous dialog[open] rule to take effect,
            as the specificity is the same */
        @starting-style {
          dialog[open] {
            opacity: 0;
            transform: scaleY(0);
          }
        }

    .logo { 
        display: flex;
        align-items:center;
        justify-content:center;
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<header>
    <div class="logo"><img src="https://cdr2.com/crblog/assets/bus-logo.png" width="50">
    <h1>D Harris Tours</h1></div>
    <h2>Driver Vehicle Inspection Reports (DVIR)</h2>
</header>
<main>
<?php
    $files = glob("*.png");
    
    foreach ($files as $file) {
        $size = filesize($file);
        if ($size > 1024) {
            $size = round(($size / 1024) * 10) / 10;
            $size .= "kB";
        }
      print "<div class='file'><a onclick='app.viewFile(this.href, event);return false;' href='/files/dvir/$file' target='_blank'><img src='/files/dvir/$file' width='150'><div>$file [$size]</div></a></div>";
    }
?>
</main>
<dialog class="preview">
    <div class="content">
        <div id="popup-box" class="popup">
            <div class="logo"><img src="https://cdr2.com/crblog/assets/bus-logo.png" width="50">D Harris Tours</div>
            <div class="info">
                <h1>Viewing: <span id="viewing"></span></h1>
                <div id="preview"></div>
            </div>
            <a href="#" onclick="document.querySelector('.preview').classList.remove('open'); document.querySelector('.preview').close(); return false;" class="btn">Close Popup</a>
        </div>
    </div> 
</dialog>
<script>
(function() {
    const $ = str => document.querySelector(str);
    const $$ = str => document.querySelectorAll(str);

    const app = {
        data: {},
        state: {
            loaded: false
        },
        viewFile(file) {
            $(".preview").classList.add("open");
            $(".preview").showModal();
            let parts = file.split(/\//);
            let filepart = parts.pop();
            $("#viewing").innerHTML = filepart;
            let img = new Image();
            img.src = file;

            $("#preview").innerHTML = "";
            $("#preview").append(img);
        },
        init() {
            document.querySelector("#preview").addEventListener("click", function(evt) { document.querySelector("#preview").classList.toggle("zoom") }); 
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
