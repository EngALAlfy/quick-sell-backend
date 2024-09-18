@extends("layouts.dashboard")

@section("title" , __('Clients List'))

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
            console.log(window.LaravelDataTables["clients-table"].rows({selected: true}).data());
        }
    </script>
@endpush
