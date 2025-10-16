<html>
<head>
    <title>Songs list</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Songs List</h1>
        <a href="/sonora/create" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New Song</a>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Artist</th>
                    <th class="py-2 px-4 border-b">Album</th>
                    <th class="py-2 px-4 border-b">Genre</th>
                    <th class="py-2 px-4 border-b">Year</th>
                    <th class="py-2 px-4 border-b">Cover</th>
                    <th class="py-2 px-4 border-b">Audio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($songs as $song)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $song->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $song->artist }}</td>
                        <td class="py-2 px-4 border-b">{{ $song->album }}</td>
                        <td class="py-2 px-4 border-b">{{ $song ->genre }}</td>
                        <td class="py-2 px-4 border-b">{{ $song->year }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($song->cover_url)
                                <img src="{{ $song->cover_url }}" alt="Cover Image" class="h-16 w-16 object-cover rounded">
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">
                            @if ($song->audio_base64)
                                <audio controls>
                                    <source src="data:audio/mpeg;base64,{{ $song->audio_base64 }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection