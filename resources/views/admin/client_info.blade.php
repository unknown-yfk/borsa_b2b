<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<div class="visible-print text-center">
    <h1>Laravel 8 - QR Code Generator Example</h1>

    {!! QrCode::size(250)->generate(''); !!}

    <p></p>
</div>

</body>
</html>
