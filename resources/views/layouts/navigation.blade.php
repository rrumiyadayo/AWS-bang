<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-900">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Home</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">About</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Services</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Contact</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                @else
                    <a href="#" class="text-gray-600 hover:text-gray-900">Login</a>
                    <a href="#" class="ml-4 text-gray-600 hover:text-gray-900">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
