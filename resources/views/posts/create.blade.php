<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Create Post</h2>

            <!-- Form Start -->
            <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                    <input type="text" id="title" name="title" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter the post title">
                </div>

                <!-- Content Textarea -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" required rows="5"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Write your content here"></textarea>
                </div>

                <!-- Category Select -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select a category</option>
                        <!-- Dynamic categories here -->
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <!-- Add more categories -->
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center mt-6">
                    <!-- Submit Button -->
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>

                    <!-- Delete Button -->
                    <button type="button"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete
                    </button>
                </div>

            </form>
            <!-- Form End -->

        </div>
    </div>
</body>
