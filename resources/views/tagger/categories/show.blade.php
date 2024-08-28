<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
            <tr>
                <td>@lang("ID")</td>
                <td>{!! $category->id !!}</td>
            </tr>
            <tr>
                <td>@lang("Name")</td>
                <td>{!! $category->name !!}</td>
            </tr>

            <tr>
                <td>@lang("Description")</td>
                <td>{!! $category->description !!}</td>
            </tr>

            <tr>
                <td>@lang("Store")</td>
                <td>
                    {!! getBadgeColumn($category->store->name) !!}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    {{--  todo:: add this   --}}
    <a href="#" class="btn btn-primary"><i class="fa fa-eye me-2"></i>{{__('View more details')}}</a>
</div>
