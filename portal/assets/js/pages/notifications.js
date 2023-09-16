(function ($, MsgThreadNotification) {
// Load notifications
  $(document).ready(function () {
    console.log(MsgThreadNotification)
    console.log('wry')
    console.log(MsgThreadNotification.MSG_RESOURCE_ID)
    console.log(MsgThreadNotification['MSG_RESOURCE_ID'])
    if (!MsgThreadNotification) {
      getNotifications()
      return
    }
    if (MsgThreadNotification.MSG_RESOURCE_ID && MsgThreadNotification.MSG_RESOURCE_TYPE) clearNotification()
  })

  function getNotifications() {
    console.log('getNotifications')
    const data = {data: {}, "type": 'getNotifications'};
    postData("/portal/messages.php", $.param(data), function (data) {
      if (data.status !== 'ok') return

      const notifications = data.data
      console.log(notifications)

      $('.notification-count').html(notifications.length)
      $('#notificationList').prepend(
          notifications
              .map(notification => ({
                count: notification.new_message_count,
                url: formatUrl(notification.resource_id, notification.resource_type),
                title: formatTitle(notification.resource_id, notification.resource_type),
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
        resource_type: MsgThreadNotification.MSG_RESOURCE_ID
      }, "type": 'clearNotification'
    };
    postData("/portal/messages.php", $.param(data), function (data) {
      console.log(data)
      if (data.status !== 'ok') return
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
})(jQuery, MsgThreadNotification);