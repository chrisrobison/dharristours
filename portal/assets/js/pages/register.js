function doRegister(e) {
  // todo - simple validation and filling in of autogen fields - JJ
console.log(e)
  // $(".changed").removeClass("changed");
  // $(".modified").removeClass("modified");

  var data = { "data": serializeForm($(":input")), "x": 'new', "pid": 1, "rsc": 'Login' };

  console.log(data)

  if ($("#sendEmail").length) {
    data['sendEmail'] = $("#sendEmail").val();
  }

  // todo - test sending of email - JJ

  // postData("ctl.php", $.param(data));

  return false;
}

function serializeForm(who) {
  var out = {}, parts, val, key, rsc;

  who.each(function() {
    val = $(this).val();
    key = $(this).attr("name");
    parts = [];

    if (key) {
      trsc = key.match(/^([^\[]+)\[/);
      if (trsc) rsc = trsc[0].replace(/[\[\]]/g, '');
      parts = key.match(/\[([^\]]+)\]/g);
      if (parts) {
        // if (!out[rsc]) out[parts[1]] = {};
        // if (!out[rsc][parts[2]]) out[parts[1]][parts[2]] = {};
        if (($(this).attr("type") == "hidden") && ($(this).attr("rel") != "data")) {
          return true;
        }
        var tmp = buildObject(out[rsc], parts, val);
        out[rsc] = $.extend(out[rsc], tmp);
        // out[parts[1]][parts[2]][parts[3]] = val;
      }
    }
  });
  return out;
}

function buildObject(obj, keys, val) {
  var key = keys.shift().replace(/[\[\]]/g, '');
  if (!obj) obj = {};
  if (keys.length > 0) {
    if (!obj[key]) obj[key] = {};
    //obj[key] = $({}, obj[key], buildObject(obj[key], keys, val));
    obj[key] = buildObject(obj[key], keys, val);
  } else {
    obj[key] = val;
  }

  return obj;
}
