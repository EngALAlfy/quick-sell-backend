@extends('layouts.dashboard')

@section("title" , __('Activity log'))

@section("description" , "Website users activity log")

@push("page_actions")
    <a href="{{route("dashboard.settings.activity-log.clear-all")}}" class="btn btn-danger float-right" data-toggle="tooltip"
       data-placement="left" title="Clear all">
        <i class="icon-delete"></i>
    </a>
@endpush

@section('content')
    <div class="container m-t-50">
        <div class="row justify-content-center">

            <div class="col-md-12 m-t-20">
                <div class="card card-outline card-primary">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 10%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        {{__('Description')}}
                                    </th>
                                    <th style="width: 10%">
                                        {{__('Event')}}
                                    </th>
                                    <th style="width: 15%">
                                            {{__('Route')}}
                                    </th>
                                    <th style="width: 15%">
                                        {{__('Causer')}}
                                    </th>
                                    <th style="width: 15%">
                                        {{__('Date')}}
                                    </th>
                                    <th style="width: 15%">
                                        {{__('Actions')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($activityLogs as $log)
                                    <tr>
                                        <td>
                                            {{ $log->id }}
                                        </td>
                                        <td>
                                            {{ $log->description }}
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $log->event }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">{{ $log->properties["route"]["name"] ?? "--" }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">{{ $log->causer?->name }}</span>
                                        </td>
                                        <td>
                                            {{ $log->created_at->format("Y-m-d g:i a") }}
                                        </td>
                                        <td class="project-actions text-center">

                                                <a href="{{ route('dashboard.settings.activity-log.show', $log) }}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="icon-eye">
                                                    </i>
                                                </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-success text-center">{{__('No Data')}}</div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        {{$activityLogs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
