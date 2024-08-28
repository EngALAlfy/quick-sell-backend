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
            {!! html()->textarea($name."[$lang]")
                ->isReadonly($show??false)
                ->required($required??false)
                ->value(optional($model ?? null)->getTranslation($name , $lang) ?? '')
                ->maxlength($maxlength ?? 255)
                ->rows($rows ?? 5)
                ->style(($lang === 'ar'?"text-align:right;direction:rtl;":"") . "height:unset;")
                ->class(($classes??"") . " form-control bootstrap-maxlength-example")
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
