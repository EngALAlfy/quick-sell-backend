<div class="row gutters">

    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{!! $order->id !!}</td>
                </tr>
                <tr>
                    <td>@lang('Status')</td>
                    <td>{!! $order->status !!}</td>
                </tr>

                <tr>
                    <td>@lang('is Delivery')</td>
                    <td>{!! $order->is_delivery !!}</td>
                </tr>


                <tr>
                    <td>@lang('Customer IP')</td>
                    <td>{!! $order->customer_ip !!}</td>
                </tr>

                <tr>
                    <td>@lang('Customer OS')</td>
                    <td>{!! $order->customer_os !!}</td>
                </tr>

                <tr>
                    <td>@lang('Status Customer User Agent')</td>
                    <td>{!! $order->customer_useragent !!}</td>
                </tr>

                <tr>
                    <td>@lang('Cutomer Contact Email')</td>
                    <td>{!! $order->customer_contact_email !!}</td>
                </tr>

                <tr>
                    <td>@lang('Cutomer Contact Phone')</td>
                    <td>{!! $order->customer_contact_phone !!}</td>
                </tr>

                <tr>
                    <td>@lang('Coupon Code')</td>
                    <td>{!! $order->coupon_code !!}</td>
                </tr>

                <tr>
                    <td>@lang('Store')</td>
                    <td>{!! $order->store->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Customer Name')</td>
                    <td>{!! $order->customer->name !!}</td>
                </tr>


                <tr>
                    <td>@lang('Order Transaction Name')</td>
                    <td>{!! $order->orderTransaction->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Wallet Transaction Name')</td>
                    <td>{!! $order->walletTransaction->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('paymentMethod Name')</td>
                    <td>{!! $order->paymentMethod->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Plan Name')</td>
                    <td>{!! $order->plan->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Created At')</td>
                    <td>{!! $order->created_at !!}</td>
                </tr>

                <tr>
                    <td>@lang('Updated At')</td>
                    <td>{!! $order->updated_at !!}</td>
                </tr>

            </tbody>
        </table>
    </div>
    {{--  todo:: add this   --}}
    <a href="#" class="btn btn-primary"><i class="fa fa-eye me-2"></i>{{ __('View more details') }}</a>
</div>
