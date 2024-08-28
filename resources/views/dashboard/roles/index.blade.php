@extends("layouts.admin")

@section("title" , __('Admin roles List'))
@section("description" , __('Show system admin roles List'))

@section("content")
    <div class="row g-4">

        @foreach($adminRoles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="fw-normal">{{$role->users_count}} {{__('Users')}}</h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                @foreach($role->users as $user)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-sm pull-up" aria-label="{{$user->name}}"
                                        data-bs-original-title="{{$user->name}}">
                                        <img class="rounded-circle" src="{{$user->getFirstMediaUrl('avatar')}}"
                                             alt="Avatar">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">{{$role->title}}</h4>
                                {!! ajax_button('<i class="bx bx-edit me-2"></i> '. __("Edit role") , "text-primary btn btn-link" , route("admin.roles.edit" , $role) , __('Edit role')) !!}
                            </div>
                            {{html()->form()->method("post")->route("admin.roles.destroy" , $role)->open()}}
                            @method('DELETE')
                            <a href="javascript:void(0);" class="text-muted delete-button"><i
                                        class="bx bx-trash"></i></a>
                            {{html()->form()->close()}}
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
                            <img src="{{asset("assets/admin/img/icons/permissions.png")}}" class="img-fluid p-3"
                                 alt="{{__('Add new admin role')}}" width="120">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            {!! ajax_button(__('Add new admin role'), "btn btn-primary mb-3 text-nowrap add-new-role" , route("admin.roles.create") , __('Add new admin role')) !!}
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
                    {{ $dataTable->table() }}
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
