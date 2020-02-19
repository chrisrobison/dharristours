function doSave() {
   frm = document.hosts;
   cur = frm.exec.value;

   if (cur != 'new') {
      frm.exec.value = 'update';
   }
   setTimeout('document.forms[0].submit();', 150);
}

function doDelete() {
   var OK = confirm("Are you sure you want to delete this\nentry from ALL web and dns servers?");
   if (OK) {
      document.forms[0].exec.value = 'delete';
      setTimeout("document.forms[0].submit();", 150);
      return true;
   } else {
      return false;
   }
}

function doNew() {
   frm = document.hosts;
   frm.exec.value = 'new';
   frm.hostname.value = '';
   frm.server_root.value = '';
   frm.docroot.value = 'htdocs';
   frm.cgidir.value = '';
   frm.access_log.value = 'logs/HOSTNAME.access_log';
   frm.error_log.value = 'logs/HOSTNAME.error_log';
   frm.user.value = '#REMOTE_USER#';
   frm.dns.checked = true;
   frm.client_code.selectedIndex = 0;
   frm.client_code.focus();

   return true;
}

function updateLogs() {
   frm = document.hosts;
   host = frm.hostname.value;
   frm.access_log.value = 'logs/'+host+'.access_log';
   frm.error_log.value = 'logs/'+host+'.error_log';
   frm.server_root.value = "#USER_HOME#/projects/"+host;

   return true;
}

function updateHostname(what) {
   var frm = document.forms[0];
   var tmphost = new String(what+'-'+frm.REMOTE_USER.value);
   var host = tmphost.toLowerCase();

   frm.cvs.checked = true;
   frm.hostname.value = host;
   updateLogs();
   return true;
}

