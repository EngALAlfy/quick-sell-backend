<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
            <tr>
                <td>@lang("ID")</td>
                <td>{!! $product->id !!}</td>
            </tr>

            <tr>
                <td>@lang("Image")</td>
                <td>{!! getImageColumn($product->getFirstMedia('image')?->getUrl(), 100) !!}</td>
            </tr>

            <tr>
                <td>@lang("Name")</td>
                <td>{!! $product->name !!}</td>
            </tr>

            <tr>
                <td>@lang("Description")</td>
                <td>{!! $product->description !!}</td>
            </tr>

            <tr>
                <td>@lang("Price")</td>
                <td>{!! getPriceColumn($product->price) !!}</td>
            </tr>

            <tr>
                <td>@lang("Discount")</td>
                <td>{!! getPriceColumn($product->getDiscountValue()) !!} ({!! $product->discount_percentage ?? 0 !!}%)</td>
            </tr>

            <tr>
                <td>@lang("In Stock")</td>
                <td>{!! getBadgeColumn($product->quantity, $product->quantity > 10 ? 'success' : 'danger') !!}</td>
            </tr>

            <tr>
                <td>@lang("Max Quantity")</td>
                <td>{!! $product->max_quantity !!}</td>
            </tr>

            <tr>
                <td>@lang("Min Quantity")</td>
                <td>{!! $product->min_quantity !!}</td>
            </tr>

            <tr>
                <td>@lang("Category")</td>
                <td>
                    {!! getBadgeColumn($product->category->name) !!}
                </td>
            </tr>

            <tr>
                <td>@lang("Gallery")</td>
                <td>
                    @foreach ($product->getMedia('gallery') as $gallery)    
                        {!! getImageColumn($gallery->getUrl(), 100) !!}
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    {{--  todo:: add this   --}}
    <a href="#" class="btn btn-primary"><i class="fa fa-eye me-2"></i>{{__('View more details')}}</a>
</div>
