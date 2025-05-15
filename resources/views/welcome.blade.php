<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<table class="min-w-full border border-gray-300 shadow-md rounded-md overflow-hidden">
    <thead class="bg-gray-200 text-gray-700">
        <tr>
            <th class="py-2 px-4 border-b">User ID</th>
            <th class="py-2 px-4 border-b">User Name</th>
            <th class="py-2 px-4 border-b">User Posts</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr class="hover:bg-gray-100">
            <td class="py-2 px-4 border-b text-center">{{ $user->id }}</td>
            <td class="py-2 px-4 border-b text-center">{{ $user->name }}</td>
            <td class="py-2 px-4 border-b">
                <ul class="list-disc list-inside">
                    @foreach ($user->posts as $post)
                        <li>{{ $post->title }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>

