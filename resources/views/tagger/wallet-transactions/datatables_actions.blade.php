<div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
    <ul class="dropdown-menu dropdown-menu-end m-0">
        <li>{!! ajax_button(
            '<i class="bx bxs-show me-2"></i>' . __('View'),
            'dropdown-item text-info',
            route('tagger.wallet-transactions.show', $id),
            __('View wallet transaction data'),
        ) !!}</li>
    </ul>
</div>
