@extends("layouts.dashboard")

@section("title", __('Activity log'))

@section("description", "Activity Lof Details")

@push("styles")
    <style>
        h3 {
            font-size: 1.5rem !important;
        }
    </style>
@endpush


@section("content")
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h3>{{Str::upper(str_replace("_" , " " , $activity->log_name))}}
                            #{{$activity->id}}</h3>
                        <p class="text-xs">{{$activity->description}}</p>
                    </div>
                    <div class="card-tools float-right">
                        <div class="badge badge-dark p-2 text-sm">{{ $activity->created_at }}
                            | {{ $activity->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="mb-3"><i class="fa fa-history mr-2"></i>Log Information</h3>
                    <div class="row">
                       <div class="col-12">
                           <table class="table table-borderless">
                               <tr>
                                   <td><strong>Route name:</strong></td>
                                   <td><p class="mb-2 badge p-2 badge-dark">{{ $activity->properties["route"]["name"] }}</p></td>
                               </tr>
                               <tr>
                                   <td><strong>Route method:</strong></td>
                                   <td><p class="mb-2 badge p-2 badge-dark">{{ $activity->properties["route"]["method"] ?? "--" }}</p></td>
                               </tr>
                               <tr>
                                   <td><strong>Full url:</strong></td>
                                   <td>
                                       <a class="underline" target="_blank" href="{{ $activity->properties["route"]["url"] }}">
                                           {{ $activity->properties["route"]["url"] }}
                                       </a>
                                   </td>
                               </tr>
                               <tr>
                                   <td><strong>Module:</strong></td>
                                   <td>{{ getOnlyClassName($activity->subject_type ?? $activity->properties["module"] ?? "---") }}</td>
                               </tr>
                               <tr>
                                   <td><strong>Item ID:</strong></td>
                                   <td>#{{ $activity->subject_id }}</td>
                               </tr>
                               <tr>
                                   <td><strong>Action:</strong></td>
                                   <td>
                            <span class="badge p-2 badge-{{ $activity->event == "deleted" ? "danger" : ($activity->event == "updated" ? "warning" : "info") }}">
                                {{ $activity->event }}
                            </span>
                                   </td>
                               </tr>
                           </table>
                       </div>
                    </div>

                    <hr class="my-4">

                    <h3 class="mb-3"><i class="fa fa-user-secret mr-2"></i>Agent Information</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="ml-4">
                                <p class="mb-2"><strong>IP:</strong></p>
                                <p class="mb-2"><strong>Browser:</strong></p>
                                <p class="mb-2"><strong>OS:</strong></p>
                                <p class="mb-2"><strong>Device:</strong></p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="ml-4">
                                <p class="mb-2">{{ $activity->properties["agent"]["ip"] }}</p>
                                <p class="mb-2">{{ $activity->properties["agent"]["browser"] }}</p>
                                <p class="mb-2">{{ $activity->properties["agent"]["os"] }}</p>
                                <p class="mb-2">{{ $activity->properties["agent"]["device"] }}</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h3 class="mb-3"><i class="fa fa-user mr-2"></i>User Information</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="ml-4">
                                <p class="mb-2"><strong>Name:</strong></p>
                                <p class="mb-2"><strong>Role:</strong></p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="ml-4">
                                <p class="mb-2">
                                    @if($activity->causer_id)
                                        <a class="underline" target="_blank"
                                           href="{{ route("admin.users.show" , $activity->causer_id) }}">{{ $activity->causer->name }}</a>
                                    @else
                                        Guest
                                    @endif
                                </p>
                                <p class="mb-2">
                                    @if($activity->causer_id)
                                        {{ $activity->causer?->role }}
                                    @else
                                        Guest/System
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>


                    @if(isset($activity->changes["attributes"]))
                        <hr class="my-4">
                        <h3 class="mb-3"><i class="fa fa-database mr-2"></i>Data</h3>
                        <div class="row ml-4">
                            @if(isset($activity->changes["old"]))
                                <div class="col-md-6">
                                    <h4 class="mb-3 badge badge-dark p-2">Old</h4>
                                    <div class="ml-4">
                                        @foreach($activity->changes["old"] as $key => $value)
                                            <p class="mb-2">
                                                @if($key == "updated_at")
                                                    Previous update
                                                    at: {{\Carbon\Carbon::parse($value)->toDateTimeString()}}
                                                @else
                                                    {{Str::ucfirst(Str::headline($key)) }}:
                                                    @if($key == "password")
                                                        <span class="badge badge-danger p-2">Protected</span>
                                                    @else
                                                        @if(is_object($value) || is_array($value))
                                                            @foreach($value as $subKey => $subValue)
                                                                <br>
                                                                <span class="ml-4">
                                                                            {{Str::ucfirst(Str::headline($subKey)) }}:
                                                                            {{$subValue}}
                                                                         </span>
                                                            @endforeach
                                                        @else
                                                            {{$value ?? "---"}}
                                                        @endif
                                                    @endif

                                                @endif
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <h4 class="mb-3  badge badge-success p-2">New</h4>
                                <div class="ml-4">
                                    @foreach($activity->changes["attributes"] as $key => $value)
                                        @if($key != "updated_at")
                                            <p class="mb-2">{{Str::ucfirst(Str::headline($key)) }}:
                                                @if($key == "password")
                                                    <span class="badge badge-danger p-2">Protected</span>
                                                @else
                                                    @if(is_object($value) || is_array($value))
                                                        @foreach($value as $subKey => $subValue)
                                                            <br>
                                                            <span class="ml-4">
                                                                            {{Str::ucfirst(Str::headline($subKey)) }}:
                                                                            {{$subValue}}
                                                                    </span>
                                                        @endforeach
                                                    @else
                                                        {{$value ?? "---"}}
                                                    @endif
                                                @endif
                                            </p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
