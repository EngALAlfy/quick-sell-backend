@extends("layouts.tagger")

@section("title" , __('Wallet Transactions'))

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
@endpush
