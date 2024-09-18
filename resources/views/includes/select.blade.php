<div class="form-group col-md-{{$col??12}}">
    @if(!($floating ?? false))
        <label for="{{$name}}">
            {{__(ucfirst($title))}}
            @if($required ?? false)
                <span class="text-danger"> * </span>
            @endif
        </label>
    @endif
    <div class="input-group">
       @php $select = html()->select($name)
        ->required($required??false)
        ->class($classes . " form-control form-select")
        ->addClass($errors->has($name) ? "is-invalid" : "")
        ->options($options ?? [])
        ->attributes($attrs??[])->id($name);
        @endphp

        @if($has_new_item ?? false)
            @php($select = $select->attribute("has_new_item" , $has_new_item))
            @php($select = $select->attribute("new_item_attrs" , $new_item_attrs ?? ''))
            @php($select = $select->attribute("new_item_route" , $new_item_route))
            @php($select = $select->attribute("data-html-title" , __("Add new ") . $title))
        @endif

        @if($multi ?? false)
            @php($select = $select->multiple())
        @else
            @php($select = $select->placeholder($placeholder?? __('Please select') . " $title"))
        @endif

        @if(isset($value))
            @php($select = $select->value($value))
        @endif

        {!! $select !!}
    </div>
    @error($name)
    <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
