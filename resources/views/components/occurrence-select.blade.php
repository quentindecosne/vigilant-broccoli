@props(['url', 'type', 'selected'])
<div>
    <select data-url="{{ $url }}" data-type="{{ $type }}"
            class="@if ($selected != "") border-gray-300 @else border-amber-300 @endif master-update-select max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm  rounded-md">
        @if ($selected == "")
            <option value="" selected="selected">Set {{$type}}</option>
        @endif
        @foreach ($options as $value=>$label)
            <option
                    value="{{ $value }}"
                    @if ($value == $selected)
                        selected="selected"
                    @endif
            >
                {{ $label }}
            </option>
        @endforeach

    </select>
</div>
