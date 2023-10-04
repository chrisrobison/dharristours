const FORM_ID = '#registerForm'

$(function () {


  $( $(FORM_ID)).validate({
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
        //require_from_group: [1, '.contact-group'],
        required: true,
        email: true,
        remote: {
          url: 'https://dharristours.simpsf.com/portal/register.php',
          type: 'post',
          data: {
            type: 'checkEmail'
          }
        }
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
        remote: "Email already exists",
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
    },
    submitHandler: function(e) {
      doRegister(e)
      return false;
    }
  })
})

function doRegister(e) {
  $(FORM_ID).addClass('submitting')
  const data = { "data": serializeForm($(":input")), "type": 'register' };

  postData("https://dharristours.simpsf.com/portal/register.php", $.param(data), function (data) {
    console.log(data);
    if(data.status == 'error'){
      $('.register-fail').show()
      $('.register-form').hide()
    }
    if (data.status == 'ok') {
      $('.register-success').show()
      $('.register-form').hide()
    }
    if (data.status == 'exists') {
      $('.register-exists').show()
      $('.register-form').hide()
    }
  });

  $(FORM_ID).removeClass('submitting')
  return false;
}

function postData(url, data, callback) {

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

        if (($(this).attr("type") == "hidden") && ($(this).attr("rel") != "data")) {
          return true;
        }
        var tmp = buildObject(out[rsc], parts, val);
        out[rsc] = $.extend(out[rsc], tmp);
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
    obj[key] = buildObject(obj[key], keys, val);
  } else {
    obj[key] = val;
  }

  return obj;
}
