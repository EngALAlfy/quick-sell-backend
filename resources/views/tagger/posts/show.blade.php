<div class="row gutters">
    <div class="col-12">

        <div class="d-block my-2">
            {{$post->getFirstMedia("images")?->img()?->attributes(['style' => 'width: 100%!important;height:200px!important;object-fit:cover;', "class" => "border border-dark border-1"])}}
        </div>

        <h3 class="my-3">{{$post->title}}</h3>

        <div>{!! $post->description_top !!}</div>
        <div>{!! $post->description_bottom !!}</div>
    </div>
</div>
