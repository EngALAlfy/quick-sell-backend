<div class="form-group col-md-{{ $col ?? 12 }}">
    @if (!($floating ?? true))
        <label class="form-label" for="{{ $name }}">
            {{ __(ucfirst($title)) }}
            @if ($required ?? false)
                <span class="text-danger"> * </span>
            @endif

            @if ($hint_icon ?? false)
                {!! hint_icon($hint_icon) !!}
            @endif
        </label>
    @endif
    @if ($floating ?? true)
        <div class="form-floating">
    @endif
    {!! html()->text($name)->isReadonly($show ?? false)->required($required ?? false)->type($type ?? 'text')->class(($classes ?? '') . ' form-control')->addClass($errors->has($name) ? 'is-invalid' : '')->attributes($attrs ?? [])->id($name)->placeholder($placeholder ?? null) !!}
    @if ($floating ?? true)
        <label for="{{ $name }}">
            {{ __(ucfirst($title)) }}
            @if ($required ?? false)
                <span class="text-danger"> * </span>
            @endif
        </label>
</div>
@endif
@error($name)
    <small class="invalid-feedback">{{ $message }}</small>
@enderror
</div>
