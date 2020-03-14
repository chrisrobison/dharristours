
function getDate() {
   var now = new Date();
   var day = now.getDate();
   var mo = now.getMonth();
   var yr = now.getFullYear();
   var hr = now.getHours();
   var min = now.getMinutes();

   if (mo < 10) {
      mo = '0' + mo;
   }
   if (day < 10) {
      day = '0' + day;
   }
   today = yr+'-'+mo+'-'+day+' '+hr+':'+min+':00';

   return today;
}
