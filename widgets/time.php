   <script>
      function updateTime(who) {
         $("#" + who + "-time").val(
            $("#" + who + "-hour").val() + ':' +  
            $("#" + who + "-minute").val() +  
            $("#" + who + "-meridian").val()
         );
      }
   </script>
   <select id='#widgetID#-hour' onchange="updateTime('#widgetID#');">
      <option>01</option>
      <option>02</option>
      <option>03</option>
      <option>04</option>
      <option>05</option>
      <option>06</option>
      <option>07</option>
      <option>08</option>
      <option>09</option>
      <option>10</option>
      <option>11</option>
      <option>12</option>
   </select>
   :
   <select id='#widgetID#-minute' onchange="updateTime('#widgetID#');">
      <option>00</option>
      <option>15</option>
      <option>30</option>
      <option>45</option>
   </select>
   <select id='#widgetID#-meridian' onchange="updateTime('#widgetID#');">
      <option>pm</option>
      <option>am</option>
   </select>
   <input type="hidden" id="#widgetID#-time" name="#widgetID#-time" ></input>

