<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
            <tr>
                <td>@lang("ID")</td>
                <td>{!! $customer->id !!}</td>
            </tr>
            
            <tr>
                <td>@lang("Name")</td>
                <td>{!! $customer->name !!}</td>
            </tr>

            <tr>
                <td>@lang("Image")</td>
                <td>{!! getImageColumn($customer->getFirstMedia('avatar')?->getUrl(), 100) !!}</td>
            </tr>

            <tr>
                <td>@lang("Email")</td>
                <td>{!! $customer->email !!}</td>
            </tr>

            <tr>
                <td>@lang("Phone")</td>
                <td>{!! $customer->phone !!}</td>
            </tr>

            <tr>
                <td>@lang("No. Orders")</td>
                {{-- TODO: Change to only delivered orders if needed --}}
                <td>{!! $customer->orders()->count() !!}</td>
            </tr>

            <tr>
                <td>@lang("Last Login At")</td>
                <td>{!! \Carbon\Carbon::parse($customer->last_login_datetime)->format("Y-m-d h:i a") !!}</td>
            </tr>

            <tr>
                <td>@lang("Status")</td>
                <td>{!! getBadgeColumn(\App\Enums\CustomerStatus::tryFrom($customer->status)?->getName() , match ($customer->status){
                    "active" => "success",
                    "inactive" => "warning",
                    "blocked" => "danger",
                }) !!}</td>
            </tr>

            <tr>
                <td>@lang("Status Reason")</td>
                <td>{!! $customer->status_reason !!}</td>
            </tr>
            </tbody>
        </table>
    </div>
    {{--  todo:: add this   --}}
    <a href="#" class="btn btn-primary"><i class="fa fa-eye me-2"></i>{{__('View more details')}}</a>
</div>
