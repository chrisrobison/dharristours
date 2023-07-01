const FORM_ID = '#loginForm'
let checked = false

$(function () {


  $( $(FORM_ID)).validate({
    rules: {
      'email': {
        required: true,
        email: true,
      },
      'password': {
        required: true,
      },
    },
    messages: {
      'email': {
        email: "Please enter a valid email address",
      },
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
    submitHandler: function(form) {
      if(!checked){
        doLogin(form)
        return false
      }else{
        const formData = new FormData(form)
        formData.append('redirect', 'true')
        form.submit()
      }
    }
  })
})

function doLogin(e) {
  $(FORM_ID).addClass('submitting')
  console.log(serializeForm())

  const data = { ...serializeForm(), "check": 'true' };

  postData("https://dharristours.simpsf.com/portal/login.php", $.param(data), function (data) {
    console.log(data);
    if(data === 'true'){
      checked = true
      $(FORM_ID).submit()
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
  const result = {}
  $.each($(FORM_ID).serializeArray(), function () {
    result[this.name] = this.value;
  });
  return result
}
