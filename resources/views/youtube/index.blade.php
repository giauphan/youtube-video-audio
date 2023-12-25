<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video and Audio Player</title>
</head>

<body>
    <video id="video" width="100%" height="500px" >
        <source src="{{ $url_video }}" type="video/mp4">
    </video>

    <button onclick="playMedia()">Play Media</button>
    <button onclick="rewind()">Rewind 5 seconds</button>
    <button onclick="forward()">Forward 5 seconds</button>

    <audio id="audio" controls width="100%" height="500px" style="display: none">
        <source src="{{ $url_audio }}" type="audio/mp3">
    </audio>

    <script>
        var video = document.getElementById('video');
        var audio = document.getElementById('audio');

        function playMedia() {
            video.play();
            audio.play();
        }

        function rewind() {
            // Rewind by 5 seconds
            audio.currentTime -= 5;
            video.currentTime -= 5;
        }

        function forward() {
            // Forward by 5 seconds
            audio.currentTime += 5;
            video.currentTime += 5;
        }
    </script>
</body>

</html>
