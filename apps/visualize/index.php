<?php 
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   $sys = new obj("SS_System","pimp","pimpin","localhost");
   $sys->addResource("App");
   $rows = $sys->App->getlist("1=1 order by Created");
   $cnt = 0;
   $counts = array();
   foreach ($rows as $idx=>$row) {
      $cnt++;
      $darr = preg_split("/\-/", $row->Created);
      $key = $darr[0].'-'.$darr[1];
      $counts[$key] = (!$counts[$key]) ? $cnt : $counts[$key] + 1;
      
   }
   $max = $cnt + 20;
   $months = array('01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
   $keys = array_keys($counts);
   foreach ($keys as $key) {
      list($yr,$mo) = preg_split("/\-/", $key);
      $fields[] = $months[$mo];
   }

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>Charting</title>
	<link href="/lib/css/basic.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="http://filamentgroup.github.com/EnhanceJS/enhance.js"></script>	
	<script type="text/javascript">
		// Run capabilities test
		enhance({
			loadScripts: [
				{src: '/lib/js/excanvas.js', iecondition: 'all'},
				'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js',
				'/lib/js/jquery.visualize.js',
            'simple.js'
			],
			loadStyles: [
				'/lib/css/visualize.css',
				'/lib/css/visualize-dark.css'
			]	
		});   
    </script>
</head>
<body>

<table>
	<caption><?php print $in['title']; ?></caption>
	<thead>
		<tr>
			<td></td>
			<?php 
            $cnt = count($fields);
            $year = 2010;
            for ($i=0; $i<($cnt+1); $i++) {
               $label = "";
               if ($i % 2) {
                  $label = $fields[$i];
               }
               if ($fields[$i] == "Jan") {
                  $year++;
                  $label = $year;
               }
               print '<th scope="col">' . $label . '</th>';
            }
         ?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Signups</th>
			<?php
            $cnt = count($counts);
            foreach ($counts as $count) {
               print "<td>$count</td>";
            }
         ?>
            <td></td>
		</tr>
	</tbody>
</table>	

</body>
</html>
