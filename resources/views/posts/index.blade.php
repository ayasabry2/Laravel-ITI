<!DOCTYPE html>
<html>
<head>
    <title>Posts Index</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">
            {{ Route::currentRouteName() == 'posts.trashed' ? 'View Trashed Posts' : 'Posts List' }}
        </h1>

        <div class="flex justify-between mb-4">
            <div>
                @if (Route::currentRouteName() == 'posts.trashed')
                    <a href="{{ route('posts.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                        View All Posts
                    </a>
                @else
                    <a href="{{ route('posts.trashed') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                        View Trashed Posts
                    </a>
                @endif
            </div>
            <div>
                <a href="{{ route('posts.create') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                    Create New Post
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $post->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">No Image</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $post->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($post->body, 100) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $post->created_by }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex space-x-2">
                                    @if ($post->trashed())
                                        <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:underline">Restore</button>
                                        </form>
                                    @else
                                        <a href="{{ route('posts.show', $post->id) }}"
                                           class="text-blue-500 hover:underline">View</a>
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                           class="text-yellow-500 hover:underline">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                {{ Route::currentRouteName() == 'posts.trashed' ? 'No trashed posts available.' : 'No posts available.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</body>
</html>