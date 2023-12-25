<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video and Audio Player</title>
</head>

<body>
    
    <video id="video" width="100%" height="500px" controls>
        <source src="data:video/mp4;base64,{{ $video_content }}" type="video/mp4">
    </video>

</body>

</html>
