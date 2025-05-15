<!DOCTYPE html>
<html>
<head>
    <title>Post Deleted</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center h-screen">

    <div class="bg-white p-10 rounded shadow text-center">
        @if(session('success'))
            <h1 class="text-2xl font-bold mb-4">{{ session('success') }}</h1>
        @endif

        <a href="{{ route('posts.index') }}" class="text-blue-500 hover:underline">← Back to All Posts</a>
    </div>

</body>
</html>
