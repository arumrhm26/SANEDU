<div class="relative flex justify-center"
     x-data="{ dropdown: false }">
    <a class="text-primary-900 flex-1 p-2 rounded-md font-semibold text-center cursor-pointer"
       @click="dropdown = !dropdown">
        Register
    </a>
    {{ $slot }}
</div>

