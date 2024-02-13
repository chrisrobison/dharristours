// ----- On render -----
$(function() {
  var currentTime = moment().unix(); // Timestamp - Sun, 21 Apr 2013 13:00:00 GMT
  var eventTime = moment().unix() + 100000; // Timestamp - Sun, 21 Apr 2013 12:30:00 GMT
  var diffTime = (eventTime - currentTime);
  var duration = moment.duration(diffTime * 1000, 'milliseconds');
  var interval = 1000;

  setInterval(function() {
    duration = moment.duration(duration - interval, 'milliseconds');
    var text = '';
    if (duration.days() > 0) {
      var text = text + duration.days() + 'd ';
    } else if (duration.days() == 1) {
      var text = text + '1d';
    }
    text = text + duration.hours() + ":" + duration.minutes() + ":" + duration.seconds();
    $('.countdown').text(text);
  }, interval);

  var myx;
  var myy;
  var oldx;
  var oldy;
  //check for mobile and accerlerometer support
  document.querySelector("main").addEventListener("mousemove", function(e) {
      if (e.x != parseInt($('#oldX').text()) || e.y != parseInt($('#oldY').text())) {
        sparkle();
      }
        $('#oldX').text(e.x)
        $('#oldY').text(e.y)

  });

  if (window.DeviceOrientationEvent) {
    //wireup the event
    window.addEventListener('deviceorientation', function(e) {
        console.dir(e);    
      //grab the accelerometer values
      myx = Math.floor(e.gamma / 3); //exaggerate the effect
      myy = Math.floor(e.beta / 3);
      /*if (oldtarget.x != thetarget.x || oldtarget.y != thetarget.y) {*/
      if (myx != parseInt($('#oldX').text()) || myy != parseInt($('#oldY').text())) {
        sparkle();
      }
        $('#oldX').text(myx)
        $('#oldY').text(myy)
      /*}*/
    }, false);
  }
  sparkle();

  function sparkle() {
    $.each($('.sparkler>.square'), function(i, square) {
      $(square).css('background-color', getColor());
    })
  }
  function generateSparkles() {
    var container = $('.sparkler');
    var i = 0;
    for (i = 0; i < 64; i = i + 1) {
      var spark = $('<div class="square"></div>');
      spark.css('background-color', getColor());
      container.append(spark)
    }
  }
  function getColor() {
    var red = Math.floor(Math.random()*(255-200+1)+200)
    var green = Math.floor(Math.random()*(225-175+1)+175);
    var blue = Math.floor(Math.random()*(55-0+1)+0);
    return 'rgb('+ red + ',' + green +',' + blue + ')';
  }
  generateSparkles();
});
