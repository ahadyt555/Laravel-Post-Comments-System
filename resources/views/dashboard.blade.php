<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Your other navigation items -->

    <ul class="navbar-nav ml-auto">
        @auth
        <button class="btn btn-primary">
    <a class="text-Blue" href="{{ route('posts.create') }}">Create Post</a>
</button>
        
        @endauth
    <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

