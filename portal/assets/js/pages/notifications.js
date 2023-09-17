(function ($, MsgThreadNotification, window) {
// Load notifications
  $(document).ready(function () {
    if (!MsgThreadNotification) {
      getNotifications()
      window.addEventListener('message', function(e){
        if(e.origin != window.location.origin) return
        if(e.data === 'notificationCleared') getNotifications()
      })

      return
    }
    if (MsgThreadNotification.MSG_RESOURCE_ID && MsgThreadNotification.MSG_RESOURCE_TYPE) {
      clearNotification()
    }
  })

  function getNotifications() {
    console.log('getNotifications')
    const data = {data: {}, "type": 'getNotifications'};
    postData("/portal/messages.php", $.param(data), function (data) {
      if (data.status !== 'ok') return

      const notifications = data.data
      console.log(notifications)

      if(!notifications.length){
        $('.notification-count').html('')
        return
      }

      $('.notification-count').html(notifications.length)
      $('#notificationList').prepend(
          notifications
              .map(notification => ({
                count: notification.NewMessageCount,
                url: formatUrl(notification.ResourceID, notification.ResourceType),
                title: formatTitle(notification.ResourceID, notification.ResourceType),
              }))
              .map(NotificationTemplate)
              .join(''));
    });

  }

  function clearNotification() {
    console.log('clearNotification')
    const data = {
      data: {
        resource_id: MsgThreadNotification.MSG_RESOURCE_ID,
        resource_type: MsgThreadNotification.MSG_RESOURCE_TYPE
      }, "type": 'clearNotification'
    };
    postData("/portal/messages.php", $.param(data), function (data) {
      console.log(data)
      if (data.status !== 'ok') return
      console.log(window.parent)
      window.parent.postMessage('notificationCleared', '*')
    });

  }

  function postData(url, data, callback) {

    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function (msg) {
        callback(msg)
      }
    });

  }


  const formatUrl = (id, type) => `/portal/trips/view-${type}.php?id=${id}`
  const formatTitle = (id, type) => `${type} #${id}`
  const NotificationTemplate = ({count, url, title}) => `
  <div class="dropdown-divider"></div>
  <a href="${url}" class="dropdown-item nav-link">
    <div class="title">${title}</div>
    <div>${count} new message${count > 1 ? 's' : ''}</div>
  </a>
`;
})(jQuery, window.MsgThreadNotification, window);