<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link href='../browse/browse.css' rel='stylesheet' type='text/css'>
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:"Open Sans", "Helvetica Neue", Optima, Verdana, sans-serif; }
         h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:0px; cursor: default; position:absolute; top:0px; bottom:0px; left:0px; right:0px; overflow:hidden;}
         #browse { position:absolute; top:0px;bottom:0px;width:18%; border-right:2px inset #ccc; left:0px; height:100%; }
         #query { position:absolute; top:0px;bottom:0px; left:18%; border-left:2px outset #ccc; right:0px; height:100%; width:81%;}
         li { z-index: 9999; }
         .ui-selecting { background: #feca40; }
         .ui-selected { background: #F39814; color: white; }
         input,textarea,select { z-index: 1; }
      </style>
  </head>
   <body>
      <div id='main'>
         <div id='browse'></div>
         <div id='query'></div>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type='text/javascript'>
      var simple = {};
      $(document).ready(function() {
         $("#query").load("/files/query/core.html");
         $("#main").on("click", "li.db", function(e) {
            var $this = $(this);
            $this.toggleClass("open").toggleClass("closed");
            if (!$this.next("ul").length) {
               getData('get-table-list', $this.attr('id'), 'table', $this, '');
               setDraggable('.table');
            } 
         }).on("click", "li.table", function(e) {
            var $this = $(this);
            $this.toggleClass("open").toggleClass("closed");
            if (!$this.next("ul").length) {
               getData('get-column-list', $this.parent().attr('id'), 'column', $this, $this.attr('id'));
               setDraggable('.column');
            }
         });
         $.getJSON("/files/browse/ctl.php?x=get-dbs", function(data) {
            var items = [];
            $.each(data, function(key, val) {
               items.push('<li class="db closed" id="' + val + '">' + val + '</li>');
            });
            $('<ul/>', {
               'class': 'open dbs',
               html: items.join('')
            }).appendTo("#browse");
            setDraggable('.dbs');
         });
         
         $("#sql").droppable({
            activeClass: "ui-state-hover",
            hoverClass: "ui-state-active",
            drop: function( event, ui ) {
               debugger;
               var val = $(this).val();
               $(this).addClass( "ui-state-highlight" ).val(val + " " + ui.draggable.text() );
                      
            }
         });
         function setDraggable(who) {
            var els = $(".table,.db");
            if (els.length) {
               els.sortable({ revert: false});
               els.draggable({
                  helper: "clone",
                  revert: "invalid"
               });
               $("ul,li").disableSelection();

            }
            var cols = $("ul.column");
            if (cols.length) {
               cols.selectable();
            }
            $("#sql").droppable({
            activeClass: "ui-state-hover",
            hoverClass: "ui-state-active",
            drop: function( event, ui ) {
               var $this = $(this),
                   val = $this.val();
               if (ui.draggable.hasClass('table')) {
                  val = "SELECT * FROM ";
               }
               $this.addClass( "ui-state-highlight" ).val(val + " " + ui.draggable.text() );
                      
            }
         });

         }

         function getData(action, db, cls, tgt, tbl) {
            // tbl = (tbl) ? '_' + tbl : '';
            var url = "/files/browse/ctl.php?x=" + action;
            if (db) {
               url += "&db=" + db;
               cls = "table closed";
            } else {
               cls = "db closed";
            }
            if (tbl) {
               url += "&tbl=" + tbl;
               cls = "column";
            }
            console.log("Fetching "+url);
            $.getJSON(url, function(data) {
               console.dir(data);
               var items = [];
               if (data) {
                  $.each(data, function(key, val) {
                     var out = '<li class="' + cls + '" id="' + val + '">';
                     if ((typeof val == "object") && (val != null)) {
                        out += dump(val);
                     } else {
                        out += val;
                     }
                     out += "</li>";
                     items.push(out);
                  });
                  var id = db;
                  id += (tbl) ? '.' + tbl : '';
                  $('<ul/>', {
                     'class': 'open ' + cls + ' ' + db + ' ' + tbl,
                     'id': id,
                     html: items.join('')
                  }).insertAfter(tgt);
               }
               setDraggable();
            });
         }
         function dump(obj) {
            var items = [];
            console.log("Dumping:");
            console.dir(obj);
            $.each(obj, function(key, val) {
               var out = '<li class="' + key + '">';
               if ((typeof val == "object") && (val != null)) {
                  out += dump(val);
               } else {
                  out += val;
               }
               out += val + "</li>";
               items.push(out);
            });
            return "<ul class='closed'>" + items.join('') + "</ul>";
         }
      });
   </script>
</html>
