<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Create a New Post</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input type="text" name="title" id="title" value=""
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Body:</label>
                <input type="text" name="body" id="body" value=""
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

           <div class="mt-4">
                <label class="block text-gray-700 font-medium mb-2">Image</label>
                <input type="file" name="image" class="w-full border rounded p-2">
                @error('image')
                 <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
           </div>


            <div>
                <label for="created_by" class="block text-sm font-medium text-gray-700">Created By:</label>
                <input type="text" name="created_by" id="created_by" value=""
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('posts.index') }}"
                   class="text-blue-500 hover:underline">Back to Posts</a>
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                    Save
                </button>
            </div>
        </form>
    </div>
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</body>
</html>

