<?php $banner = 1; ?>
<?php isset($_GET["banner"]) ? $banner = $_GET["banner"] : $banner; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ads by Simple Banner Manager - by AliAdame (GitHub@aldaca15)</title>
<base target="_blank" />
<META name="ROBOTS" content="noindex, nofollow" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="pub" style=""><div style="text-align:center; top:50%;"><img src="data:image/gif;base64,R0lGODlhEAALAPQAAP///wAAANra2tDQ0Orq6gYGBgAAAC4uLoKCgmBgYLq6uiIiIkpKSoqKimRkZL6+viYmJgQEBE5OTubm5tjY2PT09Dg4ONzc3PLy8ra2tqCgoMrKyu7u7gAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCwAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27ifDgfkEYe04kDIDC5zrtYKRa2WQgAh+QQJCwAAACwAAAAAEAALAAAFJGBhGAVgnqhpHIeRvsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQJCwAAACwAAAAAEAALAAAFNiAgjothLOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh+QQJCwAAACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAkLAAAALAAAAAAQAAsAAAUyICCOZGme1rJY5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkECQsAAAAsAAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00kj5g0Al8tADY2y6C+4FIIACH5BAkLAAAALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpyHCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkECQsAAAAsAAAAABAACwAABS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7AAAAAAAAAAAA" /></div></div>
<div id="debug"></div>
<script type="text/javascript">
let xhr = new XMLHttpRequest();
xhr.open('GET', '../api/public/media/get/<?php echo $banner; ?>');

xhr.responseType = 'json';

xhr.send();

xhr.onload = function() {
  let responseObj = xhr.response;
  debugger;
  var content = "<a href='"+responseObj.destinationURL+"' target='_blank'><img src='"+responseObj.resource+"' width='"+responseObj.width+"' height='"+responseObj.height+"'/></a>";
  document.getElementById("pub").innerHTML = content;
};
</script>
</body>
</html>