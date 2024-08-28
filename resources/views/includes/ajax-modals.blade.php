<script>
    $(function () {
        document.querySelector('li.active.selected').scrollIntoView({
            behavior: 'smooth'
        });
    });

    $(function () {
        $(document).on("click", ".delete-form button , .delete-button", function (e) {
            e.preventDefault();
            let form = $(e.target).parents('form').eq(0);
            $.confirm({
                    title: '{{__("Are you sure?")}}',
                    content: '{{__("You won't be able to revert this!")}}',
                    icon: 'fa fa-warning',
                    type: 'red',
                    typeAnimated: true,
                    // todo:: make it in settings
                    theme: 'supervan',
                    rtl: {{(int) IS_RTL}},
                    buttons: {
                        confirm: function () {
                            form.submit();
                        },
                        cancel: function () {

                        },
                    }
                }
            );
            // todo: add this to settings (confirm type)
            // swal.fire({
            //     title: '',
            //     text: "You won't be able to revert this!",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Yes, delete it!'
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         form.submit();
            //     }
            // })
        });
    });
</script>


{!! ajax_actions_init() !!}

{!! ajax_actions_modal() !!}

{!! ajax_actions_offcanvas() !!}

<script>
    function onAjaxActionModalShow() {
        initFormHelpers();
        // Init BS Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    function onAjaxActionOffcanvasShow() {
        // Init BS Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
</script>
