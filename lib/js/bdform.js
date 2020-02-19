   function $(args) {
      var out = null;
      if (typeof(args) == 'string') {
         out = document.getElementById(args);
      } else if (typeof(args) == 'array') {
         out = [ ];
         for (var a in args) {
            out[out.length] = document.getElementById(args[a]);
         }
      } else if (typeof(args) == 'object') {
         out = args;
      }
      
      return out;
   }

   function strPad(str, pad) {
      return new Array((pad)? pad + 1 : 0).join(str);
   };

   function cellEdit(id) {
      this.id = id;
      this.cell = $(id);
      this.content = this.cell.innerHTML;
   }
   
   var editing = { };
   var editcell;
   
   function doEdit(evt) {
      evt = (evt) ? evt : window.event;
      var rows, curdata, commonAttr;
      document.getElementById('resultDisplay').style.display='none';
      var target = (evt.target) ? evt.target : evt.srcElement;
      if (target.id && target.id.match(/^input_/)) { return false; }
      if (editcell) {
         updateData(editcell.id, 'input_'+editcell.id);
         return false;
      }
      if (target) {
         editcell = new cellEdit(target.id);
         editcell.origClass = target.className;

         target.className = 'edit';
         if (!editing[target.id]) {
            curdata = target.innerHTML;

            commonAttr = "name='input_" + target.id + "' " + 
                         "id='input_" + target.id + "' " + 
                         "onblur=\"updateData('" + target.id + "', '" + 'input_' + target.id + "')\" " +
                         "onchange=\"updateData('" + target.id + "', '" + 'input_' + target.id + "')\" " +
                         "onkeypress=\"return doKeypress(event)\" " +
                         "style=\"width:" + ((target.scrollWidth<50) ? 50 : (target.scrollWidth - 15) ) + "px;\"";
            if (target.id.match(/BDField/)) {
               target.innerHTML = "<select " + commonAttr + ">" + buildOptionTree(srcFields, curdata, 1, '') + "</select>";
            } else if (target.id.match(/BNYField/)) {
               target.innerHTML = "<select " + commonAttr + ">" + buildOptionTree(bnyFields, curdata, 1, '') + "</select>";
            } else if (curdata.length > 40) {
               rows = parseInt(curdata.length / 40); if (rows<3) rows = 3;
               target.innerHTML = "<textarea rows='" + rows + "' " + commonAttr + ">" + curdata + "</textarea>";
            } else { target.innerHTML = "<input type='text' " + commonAttr + " value='" + curdata.replace(/\'/g, "&apos;") + "'/>"; }

            $('input_'+target.id).focus();
            positionResult('resultDisplay', evt.pageX, evt.pageY);
            editing[target.id] = 1;
         }
      }
   }

   function buildOptions(list, sel) {
      var s;
      var opts = "<option value=''></option>\n";
      for (var i in list) {
         s = (list[i] == sel) ? ' SELECTED' : '';
         opts += "<option value='" + list[i] + "'" + s + ">" + list[i] + "</option>\n";
      }
      return opts;
   }
   
   function buildOptionTree(list, sel, lvl, preval) {
      var s;
         var opts = '';
      if (!lvl) lvl = 0;
      if (!preval) preval = '';

      var opts = "<option value=''></option>\n";
      for (var i in list) {
         if (((typeof(list[i]) == 'array') || (typeof(list[i]) == 'object')) && (list[i] != '_ids')) {
            opts += "<option value='" + ((preval) ? preval + '.' + i : i) + "'>" + strPad('-', (lvl * 3)) + i + "</option>";
            opts += buildOptionTree(list[i], sel, (lvl + 1), ((preval) ? preval + '.' + i : i));
         } else {
            if (typeof(i)!='number') {
               opts += "<option value='" + ((preval) ? preval + '.' + i : i) + "'>" + strPad('-', (lvl * 3)) + i + "</option>";
            } else {
               opts += "<option value='" + ((preval) ? preval + '.' + list[i] : list[i]) + "'>" + strPad('-', (lvl * 3)) + list[i] + "</option>";
            }
         }
      }

      return opts;
   }

   function updateData(who, input) {
      var el = $(who);
      var inEl = $(input);
      var parts = who.split(/_/);
      var rec = { resource: parts[0], id: parts[1], field: parts[2] };
      
      if (el && inEl) {
         var newval = inEl.value;
         
         if (editcell.content != newval) {
            el.innerHTML = newval;
         
            // Send newval and resource/id/field to server here
            var scriptEl = document.createElement('script');
            scriptEl.type = 'text/javascript';
            scriptEl.src = 'dbctl.php?rsc=' + rec.resource + '&id=' + rec.id + '&field=' + rec.field + '&value=' + newval.replace(/\+/g, '%2b');
            document.body.appendChild(scriptEl);
            
            if (rec.resource=='BDForm') {
               var s2 = document.createElement('script');
               s2.type = 'text/javascript';
               s2.src = 'dbctl.php?x=sample&id=' + rec.id + '&rsc=' + rec.resource;
               document.body.appendChild(s2);
            }

         } else {
            el.innerHTML = editcell.content;
         }
      }
      editcell.cell.className = editcell.origClass;
      editing[who] = null;
      editcell = null;
   }
   
   function updateSample(id, result) {
      var td = $('BDForm_'+id+'_Sample');
      if (td) td.innerHTML = result;
   }

   function positionResult(tgt, x, y) {
      var disp = $(tgt);
      disp.style.top = y + 'px';
      disp.style.left = x + 'px';
   }

   function showResult(txt) {
      var disp = document.getElementById('resultDisplay');
      disp.innerHTML = txt;
      disp.style.display = 'block';
      disp.style.clip = "rect(0px, 2px, 2px, 0px)";

      slideOpen(disp, 5, 5);
      setTimeout(function() { document.getElementById('resultDisplay').style.display='none'; }, 5000);
   }
   
   function slideOpen(el, x, y) {
      var div = $(el);
      div.style.clip = "rect(0px, " + x + "px, " + y + "px, 0px)";
      x += div.scrollWidth * .1;
      y += div.scrollHeight * .1;
      
      if ((div.scrollWidth >= x) || (div.scrollHeight >= y)) {
         setTimeout(function() { slideOpen(el, x, y); }, 10);
      }
   }

   function dump(target) {
      if (!$('debug')) {
         var del = document.createElement('div');
         del.id = 'debug';
         document.body.appendChild(del);
      }
      $('debug').style.display = 'block';

      var dbg = '';
      for (var i in target) { if (target[i] && typeof(target[i]) != 'function') dbg += i + ': ' + target[i] + "\n"; }
      $('debug').innerHTML = '<pre>' + dbg + '</pre>';
   }

   function doKeypress(evt) {
      evt = (evt) ? evt : window.event;

      var key = (!evt.keyCode) ? evt.charCode : evt.keyCode;
      var shifted = evt.shiftKey;

      if (key == 27) {
         if (editcell) {
            editcell.cell.innerHTML = editcell.content;
            editcell.cell.className = editcell.origClass;
         }
         editing[editcell.id] = null;
         editcell = null;
         return false;
      } 
      if ((key == 13) && (evt.metaKey || evt.ctrlKey)) {
         if (editcell) {
            editcell.cell.innerHTML = editcell.content;
            editcell.cell.className = editcell.origClass;
         }
         editing[editcell.id] = null;
         editcell = null;
         return false;
      }
      return true;
   }

   window.onclick = doEdit;

