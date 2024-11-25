<form action="" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @csrf
    @foreach($formFields as $field)
    <div>
        <label for="{{ $field['name'] }}" class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>

        @if($field['type'] == 'select')
        <select
            name="{{ $field['name'] }}"
            id="{{ $field['name'] }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            @if($field['required']) required @endif>
        @foreach($field['options'] as $option)
        <option value="{{ $option }}">{{ ucfirst($option) }}</option>
        @endforeach
        </select>
        @elseif($field['type'] == 'checkbox')
        <div class="flex items-center mt-2">
            <input
                type="checkbox"
                name="{{ $field['name'] }}"
                id="{{ $field['name'] }}"
                class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                @if($field['required']) required @endif>
            <label class="ml-2 block text-sm text-gray-700" for="{{ $field['name'] }}">{{ $field['label'] }}</label>
        </div>
        @else
        <input
            type="{{ $field['type'] }}"
            name="{{ $field['name'] }}"
            id="{{ $field['name'] }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            @if($field['required']) required @endif>
        @endif
    </div>
    @endforeach

    <div class="col-span-2">
        <button
            type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Enviar
        </button>
    </div>
</form>
