@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            <b>{{ __('Opa! Usuário ou Senha incorreto.') }}</b>
        </div>

        <span class="mt-3 text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </span>
    </div>
@endif
