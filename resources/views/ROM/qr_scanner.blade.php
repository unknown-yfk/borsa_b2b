<!DOCTYPE html>
<html>
<head>
    <title>QR Code Scanner</title>
</head>
<body>
    <h1>QR Code Scanner</h1>
    <form method="POST" action="{{ route('qr.scan') }}" enctype="multipart/form-data">
        @csrf
        <label for="image">Select an image file:</label>
        <input type="file" id="image" name="image">
        <button type="submit">Scan QR code</button>
    </form>
</body>
</html>
