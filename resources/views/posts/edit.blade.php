<!DOCTYPE html>
<html>

<head>
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit Post</h1>

        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">

            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="created_by" class="block text-sm font-medium text-gray-700">Created By:</label>
                <input type="text" name="created_by" id="created_by" value="{{ old('created_by', $post->created_by) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('created_by')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Body:</label>
                <textarea name="body" id="body" rows="5"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('body', $post->body) }}</textarea>
                @error('body')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Upload New Image:</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            @if ($post->image)
            <div class="mt-4">
                <p class="text-sm text-gray-600">Current Image:</p>
                <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="Current Post Image"
                    class="rounded w-full max-h-64 object-cover border">
            </div>
            @endif


            <div class="flex justify-between items-center">
                <a href="{{ route('posts.index') }}"
                    class="text-blue-500 hover:underline">Back to Posts</a>
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</body>

</html>