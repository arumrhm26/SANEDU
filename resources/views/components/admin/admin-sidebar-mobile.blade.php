<aside class="flex-col fixed top-0 z-[5] w-64 h-full min-h-screen bg-primary-950 text-white transition-all"
       x-show="sidebar"
       @click.outside="sidebar = false"
       x-cloak
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-300"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full">
    <img src="{{ Vite::asset('resources/images/logo.png') }}"
         alt="logo"
         class="w-24 mx-auto my-5 relative"
         @click="sidebar = !sidebar">
    <x-admin.admin-sidebar-container />
</aside>
<div class=" bg-gray-800/50 fixed z-[4] w-screen h-screen sm:hidden"
     x-show="sidebar"
     @click="sidebar = false"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

</div>

