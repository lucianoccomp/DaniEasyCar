@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 text-white']) }}>
   <h5> {{ $value ?? $slot }}</h5>
</label>
