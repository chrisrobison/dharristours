$.fn.clearForm = function() {
   return this.each(function() {
      var type = this.type, tag = this.tagName.toLowerCase(), dv;
      
      if (tag == 'form') {
         return $(':input',this).clearForm();
      }
      
      if (type == 'text' || type == 'password' || tag == 'textarea') {
         dv = $(this).attr('defaultValue');
         if (!dv) dv = $(this).attr('default');

         this.value = dv ? dv : "";
      } else if (type == 'checkbox' || type == 'radio') {
         this.checked = false;
      } else if (tag == 'select') {
         this.selectedIndex = -1;
      }
   });
};
//usage
//$('#flightsSearchForm').clearForm();

$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
      var parts = this.name.match(/(\w+)\[(\w+)\]\[(\w+)\]/);
      if (parts) {
         if (!o[parts[0]]) o[parts[0]] = [];
         if (!o[parts[0]][parts[1]]) o[parts[0]][parts[1]] = {};
         o[parts[0]][parts[1]][parts[2]] = this.value;
      } else {
         o[this.name] = this.value;
      }
    });
    return o;
};

