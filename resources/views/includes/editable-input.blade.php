<div class="form-group my-2 col-md-{{$col??12}}">
    <div class="input-group">
        <div class="form-floating col">
            @php
                $input = html()->text($name)
                ->isReadonly()
                ->required($required??false)
                ->type($type??"text")
                ->class(array_merge($classes??["form-control"] , ["editable-input"]))
                ->addClass($errors->has($name) ? "is-invalid" : "")
                ->attributes($attrs??[])->id($name)
                ->placeholder($placeholder??null);

                if(isset($value)){
                    $input = $input->value($value);
                }
            @endphp

            {!! $input !!}
            <label for="{{$name}}">
                {{__(ucfirst($title))}}
                @if($required ?? false)
                    <span class="text-danger"> * </span>
                @endif
            </label>
        </div>

        <button class="btn btn-dark px-3 edit-button" type="button" ><i class="fas fa-edit"></i></button>
    </div>
    @error($name)
    <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>


