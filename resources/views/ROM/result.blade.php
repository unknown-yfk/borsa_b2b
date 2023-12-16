<!DOCTYPE html>
<html>
<head>
    <title>QR Code Scanner</title>
</head>
<body>
    <h1>QR Code Scanner</h1>
    @if ($qrCodeText)
        <p>The QR code text is: {{ $qrCodeText }}</p>
    @else
        <p>No QR code found in the image.</p>
    @endif
</body>
</html>
