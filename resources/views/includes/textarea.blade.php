<div class="form-group col-md-{{ $col ?? 12 }}">
    <div class="form-floating">
        {!! html()->textarea($name)->isReadonly($show ?? false)->required($required ?? false)->class($classes ?? ['form-control'])->addClass($errors->has($name) ? 'is-invalid' : '')->attributes($attrs ?? [])->id($name)->style(['height' => strval(($rows ?? 6) * 20) . 'px'])->placeholder($placeholder ?? null) !!}
        <label for="{{ $name }}">
            {{ __(ucfirst($title)) }}
            @if ($required ?? false)
                <span class="text-danger"> * </span>
            @endif
        </label>
    </div>

    @error($name)
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
