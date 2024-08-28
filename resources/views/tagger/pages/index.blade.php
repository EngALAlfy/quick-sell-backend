@extends("layouts.tagger")

@section("title" , "Pages")

@section("page_title" , "Pages")

@section("description" , "Website Pages")

@push("page_actions")
    <a href="{{route("tagger.pages.create")}}" class="btn btn-primary float-right ajax-btn" data-html-title="New Page" data-toggle="tooltip" data-placement="left" title="New Page">
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
@endpush
