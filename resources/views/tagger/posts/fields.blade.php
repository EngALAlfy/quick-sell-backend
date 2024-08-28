<div class="row my-3">
    @include("admin.includes.input" ,
        [
            "name" => "title" ,
            "title" => "title" ,
            "required" => true,
            "col" => "12",
          ])
</div>

<div class="row my-3">
    @include("admin.includes.textarea" ,
        [
            "name" => "description_top" ,
            "title" => "description top" ,
            "required" => false,
            "rows" => 10,
            "col" => "12",
          ])
</div>

<div class="row my-3">
    @include("admin.includes.textarea" ,
        [
            "name" => "description_bottom" ,
            "title" => "description bottom" ,
            "required" => false,
            "rows" => 10,
            "col" => "12",
          ])
</div>

<div class="form-group my-3">
    @include("admin.includes.dropzone" , [
                                     "name" => "image",
                                     "title" => "Image",
                                     "file_name" => isset($post) ?optional($post)->getFirstMedia('images')?->file_name: null,
                                     "storage_path" => isset($post) ? optional($post)->getFirstMedia('images')?->id: null,
                                     "public_path" => isset($post) ? optional($post)->getFirstMedia('images')?->getUrl(): null])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Save post</button>
