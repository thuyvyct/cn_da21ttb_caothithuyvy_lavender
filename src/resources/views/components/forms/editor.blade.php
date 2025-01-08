@props(['name', 'value' => '', 'label' => '', 'required' => false])

<div>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <div class="mt-1">
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            class="ckeditor hidden"
        >{{ old($name, $value) }}</textarea>
    </div>
    
    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>