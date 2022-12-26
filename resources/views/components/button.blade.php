<div class="d-grid mb-2">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block text-uppercase fw-bold']) }}>
        {{ $slot }}
    </button>
</div>
