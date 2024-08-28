<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($post , 'PUT')->acceptsFiles()->route("admin.posts.update" , $post)->open() !!}
        @include("admin.posts.fields")
        {!! html()->closeModelForm() !!}
    </div>

    <script>tinymce.init({
            selector: 'textarea',
            plugins: "advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons paste textcolor",
            valid_elements : '*[*]',
        });
    </script>
</div>
