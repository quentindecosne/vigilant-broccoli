@props(['name', 'label', 'url', 'type', 'selected'])
<div>
    <select onchange="handleSelectChange(this)" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
        @if ($selected == "" )
            <option value="" selected="selected">Set occurrence</option>
        @endif
            @foreach ($options as $option)
                <option
                    value="{{ $option }}"
                    @if ($option == $selected)
                        selected="selected"
                    @endif
                >
                    {{ $option }}
                </option>
            @endforeach

    </select>
</div>


@push('custom-scripts')
    <script type="text/javascript">
        function handleSelectChange(select) {
            const selectedValue = select.value;
            // Perform an AJAX call here
            // Example using jQuery's $.ajax method
            $.ajax({
                url: '{{ $url }}',
                method: 'POST',
                data: { value: selectedValue },
                success: function(response) {
                    // Handle the AJAX response here
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors here
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endpush
