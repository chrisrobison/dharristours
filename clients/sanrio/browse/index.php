<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
      <link href='/files/browse/browse.css' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <div id='main'>
         <h1 class='heading'>Sanrio DB Browser</h1>
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      var simple = {};
      $(document).ready(function() {
         $("#main").on("click", "li.db", function(e) {
            var $this = $(this);
            $this.toggleClass("open").toggleClass("closed");
            if (!$this.next("ul").length) {
               getData('get-table-list', $this.attr('id'), 'table', $this, '');
            } 
         }).on("click", "li.table", function(e) {
            var $this = $(this);
            $this.toggleClass("open").toggleClass("closed");
            if (!$this.next("ul").length) {
               getData('get-column-list', $this.parent().attr('id'), 'column', $this, $this.attr('id'));
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
            }).appendTo("#main");
         });

         // getData('get-dbs|get-table-list|get-column-list', db, 'db|table|column', $this, $this.attr('id'));
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
