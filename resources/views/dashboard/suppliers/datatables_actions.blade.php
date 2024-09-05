<div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                               data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
    <ul class="dropdown-menu dropdown-menu-end m-0">
        <li>{!! ajax_button('<i class="bx bxs-show me-2"></i>' . __("View") , "dropdown-item text-info" , route("dashboard.categories.show" , $id) , __("View category data")) !!}</li>
        <li>{!! ajax_button('<i class="bx bxs-edit me-2"></i>' . __("Edit") , "dropdown-item text-warning" , route("dashboard.categories.edit" , $id) , __("Edit category")) !!}</li>
        <div class="dropdown-divider"></div>
        {{html()->form('DELETE')->route("dashboard.categories.destroy" , $id)->open()}}
        <li><a href="javascript:void(0);" class="dropdown-item text-danger delete-record delete-button"><i class="bx bxs-trash me-2"></i>{{__('Delete')}}</a></li>
        {{html()->form()->close()}}
    </ul>
</div>
