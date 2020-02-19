<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   if ($in['path']) {
      $path = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$in['path'];
      $brush = preg_replace("/[^\.]*\./", '', $in['path']); 
      if ($path == "php") {
         $brush .= " html-script: true;";
     }
   }
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Code Viewer</title>
      <link href="http://alexgorbatchev.com/pub/sh/current/styles/shCore.css" rel="stylesheet" type="text/css" />
      <link href="http://alexgorbatchev.com/pub/sh/current/styles/shThemeEclipse.css" rel="stylesheet" type="text/css" />
      <script src="http://alexgorbatchev.com/pub/sh/current/scripts/shCore.js" type="text/javascript"></script>
      <script src="http://alexgorbatchev.com/pub/sh/current/scripts/shBrushXml.js" type="text/javascript"></script>
      <script src="http://alexgorbatchev.com/pub/sh/current/scripts/shAutoloader.js" type="text/javascript"></script>
      </head>
   <body>
      <div id='code'>
<pre type="syntaxhighlighter" class="brush: <?php print $brush; ?>;">
<?php
            if ($path) {
               $code = file_get_contents($path);
               if ($code) {
                  // highlight_string($code);
                  print htmlspecialchars($code);
               }
            }
         ?>
</pre>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         function path() {
           var args = arguments, result = [];
           for (var i=0; i<args.length; i++) result.push(args[i].replace('@', 'http://alexgorbatchev.com/pub/sh/current/scripts/'));
           return result
         };
          
         SyntaxHighlighter.autoloader.apply(null, path(
           'applescript            @shBrushAppleScript.js',
           'actionscript3 as3      @shBrushAS3.js',
           'bash shell             @shBrushBash.js',
           'coldfusion cf          @shBrushColdFusion.js',
           'cpp c                  @shBrushCpp.js',
           'c# c-sharp csharp      @shBrushCSharp.js',
           'css                    @shBrushCss.js',
           'delphi pascal          @shBrushDelphi.js',
           'diff patch pas         @shBrushDiff.js',
           'erl erlang             @shBrushErlang.js',
           'groovy                 @shBrushGroovy.js',
           'java                   @shBrushJava.js',
           'jfx javafx             @shBrushJavaFX.js',
           'js jscript javascript  @shBrushJScript.js',
           'perl pl                @shBrushPerl.js',
           'php                    @shBrushPhp.js',
           'text plain             @shBrushPlain.js',
           'py python              @shBrushPython.js',
           'ruby rails ror rb      @shBrushRuby.js',
           'sass scss              @shBrushSass.js',
           'scala                  @shBrushScala.js',
           'sql                    @shBrushSql.js',
           'vb vbnet               @shBrushVb.js',
           'xml xhtml xslt html    @shBrushXml.js'
         ));
         SyntaxHighlighter.all();         
      });
   </script>
</html>
