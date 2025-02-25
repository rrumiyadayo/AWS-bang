<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-900">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="https://github.com/rrumiyadayo/AWS-bang" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-gray-900">GitHub</a>
                    <a href="#" data-modal-trigger="about" class="text-gray-600 hover:text-gray-900">情報</a>
                    <a href="#" data-modal-trigger="contact" class="text-gray-600 hover:text-gray-900">連絡先</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <a href="#" data-development="true" class="text-gray-600 hover:text-gray-900">ログイン</a>
                <a href="#" data-development="true" class="ml-4 text-gray-600 hover:text-gray-900">登録</a>
            </div>
        </div>
    </div>
</nav>
