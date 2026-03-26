@extends('layouts.app')

@section('content')

<div x-data="{ open: true }">

<!-- Sidebar -->
<div :class="open ? 'w-64' : 'w-20'"
     class="bg-white h-screen fixed top-0 left-0 shadow-md border-r z-50 transition-all duration-300">

    <!-- Toggle -->
    <div class="p-4 flex justify-between items-center border-b">
        <button @click="open = !open">
            <i data-lucide="menu"></i>
        </button>
    </div>

    <nav class="mt-4">
        <ul class="space-y-2 px-3">

            <!-- Beranda -->
            <li>
                <a href="{{ route('front.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200
                   hover:bg-gray-100 hover:translate-x-1
                   {{ request()->routeIs('front.index') ? 'bg-blue-500 text-white shadow-md' : 'text-gray-700' }}"
                   :class="open ? '' : 'justify-center'">
                    
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span x-show="open" class="ml-3">Beranda</span>
                </a>
            </li>

            <!-- Edit Profile -->
            <li>
                <a href="{{ route('auth.profile') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200
                   hover:bg-gray-100 hover:translate-x-1
                   {{ request()->routeIs('auth.profile') ? 'bg-blue-500 text-white shadow-md' : 'text-gray-700' }}"
                   :class="open ? '' : 'justify-center'">
                    
                    <i data-lucide="user" class="w-5 h-5"></i>
                    <span x-show="open" class="ml-3">Edit Profile</span>
                </a>
            </li>

            <!-- Ganti Password -->
            <li>
                <a href="{{ route('auth.password.change') }}"
                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200
                   hover:bg-gray-100 hover:translate-x-1
                   {{ request()->routeIs('auth.password.change') ? 'bg-blue-500 text-white shadow-md' : 'text-gray-700' }}"
                   :class="open ? '' : 'justify-center'">
                    
                    <i data-lucide="lock" class="w-5 h-5"></i>
                    <span x-show="open" class="ml-3">Ganti Password</span>
                </a>
            </li>

        </ul>
    </nav>
</div>

<!-- Main Content -->
<div :class="open ? 'ml-64' : 'ml-20'" class="transition-all duration-300">

    <form action="{{ route('auth.profile') }}" method="POST">
        @csrf

        <div class="p-4 md:p-10 bg-gray-50 min-h-screen">

            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-semibold">User Profile</h1>
                    <p class="text-sm text-gray-500">Settings / User Profile</p>
                </div>

                <div class="flex items-center gap-3">
                    <input class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Search" type="text" />

                    <img class="rounded-full h-10 w-10 object-cover"
                         src="{{ auth()->user()->image }}" />
                </div>
            </div>

            <!-- Alert -->
            @if (session()->has('error'))
                <p class="mb-4 text-red-500">{{ session('error') }}</p>
            @elseif(session()->has('success'))
                <p class="mb-4 text-green-500">{{ session('success') }}</p>
            @endif

            <!-- Card -->
            <div class="bg-white p-6 md:p-8 rounded-xl shadow-md">

                <!-- Profile Header -->
                <div class="flex flex-col md:flex-row items-center mb-6 gap-4">
                    <img class="rounded-full h-24 w-24 object-cover"
                         src="{{ auth()->user()->image }}" />

                    <div class="text-center md:text-left">
                        <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
                    </div>

                    <div class="ml-auto flex gap-2">
                        <button type="button"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Upload Foto
                        </button>

                        <button type="button"
                                class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg">
                            Hapus
                        </button>
                    </div>
                </div>

                <!-- Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-gray-700">Nama Depan</label>
                        <input type="text" name="name"
                               value="{{ auth()->user()->name }}"
                               class="w-full mt-2 p-3 border rounded bg-gray-100 focus:ring-2 focus:ring-blue-400"
                               required>
                    </div>

                    <div>
                        <label class="block text-gray-700">Nama Belakang</label>
                        <input type="text"
                               class="w-full mt-2 p-3 border rounded bg-gray-100">
                    </div>

                    <div>
                        <label class="block text-gray-700">Username</label>
                        <input type="text"
                               class="w-full mt-2 p-3 border rounded bg-gray-100">
                    </div>

                    <div>
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email"
                               value="{{ auth()->user()->email }}"
                               class="w-full mt-2 p-3 border rounded bg-gray-100 focus:ring-2 focus:ring-blue-400"
                               required>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end mt-6 gap-2">
                    <button type="button"
                            class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg">
                        Cancel
                    </button>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Simpan
                    </button>
                </div>

            </div>

        </div>
    </form>

</div>

</div>

<!-- AlpineJS -->
<script src="//unpkg.com/alpinejs" defer></script>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>

@endsection