<!doctype html>
<html>
<head>
  <title>Stay Fit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <script type="text/javascript">
    var appUrl = '<?php echo APP_URL ?>';
  </script>

  
 <!--javasript-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.mobile.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script >
var panel = '<div data-role="panel" id="mypanel" data-position="left" data-display="push" data-theme="b"><ul data-role="listview" data-inset="true"><li data-icon="home" data-iconpos="right" ><a href="<?php echo APP_URL?>?action=exercise">Home</a></li><li data-icon="user" data-iconpos="right" ><a href="#">Preference</a></li><li data-icon="grid" data-iconpos="right"><a href="<?php echo APP_URL?>?action=activity">Activity Log</a></li><li data-icon="info" data-iconpos="right"><a href="<?php echo APP_URL?>?action=help">Help</a></li></ul></div>';
$(document).one('pagebeforecreate', function () {
    $.mobile.pageContainer.prepend(panel);
    $("#mypanel").panel().enhanceWithin();
});
</script>

<!--stylesheets-->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/jquery.mobile.css">


</head>
<body>

