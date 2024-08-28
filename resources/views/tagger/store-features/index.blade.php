@extends("layouts.tagger")

@section("title" , __('Store Features'))

@section("content")
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                        {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        function test() {
            console.log(window.LaravelDataTables["store-features-table"].rows({selected: true}).data());
        }
    </script>
@endpush
