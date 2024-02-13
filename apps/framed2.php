<?php
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   
   if ($in['pid'] || $in['ProcessID']) {
      $in['pid'] = ($in['pid'])?$in['pid']:($in['ProcessID']?$in['ProcessID']:0);
      if ($in['pid']) $process = $boss->getObject("Process", $in['pid']);
      if (!$in['rsc'] && $process->Resource) $in['rsc'] = $process->Resource;
   }
   
   if ($in['rsc'] && $in['id']) {
      $current = $boss->getObject($in['rsc'], $in['id']);
      $js = $boss->utility->js_serialize($current);
   }
   if ($in['x'] == 'new') {
      unset($current);
      unset($js);
   }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <style>
body, html,iframe { margin:0; padding:0; height:100vh; width: 100vw; box-sizing: border-box; }
body { display: flex; flex-direction: column; i}
.frameWrap { margin:0; padding:0; width: 100vw; height: 100vh; }
    </style>
</head>
<body>
<div class='frameWrap'><iframe class='framed' src="<?php print urldecode($in['url']); ?>" style='padding:0px;margin:0px;' width='100%' height='100%' border="0" scrolling="auto"></iframe></div>
</body>
