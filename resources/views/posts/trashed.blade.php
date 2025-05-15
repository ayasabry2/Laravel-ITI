<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashed Posts</title>
    <!-- Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Trashed Posts</h1>

        <!-- Display success message if present -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Check if there are trashed posts -->
        @if ($posts->isEmpty())
            <p class="text-gray-500">No trashed posts found.</p>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">Body</th>
                        <th class="py-3 px-4 text-left">Created By</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $post->title }}</td>
                            <td class="py-3 px-4">{{ Str::limit($post->body, 50) }}</td>
                            <td class="py-3 px-4">{{ $post->created_by }}</td>
                            <td class="py-3 px-4">
                                <!-- Restore Button -->
                                <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Restore</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif

        <!-- Back to Posts Link -->
        <a href="{{ route('posts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-3 inline-block">Back to Posts</a>
    </div>
</body>
</html>