<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-5 sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-dark-900 dark:text-gray-100 text-center mx-auto text-lg font-bold">
    {{ __("Welcome To Photo Folder Management System") }}
</div>
            </div>
        </div>
    </div>
    <div class="py-8">
        <div class="max-w-7xl mx-5 sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded">
            <div class="p-6 text-dark-900 dark:text-gray-100 text-center mx-auto text-lg font-bold">
                <a href="{{ route('photos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Upload Photo
</a>
 

    </div>
    </div>
    </div>
    

</x-app-layout>
