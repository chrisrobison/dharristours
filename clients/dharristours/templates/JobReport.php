<a href='report.php?ReportID=1&JobID=<?=$in['JobID']?>' class='viewChart' target='_blank'>DHarris</a>
<div class='current' style='margin: 2em;'>
      <h1><?php print $current->Job; ?></h1>
      <h2><?php print $current->Business[0]->Business; ?></h2>
      <h3><?php print $current->JobDate; ?> </h3>
</div>
