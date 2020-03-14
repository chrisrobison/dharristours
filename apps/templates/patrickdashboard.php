<?php  if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); ?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <style>
      
         /* Move inline styles into external stylesheet */
         body { font-family:"Helvetica Neue","Helvetica","Tahoma",sans-serif; margin:0;padding:0; }
         #dash { margin:1em; }
         h1 { margin:20px 0 0 0; }
         ol, ul { margin-top:0px; padding-left:1em; list-style-position:inside;cursor:default;}
         #main > ul > li, ol > li { font-size:2em;font-weight:bold; }
         ul ul { font-size: 1em; position:absolute;top:17em;}
         ul { position:relative; }
         ul li { text-align:center; height:10em;-moz-box-shadow:1em 1em 1em rgba(0,0,0,.4);-webkit-box-shadow:1em 1em 1em rgba(0,0,0,.4);box-shadow:1em 1em 1em rgba(0,0,0,.4);width:45em; }
         ul ul li { text-align:center; height:10em;-moz-box-shadow:0px 0px 0px rgba(0,0,0,.4);-webkit-box-shadow:0px 0px 0px rgba(0,0,0,.4);box-shadow:0px 0px 0px rgba(0,0,0,.4);}
         li.closed+ul, li.open+ul {  }
         li { padding:.5em; list-style-type:none; font-weight:normal; margin:1em; }
         /*li.closed:before {  font-weight:bold; font-size:10em;content: "+" " "; color:#eb6dc9; } 
         li.open:before { font-weight:bold;font-size:10em;content: "-" " "; color:#eb6dc9;} */
         .plus { font-size:10em;font-weight:bold;color:#fb7db5; position:relative;top:-50px;
         -webkit-text-shadow:-2px -1px 0px rgba(0,0,0,1);
         -moz-text-shadow:-2px -1px 0px rgba(0,0,0,1);
         text-shadow:-2px -1px 0px rgba(0,0,0,1);
         }
         li:before {  } 
         li.closed, li.open { float:left;width:12em;}
         li + ul { display:none; }
         .data { color:#0022ff; }
         .condition { color: #aa0000; }
         .task { color: #00aa99; }
         .action { color: #aa00ff; }
         .process { color: #cccc00; }
         .formHeading {display:none; }
         form { text-align:left; font-size:1.5em}
         form label { text-align:right; font-weight:normal;font-size:.75em;}
         label { display:inline-block; width:10em; vertical-align:top;}
         #add { padding-right:2em;padding-left 2em; font-size:1.1em;}
         input.boxValue, textarea { width: 15em; font-size:.75em;}
         .textBox { width:30em; }
         select { font-size:.75em; }
         legend { position:absolute; top:-.5em; }
         .plusWords { font-size:1.4em; position:relative; top:-2em; } 
         .punch:active { margin-top: 9px;
           box-shadow: 0pt 1px 10px 1px rgb(92, 139, 238) inset, 0pt 1px 0pt rgb(29, 44, 77), 0pt 2px 0pt rgb(31, 48, 83), 0pt 4px 3px 0pt rgb(17, 17, 17);
         }
         .punch {
           margin-top: 5px;
           background: none repeat scroll 0% 0% rgb(65, 98, 168);
           border-width: 1px;
           border-style: solid;
           border-color: rgb(56, 83, 140) rgb(31, 45, 77) rgb(21, 30, 51);
           -moz-border-radius: 2em; -webkit-border-radius: 2em; border-radius: 2em;
           -moz-box-shadow: 0pt 2px 20px 2px rgb(92, 139, 238) inset, 0px 2px 0pt rgb(29, 44, 77), 0pt 12px 0px rgb(31, 48, 83), 0pt 16px 8px 2px rgb(17, 17, 17);
           -webkit-box-shadow: 0pt 2px 20px 2px rgb(92, 139, 238) inset, 0px 2px 0pt rgb(29, 44, 77), 0pt 12px 0px rgb(31, 48, 83), 0pt 16px 8px 2px rgb(17, 17, 17);
           box-shadow: 0pt 2px 20px 2px rgb(92, 139, 238) inset, 0px 2px 0pt rgb(29, 44, 77), 0pt 12px 0px rgb(31, 48, 83), 0pt 16px 8px 2px rgb(17, 17, 17);
           color: rgb(255, 255, 255);
           font: bold 20px/1 "helvetica neue" ,helvetica,arial,sans-serif;
           margin-bottom: 10px;
           padding: 10px 0pt 12px;
           text-align: center;
           -moz-text-shadow: 1px -1px 2px rgb(30, 45, 77);
           -webkit-text-shadow: 1px -1px 2px rgb(30, 45, 77);
           text-shadow: 1px -1px 2px rgb(30, 45, 77);
         }
         .thoughtbot:active { 
            margin-top:9px;
         }
         .thoughtbot {
           margin-top:5px;
           background-color: #F26895;
           background-image: -moz-linear-gradient(center top , #F26895 0pt, #F26895 50%, #F15587 50%, #F15587 100%);
           /* background-image: -moz-linear-gradient(center top , rgb(238, 67, 46) 0%, rgb(198, 57, 41) 50%, rgb(181, 23, 0) 50%, rgb(137, 17, 0) 100%); */
           border: 1px solid rgb(149, 17, 0);
           border-radius: 5px 5px 5px 5px;
           box-shadow: 0px 0px 0px 1px rgba(255, 115, 100, 0.4) inset, 0pt 1px 3px rgb(51, 51, 51);
           color: rgb(255, 255, 255);
           font: bold 20px/1 "helvetica neue" ,helvetica,arial,sans-serif;
           padding: 12px 1em 14px;
           text-align: center;
           text-shadow: 0px -1px 1px rgba(0, 0, 0, 0.8);
         }
         #upload { float: left; }
         .add { float:right; }
         fieldset { border-radius:1em; -moz-border-radius:1em; -webkit-border-radius:1em;-moz-box-shadow:6px 1px 4px rgba(0,0,0,.4);-webkit-box-shadow:1px 6px 4px rgba(0,0,0,.4);box-shadow:1px 6px 4px rgba(0,0,0,.34); background-color:#c8ecff;line-height:2em;}
      </style>
  </head>
   <body>
      
      <div id='dash'>
         <h1>Simple Dashboard</h1>
         <p>Click a button below to get started.</p>
         <!--<button id='expandAll'>Expand All</button><button id='collapseAll'>Collapse All</button> -->
         <ul>
            <li class='punch'><a class="nav" href="/grid/?pid=11" title="Customer Jobs" rel="nav"><span class='plus'>+</span><br><span class='plusWords'>To Do's</span></a></li>
         </ul>
      </div>
   </body>
   <script type="text/javascript" src="/lib/js/ajaxupload.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $.fn.serializeObject = function() {
          var o = {};
          var a = this.serializeArray();
          $.each(a, function() {
            var parts = this.name.match(/(\w+)\[(\w+)\]\[(\w+)\]/);
            if (parts) {
               if (!o[parts[0]]) o[parts[0]] = [];
               if (!o[parts[0]][parts[1]]) o[parts[0]][parts[1]] = {};
               o[parts[0]][parts[1]][parts[2]] = this.value;
            } else {
               o[this.name] = this.value;
            }
          });
          return o;
      };
      $(document).ready(function() {
         $("li").each(function() { if ($(this).next().is('ul')) { $(this).addClass("closed"); }});
         $("li").click(function() { if ($(this).next().is('ul')) { $(".form").hide(); $(this).toggleClass("closed").toggleClass("open").next('ul').toggle(250);} });
         $("#expandAll").click(function() { $("li").removeClass("closed").addClass("open").next('ul').show(250);});
         $("#collapseAll").click(function() { $("li").removeClass("open").addClass("closed").next('ul').hide(250);});
         $("li > a").click(function(event) { 
            if ($(this).attr('href').match(/mailto:/)) return true;
            parent.loadUrl($(this).attr('href'), $(this).text(), $(this).attr('target')); 
            event.preventDefault();
            event.stopPropagation(); 
            return false;
            }); 
         // $(".textBox").parent().html("");
         $("form fieldset").append("<button class='add thoughtbot'>Save</button> ");
         $("form").submit(function(event) {
            //var data = { data: $(this).serializeObject(), x: "save", rsc:$(this).attr('rel') }
            if ($(this).attr("id") == "TechSupport") {
               $(this).submit();
            } else {
               var x = $(this).serialize();
               $.post("/grid/ctl.php?x=save&rsc="+$(this).attr('rel'), $(this).serialize(), function(data) {
                  $("body").append(data); 
                  alert("Save was successful.");
                  $("li").each(function() { if ($(this).next().is('ul')) { $(this).addClass("closed"); }});
               });
               event.preventDefault();
               event.stopPropagation(); 
               return false;
            }
         });
         /*
         new Ajax_upload($('.upload'), {
            action: '/apps/files/upload.php',
            onSubmit : function(file , ext){
               this.disable();
            },
            onComplete : function(file){
               this.enable();
            }     
         });   
         */

      });
   </script>
</html>
