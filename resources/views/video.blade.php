<form action="{{ route('video.upload') }}" method="post">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li class="text-red-600">{{ $error }}</li>
        @endforeach
    @endif
    @csrf
    <label for="file">Video File:</label>
<input type="text" name="url" id="">
    <button type="submit">Upload and Play</button>
</form>
