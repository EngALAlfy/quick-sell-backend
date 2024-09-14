@extends('layouts.dashboard')

@section("title" , __('Backup'))

@section("description" , __("Website database backup"))

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12 m-t-20">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{route("dashboard.settings.backup-create")}}" class="btn btn-primary float-right" data-toggle="tooltip"
                               data-placement="left" title="New Backup">
                                <i class="fa fa-add"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 30%">
                                        Name
                                    </th>
                                    <th style="width: 20%">
                                        Size
                                    </th>
                                    <th style="width: 20%">
                                        Date
                                    </th>
                                    <th style="width: 30%">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($backups as $backup)
                                    <tr>

                                        <td>
                                            {{ $backup['name'] }}
                                        </td>
                                        <td>
                                            {{ $backup['size'] >= 1001 ? floor($backup['size'] / 1024) . ' MB' : floor($backup['size']) . ' KB' }}
                                        </td>
                                        <td>
                                            {{ $backup['created_at']->format('Y-m-d') }}
                                        </td>

                                        <td class="project-actions text-right">
                                            <form class="delete-form" action="{{ route('admin.settings.backup-destroy', $backup['name']) }}"
                                                  enctype="multipart/form-data" method="POST">

                                                <a href="{{ route('dashboard.settings.backup-restore', $backup['name']) }}"
                                                   class="btn btn-success btn-sm">
                                                    <i class="icon-upload">
                                                    </i>
                                                    {{__('Restore')}}
                                                </a>
                                                <a href="{{ route('dashboard.settings.backup-show', $backup['name']) }}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="icon-download">
                                                    </i>
                                                    {{__('Download')}}
                                                </a>
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="icon-trash">
                                                    </i>
                                                    {{__('Delete')}}
                                                </button>

                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-success text-center">{{__('No Data')}}</div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
            </div>
    </div>
@endsection
