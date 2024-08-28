<div class="form-group">

    @php
        $field_name = $field_name ??"new-image";
    @endphp
    <label>@lang('Image')</label>

    <input wire:model.live="image" type="file" class="d-none" name="{{$field_name}}" id="{{$field_name}}" accept="image/*">


    <div id="{{$field_name}}-input-zone" data-toggle="tooltip" title="@lang('Choose image')" class="row justify-content-center m-0"
         style="border: 1px dashed @error('image') red @enderror;border-radius: 10px;">
        <div class="col-12 d-flex justify-content-center align-items-center"
             style="cursor: pointer;height: {{ $height }}px;">
            <img wire:loading.remove style="width:{{ $width }}px;max-height: {{ $height - 40 }}px;"
                 class="m-t-20 m-b-20 img-fluid" id="image-preview"
                 src="{{ $image ? (is_string($image) ? $image : $image->temporaryUrl()) : asset('assets/admin/img/file-input-placeholder.png') }}">

            <div wire:loading wire:target="image" class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    @error('image')
    <small class="form-text text-danger">{{$message}}</small>
    @enderror
</div>

@push("scripts")
    <script>
        $('#{{$field_name}}-input-zone').click(function () {
            $('#{{$field_name}}').click();
        });
    </script>
@endpush
