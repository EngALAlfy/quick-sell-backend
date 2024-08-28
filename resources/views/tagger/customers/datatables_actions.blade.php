<div class="d-inline-block">
    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="bx bx-dots-vertical-rounded"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end m-0">
        <li>{!! ajax_button('<i class="bx bxs-show me-2"></i>' . __("View") , "dropdown-item text-info" , route("tagger.customers.show" , $id) , __("View Customer data")) !!}</li>
        @if($status == \App\Enums\CustomerStatus::blocked->value)
            <li>{!! ajax_button('<i class="bx bx-block me-2"></i>' . __("Unblock") , "dropdown-item text-success" , route("tagger.customers.status" , $id) , __("Unblock Customer")) !!}</li>
        @else
            <li>{!! ajax_button('<i class="bx bx-block me-2"></i>' . __("Block") , "dropdown-item text-danger" , route("tagger.customers.status" , $id) , __("Block Customer")) !!}</li>
        @endif
    </ul>
</div>
