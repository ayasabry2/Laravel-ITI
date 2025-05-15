<!DOCTYPE html>
<html>
<head>
    <title>View Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Post Details</h1>

        <div class="space-y-4">
            <p><strong class="text-gray-700">ID:</strong> {{ $post->id }}</p>
            <p><strong class="text-gray-700">Title:</strong> {{ $post->title }}</p>
            <p><strong class="text-gray-700">Body:</strong> {{ $post->body }}</p>
            @if ($post->image)
              <div class="mt-4">
              <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="Post Image" class="rounded w-full max-h-96 object-cover">
              </div>
            @endif

            <p><strong class="text-gray-700">Created At:</strong> {{ $post->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <hr class="my-4">
    <div class="bg-gray-50 border rounded p-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">User Info</h3>
        <p><strong class="text-gray-700">Name:</strong> {{ $post->user->name ?? 'N/A' }}</p>
        <p><strong class="text-gray-700">Email:</strong> {{ $post->user->email ?? 'N/A' }}</p>
        <p><strong class="text-gray-700">User Since:</strong> {{ $post->user->created_at->format('d M Y') ?? 'N/A' }}</p>
    </div>

        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-3 text-gray-800">Comments</h2>
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($post->comments->count() > 0)
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    @foreach ($post->comments as $comment)
                        <li>{{ $comment->body }} - 
                            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No comments yet.</p>
            @endif

            <form action="{{ route('posts.comments.store', $post->id) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="body" rows="3" class="w-full p-2 border rounded @error('body') border-red-500 @enderror" placeholder="Write a comment...">{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                <input type="hidden" name="commentable_type" value="App\Models\Post">
                <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Add Comment</button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('posts.index') }}" class="text-blue-500 hover:underline">← Back to Posts</a>
        </div>
    </div>

</body>
</html>