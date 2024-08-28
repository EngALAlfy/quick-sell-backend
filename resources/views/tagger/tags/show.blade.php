<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{!! $tag->id !!}</td>
                </tr>
                <tr>
                    <td>@lang('Title')</td>
                    <td>{!! $tag->title !!}</td>
                </tr>
                <tr>
                    <td>@lang('Slug')</td>
                    <td>{!! getBadgeColumn($tag->slug) !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
