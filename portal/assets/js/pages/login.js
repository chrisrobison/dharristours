const FORM_ID = '#loginForm'
let checked = false

$(function () {

/*
  $( $(FORM_ID)).validate({
    rules: {
      'password': {
        required: true,
      },
    },
    messages: {
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
*/
})
function doLogin(e) {
  $(FORM_ID).addClass('submitting')
  console.log(serializeForm())

  const out = { ...serializeForm(), "check": 'true' };

  postData("https://dharristours.simpsf.com/portal/login.php", $.param(out), function (data) {
    console.log(data);
    if (data === 'true') {
      checked = true;
      let form = document.querySelector(FORM_ID);
      if (form) {
        form.action += document.location.search;
        document.querySelector("#url2").value = decodeURIComponent(document.location.search.replace(/^\?/, ''));
        console.log(`Submitting form to ${form.action}`);       // <---only doing all this to debug why '?url=...' query string not 
        form.submit()                                           //     being passed 
      }
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
