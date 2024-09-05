@extends("layouts.dashboard")

@section("title" , __('Admin roles List'))
@section("description" , __('Show system admin roles List'))

@section("content")
    <div class="row g-4">

        @foreach($adminRoles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="fw-normal">Total 4 users</h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy"
                                    data-bs-original-title="Vinnie Mostowy">
                                    <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-sm pull-up" aria-label="Allen Rieske"
                                    data-bs-original-title="Allen Rieske">
                                    <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-sm pull-up" aria-label="Julee Rossignol"
                                    data-bs-original-title="Julee Rossignol">
                                    <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-sm pull-up" aria-label="Kaith D'souza"
                                    data-bs-original-title="Kaith D'souza">
                                    <img class="rounded-circle" src="../../assets/img/avatars/15.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-sm pull-up" aria-label="John Doe"
                                    data-bs-original-title="John Doe">
                                    <img class="rounded-circle" src="../../assets/img/avatars/1.png" alt="Avatar">
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">Administrator</h4>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                   class="role-edit-modal"><small>Edit Role</small></a>
                            </div>
                            <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                            <img src="{{asset("assets/admin/img/icons/permissions.png")}}" class="img-fluid p-3" alt="{{__('Add new admin role')}}" width="120">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            {!! ajax_button(__('Add new admin role'), "btn btn-primary mb-3 text-nowrap add-new-role" , route("dashboard.roles.create") , __('Add new admin role')) !!}
                            <p class="mb-0">{{__('Add role, if it does not exist')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <!-- Role Table -->
            <div class="card">
                <div class="card-header">
                    <h4 class="">{{__('All system roles')}}</h4>
                </div>
                <div class="card-datatable table-responsive">

                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        function test() {
            console.log(window.LaravelDataTables["users-table"].rows({selected: true}).data());
        }
    </script>
@endpush
