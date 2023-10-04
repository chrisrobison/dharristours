const FORM_ID = '#messageForm'
$(function () {
  //Add text editor
  $('#compose-textarea').summernote()
  getMessages();
})

let checked = false

$(function () {

  $( $(FORM_ID)).validate({
    ignore: [],
    rules: {
      'content': {
        required: true,
        minlength: 10,
      },
    },
    messages: {
      'content': {
        required: "Please enter a message.",
        minlength: "Message is too short.",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback')
      element.closest('.form-group').append(error)
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid')
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid')
    },
    submitHandler: function(form) {
      console.log(checked)
      if(!checked){
        postMessage(form)
        return false
      }else{
        const formData = new FormData(form)
        formData.append('redirect', 'true')
        form.submit()
      }
    }
  })
})

$.fn.isInViewport = function() {
  var elementTop = $(this).offset().top;
  var elementBottom = elementTop + $(this).outerHeight();

  var viewportTop = $(window).scrollTop();
  var viewportBottom = viewportTop + $(window).height();

  return (elementBottom > viewportTop && elementTop < viewportBottom) || (elementTop < viewportTop && elementBottom > viewportBottom);
};

$(document).ready(function () {
  $(window).scroll(function () {

    $('.read-status.unread:visible:not(.reading)').each(function () {
      if( $(this).isInViewport()) $(this).addClass('reading')
    })
  })
})
function postMessage(e) {
  $(FORM_ID).addClass('submitting')
  $('.message-fail').hide()

  const data = { data: {...serializeForm()}, "type": 'post' };

  postData("/portal/messages.php", $.param(data), function (data) {
    if(data.status == 'error'){
      $('.message-fail').show()
    }
    if (data.status == 'ok') {
      getMessages()
      $('.message-success').show()
      $(FORM_ID).hide()
    }
  });

  $(FORM_ID).removeClass('submitting')
  return false;
}

function getMessages() {
  $(FORM_ID).addClass('submitting')

  const data = { data: {...serializeForm()}, "type": 'get' };
  postData("/portal/messages.php", $.param(data), function (data) {
    if (data.status !== 'ok') return
    const messageList= data.data
    $('.message-list').html(
        messageList
            .map(message => ({
              id: message.id,
              content: message.content,
              time: formatTime(message.created_at),
              img: formatImg(message.img),
              title:  formatTitle(message.FirstName, message.LastName, message.Login, message.Email),
              unread: message.unread,
            }))
            .map(PostTemplate)
            .join(''));

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

const formatTitle = (firstName, lastName, login, email) =>
    firstName || lastName
        ? `${firstName} ${lastName}`
        : login || email
const formatTime = time => time //todo - format time - JJ
const formatImg = img => img || '/portal/assets/img/person.png'
const PostTemplate = ({ id, content, time, img, title, unread }) => `
  <div class="post read-status ${unread ? 'unread' : 'read' } marked">
    <div class="user-block">
      <img class="img-circle img-bordered-sm" src="${img}" alt="user image">
      <span class="username">${title}</span>
      <span class="description">${time}</span>
    </div>
    <div class="message-content">
        ${content}
    </div>
  </div>
`;
/*<i class="read-icon fas fa-eye-slash" data-id="${id}"></i>
        <i class="read-icon fas fa-eye" data-id="${id}"></i>*/
