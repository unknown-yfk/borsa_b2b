<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>QR SCANNER</title>
    <link href="{{ url('styles.css') }}" rel="stylesheet" />
    <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js">
</script>
</head>
<body>
<div id="container">
    <h1>QR Code Scanner</h1>
    <h1>Implemented on Android</h1>
    <h1></h1>
    <canvas hidden="" id="qr-canvas"></canvas>
    <div id="qr-result" hidden="">
        <b>Data:</b> <span id="outputData"></span>
    </div>
</div>

</body>
</html>
