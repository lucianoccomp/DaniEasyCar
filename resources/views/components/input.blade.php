@props(['disabled' => false])

<div class="form-floating mb-3">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control form-control-lg pb-4']) !!}>
</div>
