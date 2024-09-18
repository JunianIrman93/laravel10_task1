<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto m-8 px-8">
        <div class="flex flex-row justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Posts List</h2>

            <!-- Add a Create New Post Button -->
            <div>
                <a href="{{ route('posts.create') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700">
                    Create New Post
                </a>
            </div>

        </div>

        @if (session('success'))
            <div class="alert alert-success mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-20 py-2 px-4 border-b border-gray-200 text-left text-sm font-medium text-gray-600">#</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-medium text-gray-600">Title</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-medium text-gray-600">Content</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-medium text-gray-600">Category</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-medium text-gray-600">Created At</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-medium text-gray-600">Updated At</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-right text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table Row Template for Posts -->
                    @foreach ($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->id }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->title }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->content }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->category->category_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->created_at }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $post->updated_at }}</td>
                            <td class="flex flex-row justify-end py-2 px-4 border-b border-gray-200 text-sm text-right">
                                <a href="{{ route('posts.edit', $post->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <!-- Repeat for more posts -->
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="max-w-max mx-auto mt-10">
        <canvas id="postCategoryChart" width="300" height="300"></canvas>
    </div>

    <script>
        // Fetch the category names and post counts from the controller
        const categoryNames = @json($categoryNames);
        const postCounts = @json($postCounts);

        // Doughnut Chart
        const ctx = document.getElementById('postCategoryChart').getContext('2d');
        const postCategoryChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: categoryNames, // Labels (category names)
                datasets: [{
                    label: 'Posts per Category',
                    data: postCounts, // Data (post counts per category)
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>

</body>
</html>
