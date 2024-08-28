@extends("layouts.admin")

@section("title" , "Posts")

@section("page_title" , "Posts")

@section("description" , "Page posts")

@push("page_actions")
    <a href="{{route("admin.posts.create")}}" class="btn btn-primary float-right ajax-btn" data-html-title="New Post" data-toggle="tooltip" data-placement="left" title="New Post">
        <i class="icon-add"></i>
    </a>
@endpush

@section("content")
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{asset('assets/admin/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
@endpush
