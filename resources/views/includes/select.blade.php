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
        ->value($value ?? null)
        ->attributes($attrs??[])->id($name);
        @endphp

        @if($multi ?? false)
            @php($select = $select->multiple())
        @else
            @php($select = $select->placeholder($placeholder?? __('Please select') . " $title"))
        @endif

        {!! $select !!}

        @if($has_new_item ?? false)
            <div>
                {!! ajax_button('<i class="fa fa-plus"></i>' , "btn btn-outline-primary h-100 ms-2" , $new_item_route , __("Add new ") . $title ,'data-bs-toggle="tooltip" data-bs-placement="top"
                        aria-label="'.__("Add new ") . $title.'"
                        data-bs-original-title="'.__("Add new ") . $title.'" '. $new_item_attrs) !!}
            </div>
        @endif
    </div>
    @error($name)
    <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
