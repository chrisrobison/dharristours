  <link href="/lib/jsoneditor.css" rel="stylesheet" type="text/css">
  <script src="/lib/jsoneditor.js"></script>

  <style>
    code {
      background-color: #f5f5f5;
    }

    #jsoneditor {
      width: 35em;
      height: 34em;
      margin-left: 1em;
    }
  </style>
  <script>
   let currentJson, editor;
     function loadJson(content) {
        console.log("loadJson");
        console.dir(content);
        currentJson = content;

        let opts = {
          mode: 'tree',
          modes: ['code', 'form', 'text', 'tree', 'view', 'preview'], // allowed modes
          onModeChange: function (newMode, oldMode) {
            console.log('Mode switched from', oldMode, 'to', newMode)
          }
        }

         if (!editor) {
            editor = new JSONEditor(document.querySelector("#jsoneditor", opts, content));
         } else {
            editor.update(content);
         }
     }

  </script>
</head>
<body>

<div class='tableGroup'>
   <div class='formHeading'>Model ID: <?php print $current->ModelID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Model</label><input type='text' dbtype='varchar(100)' name='Model[<?php print $current->ModelID; ?>][Model]' id='Model' value='<?php print $current->Model; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Process </label><?php $boss->db->addResource("Process");$arr = $boss->db->Process->getlist();print $boss->utility->buildSelect($arr, $current->ProcessID, "ProcessID", "Process", "Model[$current->ModelID][ProcessID]");?></div>
         <div class='contentField'><label>Resource</label><input type='text' dbtype='varchar(100)' name='Model[<?php print $current->ModelID; ?>][Resource]' id='Resource' value='<?php print $current->Resource; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Config</label><textarea onchange="window.loadJson(JSON.parse(this.value))" dbtype='text' name='Model[<?php print $current->ModelID; ?>][Config]' id='Config' class='textBox'><?php print $current->Config; ?></textarea></div>
         <div class='contentField'>
            <label>Login </label>
            <?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "Model[$current->ModelID][LoginID]");?>
         </div>
         <div class='contentField' style='clear:left'>
            <label>Notes</label><textarea dbtype='text' name='Model[<?php print $current->ModelID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'>
                  <?php print $current->Notes; ?>
            </textarea>
         </div>
      </div>
      <div class='fieldcolumn'>
         <div style="width:500px;height:500px;" id="jsoneditor"></div>
      </div>
   </div>
</div>
<script>
  const container = document.getElementById('jsoneditor')

  let options = {
    mode: 'tree',
    modes: ['code', 'form', 'text', 'tree', 'view', 'preview'], // allowed modes
    onModeChange: function (newMode, oldMode) {
      console.log('Mode switched from', oldMode, 'to', newMode)
    }
  }

  let json = {
    "array": [1, 2, 3],
    "boolean": true,
    "null": null,
    "number": 123,
    "object": {"a": "b", "c": "d"},
    "string": "Hello World"
  }

  let editor = new JSONEditor(container, options, json)

</script>
