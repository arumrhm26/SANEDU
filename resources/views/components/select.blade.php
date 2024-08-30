<select
        {{ $attributes->merge([
            'class' =>
                'block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm',
        ]) }}>
    {{ $slot }}
</select>
