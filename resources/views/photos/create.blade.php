<div class="container mx-auto mt-8">
        <h5 class="text-2xl font-semibold mb-5">Create a New Photo</h5>

        <form action="{{ route('photos.index') }}" method="POST" enctype="multipart/form-data"
              class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Title:</label>
                <input type="text" name="title" id="title" required
                       class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-600">Image:</label>
                <input type="file" name="image" id="image" required accept="image/*"
                       class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-indigo-500">
            </div>
            
            <div class="mb-4">
                <label for="folderName" class="block text-sm font-medium text-gray-600">Folder Name:</label>
                <input type="text" name="folderName" id="folderName" required
                       class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-indigo-500">
            </div>

            <div class="flex justify-center">
                <button type="submit" class="btn fs-5 text-xl">Submit</button>

            </div>
            <div class="flex justify-center">
   
                <button type="button" class="btn fs-5 text-xl ml-4" onclick="createFolder()">Create Folder</button>
            </div>
        </form>
    </div>
    

    <script>
        function createFolder() {
            // Add logic to create a new folder using JavaScript or make an AJAX request to a server-side endpoint
            alert('Folder created!');
        }
    </script>