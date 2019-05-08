<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>preview</title>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
  <script type='text/javascript' src="http://stratus.sc/stratus.js"></script>

<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
  //console.log(parent.url_resource);

  $(document).ready(function(){
        $('body').stratus({
          auto_play: false,
          download: false,
          links: parent.url_resource,
          user: false,
          stats: false,
          volume: 100,
        });
  });
});//]]>

</script>
</head>
<body>
</body>
</html>