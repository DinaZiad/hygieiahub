<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="bg-indigo-600 p-6 text-white">
                <h1 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
                <p class="opacity-90">Housekeeper Dashboard</p>
            </div>

            <!-- Profile Information -->
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="font-medium text-gray-500 text-sm">Email</h2>
                            <p class="mt-1 text-gray-900">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="font-medium text-gray-500 text-sm">Phone Number</h2>
                            <p class="mt-1 text-gray-900">{{ auth()->user()->phone }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="font-medium text-gray-500 text-sm">Employee Number</h2>
                            <p class="mt-1 text-gray-900">{{ auth()->user()->employee_number }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="font-medium text-gray-500 text-sm">Role</h2>
                            <p class="mt-1 text-gray-900 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>