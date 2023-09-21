 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
            <button class="btn-post">
    <a href="{{ route('posts.create') }}">Create_Post</a>
</button>
        </h2> -->
        
    </x-slot>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Your other navigation items -->

    <!-- <ul class="navbar-nav ml-auto">
       
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
    </div> -->
</x-app-layout>
<style>
    .btn-post{
        width: 13%;
        height: 100%;
        /* background-color: lightcoral; */
       /* border-radius: 10%; */
       color: red;
       /* font-family: 'Courier New', Courier, monospace; */
       font-weight: 100px;
       text-align: center;
       padding-right: 100px;
       margin: 10px;

    }
</style>

