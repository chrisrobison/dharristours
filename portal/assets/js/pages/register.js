
$(function () {

  $('#registerForm').validate({
    rules: {
      'Login[new1][FirstName]': {
        required: true,
      },
      'Login[new1][LastName]': {
        required: true,
      },
      'Login[new1][Phone]': {
        require_from_group: [1, '.contact-group'],
      },
      'Login[new1][Email]': {
        require_from_group: [1, '.contact-group'],
        email: true,
      },
      'Login[new1][Passwd]': {
        required: true,
        minlength: 8
      },
      'confirm-password': {
        equalTo: '#password',
      },
      terms: {
        required: true
      },
    },
    messages: {
      'Login[new1][Phone]': {
        require_from_group: "Please enter your contact information."
      },
      'Login[new1][Email]': {
        require_from_group: "Please enter your contact information.",
        email: "Please enter a valid email address",
      },
      'Login[new1][Passwd]': {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long"
      },
      'confirm-password': {
              equalTo: "Password does not match"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback')
      element.closest('.input-group').append(error)
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid')
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid')
    }
  })
})
$(document).ready(function() {
  $('#registerForm').submit(doRegister)
})
function doRegister(e) {
  const data = { "data": serializeForm($(":input")), "type": 'register' };

  data['data']['Login']['new1']['Login'] = data['data']['Login']['new1']['FirstName'] + data['data']['Login']['new1']['LastName'];
  if ($("#sendEmail").length) {
    data['sendEmail'] = $("#sendEmail").val();
  }
  // todo - test sending of email - JJ

  postData("https://dharristours.simpsf.com/portal/register.php", $.param(data), function (data) {
    console.log(data,);
    if (data.status == 'ok' && data.e === undefined) window.location.href = "https://dharristours.simpsf.com/portal/login.html";
  });

  e.preventDefault()
  return false;
}

function postData(url, data, callback) {
  // check 'working' attribute in global config and only perform
  // one transaction at a time, deferring if busy

    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(msg) {
        callback(msg)
      }
    });

}

function serializeForm(who) {
  var out = {}, parts, val, key, rsc;

  who.each(function() {
    val = $(this).val();
    key = $(this).attr("name");
    parts = [];

    if (key && key !== 'confirm-password') {
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
