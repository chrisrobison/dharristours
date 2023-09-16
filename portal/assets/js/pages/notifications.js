// Load notifications
$(document).ready(function () {
  getNotifications()
})

function getNotifications() {
  console.log('getNotifications')
  const data = { data: {}, "type": 'getNotifications' };
  postData("/dharristours/portal/messages.php", $.param(data), function (data) {
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


const formatUrl = (id, type) => `/portal/trips/view-${type}.php?id=${id}`
const formatTitle = (id, type) => `${type} #${id}`
const NotificationTemplate = ({ count, url, title }) => `
  <div class="dropdown-divider"></div>
  <a href="${url}" class="dropdown-item nav-link">
    <div class="title">${title}</div>
    <div>${count} new message${ count > 1 ? 's' : ''}</div>
  </a>
`;
