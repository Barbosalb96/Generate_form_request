<form action="" method="POST" class="row g-3">
    @csrf
    @foreach($formFields as $field)
    <div class="col-md-6">
        <label for="{{ $field['name'] }}" class="form-label">{{ $field['label'] }}</label>

        @if($field['type'] == 'select')
        <select name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-select"
                @if($field['required']) required @endif>
        @foreach($field['options'] as $option)
        <option value="{{ $option }}">{{ ucfirst($option) }}</option>
        @endforeach
        </select>
        @elseif($field['type'] == 'checkbox')
        <div class="form-check">
            <input type="checkbox" name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                   class="form-check-input" @if($field['required']) required @endif>
            <label class="form-check-label" for="{{ $field['name'] }}">{{ $field['label'] }}</label>
        </div>
        @else
        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" id="{{ $field['name'] }}"
               class="form-control" @if($field['required']) required @endif>
        @endif
    </div>
    @endforeach

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
