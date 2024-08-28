<div class="form-group col-md-{{$col??12}}">
    <label class="form-label" for="{{$name}}">
        {{__(ucfirst($title))}}
        @if($required ?? false)
            <span class="text-danger"> * </span>
        @endif

        @if($hint_icon ?? false)
            {!! hint_icon($hint_icon) !!}
        @endif
    </label>

    @foreach(supported_languages() as $lang)
        <div class="form-floating">
            {!! html()->text($name."[$lang]")
                ->isReadonly($show??false)
                ->required($required??false)
                ->value(optional($model ?? null)->getTranslation($name , $lang) ?? '')
                ->type($type??"text")
                ->style($lang === 'ar'?["style"=>"text-align:right;direction:rtl"]:[])
                ->class(($classes??"") . " form-control")
                ->addClass($errors->has($name."[$lang]") ? "is-invalid" : "")
                ->attributes($attrs??[])->id("$name-$lang")
                ->placeholder($placeholder??null) !!}
            <label for="{{"$name-$lang"}}">
                {{strtoupper($lang)}}
                @if($required ?? false)
                    <span class="text-danger"> * </span>
                @endif
            </label>
        </div>
        @error($name."[$lang]")
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    @endforeach

    @error($name)
    <small class="invalid-feedback">{{ $message }}</small>
    @enderror

</div>
