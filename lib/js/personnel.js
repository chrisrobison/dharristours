function makeDate(mm, dd, yyyy, curid, rsc, field) {
   var m = document.getElementById(mm);
   var d = document.getElementById(dd);
   var y = document.getElementById(yyyy);
   var dateInput = document.getElementById(field);
   dateInput.name = rsc + '[' + curid + '][' + field + ']';
   dateInput.value = y.value + '-' + m.value + '-' + d.value;
}

function makeTime(hh, mm, ampm, curid, rsc, field) {
   var h = document.getElementById(hh);
   var m = document.getElementById(mm);
   var a = document.getElementById(ampm);
   var timeInput = document.getElementById(field);
   timeInput.name = rsc + '[' + curid + '][' + field + ']';
   timeInput.value = h.value + ':' + m.value + ' ' + a.value;
}
           
function authorize(who) {
   var disp = who + 'disp';
   var inp = document.getElementById(who);
   var dis = document.getElementById(disp);
   var now = new Date();
   var month = now.getMonth() + 1;
   var date = now.getDate();
   var year = now.getFullYear();
   var hour = now.getHours();
   var minute = now.getMinutes();
   var second = now.getSeconds();
   var theDate = month + '/' + date + '/' + year + ' ' + hour + ':' + minute + ':' + second;
   inp.value = theDate;
   dis.innerHTML = theDate;
   var btn = document.getElementById(who + 'Button');
   if (btn) btn.style.display = 'none';
}
