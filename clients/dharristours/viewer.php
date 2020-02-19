
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SQL Query Builder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="core.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">SQL Query Builder</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" id='current-user' class="navbar-link">Username</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list"> </ul>
          </div>
        </div>
        <div class="span9">
          <div id="tables" class="well droppable"><span class='droptgt'>Drag Tables Here</span><canvas id='tables-canvas' width='100%' height='100%'></canvas></div>
          <div id="fields" class="well droppable"><span class='droptgt' style='display:none'>Drag Fields Here</span>
            <ul class="nav nav-tabs">
               <li class="active"><a href="#SELECT" data-toggle="tab">SELECT</a></li>
               <li><a href="#FROM" data-toggle="tab">FROM</a></li>
               <li><a href="#WHERE" data-toggle="tab">WHERE</a></li>
               <li><a href="#ORDER" data-toggle="tab">ORDER BY</a></li>
               <li><a href="#GROUP" data-toggle="tab">GROUP BY</a></li>
               <li><a href="#HAVING" data-toggle="tab">HAVING</a></li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="SELECT">
                  <table id='queryfields'>
                     <thead>
                        <tr>
                           <th>&#9737;</th>
                           <th>Output</th>
                           <th>Field/Expression</th>
                           <th>Aggregate</th>
                           <th>Alias</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane" id="FROM"> </div>
               <div class="tab-pane" id="WHERE"> </div>
               <div class="tab-pane" id="ORDER"> </div>
               <div class="tab-pane" id="GROUP"> </div>
               <div class="tab-pane" id="HAVING"> </div>
            </div>
          </div>
          <div id="sql" class="well">
            <div id='mysql'></div>
          </div>
          <div class="row-fluid">
          
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Simple Software, Inc. 2012</p>
      </footer>

    </div><!--/.fluid-container-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
    <script src="/lib/js/jquery.jsPlumb-1.3.16-all-min.js" type="text/javascript"></script>
    <script src="jquery.ui.touch-punch.min.js"></script>
    <script src="sql.js" type="text/javascript"></script>
    <script src="jsplumb/links.js"></script>
    </body>
</html>
