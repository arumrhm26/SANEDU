<div class="flex flex-col gap-1"
     wire:ignore>
    <label for="{{ $name }}"
           class="font-semibold">
        {{ str($name)->replace('-', ' ')->title() }}
    </label>

    <select id="{{ $name }}">

        <option value="">
            Pilih
            {{ str($name)->replace('-', ' ')->title() }}
        </option>

        @foreach ($options as $option)
            <option value="{{ $option->id }}">

                @switch($name)
                    @case('kelas')
                        {{ $option->full_name }}
                    @break

                    @default
                        {{ $option->name }}
                @endswitch

            </option>
        @endforeach

    </select>

</div>

@script
    <script>
        $(document).ready(function() {
            $('#{{ $name }}').select2();
            $('#{{ $name }}').on('change', function() {
                $wire.$set('value', $(this).val());
            });
        });
    </script>
@endscript

