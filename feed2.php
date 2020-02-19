<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
      <style>
         body { font-size:12px; }
         div#feed { position:relative;width:600px; }
         .rssItem { padding:1em 2em 2em 2em; margin:0 1em 1em 1em; border:1px solid #999; -moz-border-radius:1em;-webkit-border-radius:1em;border-radius:1em;max-width:600px;}
         .rssItem p.description { margin:0;padding:0; width:auto;}
         .rssItem p.description a { margin-left:1em; }
         .rssItem:hover { -moz-box-shadow:4px 4px 8px rgba(0,0,0,.4); -webkit-box-shadow:4px 4px 8px rgba(0,0,0,.4);box-shadow:4px 4px 8px rgba(0,0,0,.4);}
         .rssItem .readMore { float:right; font-size:.8em;}
         .toggle .postTitle { font-weight: normal; padding: .25em 0 .25em 0; margin:0px; font-size:1em; }
         .toggle p { margin: .25em 0; }
         li.toggle {
            line-height:1.25em;
            list-style-position: outside;
            background-repeat: no-repeat;
         }
         li.closed {
            list-style-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAMAAADXT/YiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGBQTFRF6ebg2dTI6ObfzMS0+Pj3y8Oz9/fz8PDr6uniiaXD4t7V5OHY3trQ19HE8e/q2dTH9/by+Pj1z8i49fTx8/Pv3djOvMvbvMvc+Pj2y8OyiaXC/f38iKXC////AAAAiabDWBycOAAAAE1JREFUeNocxtkCQCAQBdBrJ7sS1Zj7/38pztOB58BIxgt8fpaQlJKmbRHwrne9HQi2+hnzrOu0h8krzaRnMUfIejQhhIrwIszkegUYAFK+BzpchA2iAAAAAElFTkSuQmCC");
         }
         li.open {
            list-style-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAMAAADXT/YiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGBQTFRF6ebf3trQ9PTwy8Oz6ujhzMS04t7W+Pj32dTH19HE4d3T6Obfz8i4iaXD2dTI8/Pu9/fz8O/p5OHY9vTyvMvb+Pj13djOvMvc+Pj2y8OyiaXC/f38iKXCAAAA////iabDtrsh+gAAAEpJREFUeNocxlcCQDAUBMDVuySke+z9bynM18ByYyZzAJ/fScj10UbAODgXFQjq+3OU1cqYFnPZ0lfe71OGjGuTUuoIK8JCwivAAFBNBxdPC2tDAAAAAElFTkSuQmCC);
         }
         .knob { cursor:default;font-family: Helvetica,Verdana,Arial,sans-serif; font-size:12px; padding:1px 3px 3px 1px; margin:0 .5em 0 0; line-height:.5em; text-align:center; border: 1px solid #333333; display: inline-block; width: 5px; height: 4px; top: -2px; position: relative; vertical-align:middle; }
         .knob_shadow { -moz-box-shadow: 0px 1px 3px rgba(0,0,0,.5); -webkit-box-shadow: 0px 1px 3px rgba(0,0,0,.5); box-shadow: 0px 1px 3px rgba(0,0,0,.5); }
      </style>
  </head>
   <body>
      <div id='feed'>
         
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="/lib/js/rss.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         <?php
            $url = ($_GET['pid']) ? 'rss.php?pid='.$_GET['pid'] : $_GET['feed'];
         ?>
         jsonRSS('<?php print $url ?>', $('#feed'));
         var rssPar;
         $(".toggle").live('click', function(event) {
            event.preventDefault();
            $(this).css('MozUserSelect','none');
            if ($(".rssItem", $(this)).is(":hidden")) {
               $(".rssItem", $(this)).slideDown(200);
            } else {
               $(".rssItem", $(this)).slideUp(200);
            }
            $(this).toggleClass("open").toggleClass('closed');
            return false;
         });
      });
   </script>
</html>
