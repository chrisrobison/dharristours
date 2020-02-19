 function bindFields() {  
     // the form that we are processing  
     var $templateHTML   = $(htmlForm);  
     // an array of all input elements in the html form that have the "data-bind" attribute  
     var $fieldArray     = $("[data-bind]:input",$templateHTML);  
     // a local reference to a data object (in this case, this.data would be the field data shown  
     // earlier in this article  
     var fdata           = this.data;  
   
     // will hold a reference to the current field  
     var $field          = "";  
     // will hold a reference to the current data item  
     var item            = "";  
     // will hold the fieldArray index  
     var index           = "";  
       
     // loop over the array of form fields  
     $.each(   
         $fieldArray,  
         function( index ) {  
             // a short reference to the form field  
             $field = $($fieldArray[index]);  
             // look to see if there is a value for a 'data-bind' reference  
             if( $field.attr('data-bind').length ) {  
                 var item = $field.attr('data-bind');  
                 // if the field type is text/textfield, it is a straight value assignment  
                 if ($field.attr('type') == 'text' || $field.is('textarea') ) {  
                     // set the default value for the form  
                     $field.attr('value', fdata[item]);  
                     // attach an event to listen for changes to the field  
                     $field.keyup(function(){  
                         fdata[item] = $(this).attr('value');  
                     });  
                 }  
                 // for checkboxes, we need to use :checked  
                 else if ($field.attr('type') == 'checkbox') {  
                     // check the field if the data value is true/1  
                     if( fdata[item] == 1)  
                         $field.attr("checked", "checked");  
                     // assign the event to update the date value  
                     $field.click(function() {  
                         fdata[item] = $(this).is(':checked') ? 1 : 0;  
                     });  
                 // for select statements, yet another assignment type  
                 } else if ($field.is("select")) {  
                     // this sets the currently selected dropdown value  
                     $field.val( fdata[item] );  
                     // assign a change event to update your data object  
                     $field.attr("value", fdata[item]).change (  
                         function() {  
                             fdata[item] = $(this).attr('value');  
                         }  
                     );  
                 }  
             }  
         }  
     );  
 }  
