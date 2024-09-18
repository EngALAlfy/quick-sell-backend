<script>
    $(function () {
        document.querySelector('li.active').scrollIntoView({
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
    function handleSelect2() {
        // Selectors
        var selectpicker = $(".selectpicker");
        var select2 = $(".select2");
        var select2Icons = $(".select2-icons");

        // Custom template function
        function formatOption(option) {
            if (option.id) {
                var icon = $(option.element).data("icon");
                return "<i class='" + icon + " me-2'></i>" + option.text;
            }
            return option.text;
        }

        // Initialize selectpicker
        if (selectpicker.length) {
            selectpicker.selectpicker();
        }

        // Initialize select2
        if (select2.length) {
            select2.each(function () {
                var select = $(this);
                select.select2({
                    dropdownParent: select.parent(),
                });
            });
        }

        // Initialize select2 with icons
        if (select2Icons.length) {
            select2Icons.select2({
                dropdownParent: select2Icons.parent(),
                templateResult: formatOption,
                templateSelection: formatOption,
                escapeMarkup: function (markup) {
                    return markup;
                }
            });
        }
        // Init BS Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        $('select[has_new_item]').each(function (){
            let flg = 0;
            const selectElement = $(this);
            selectElement.on("select2:open", function () {
                flg++;

                if (flg == 1) {
                    const $select2Container = selectElement.data('select2').$dropdown.find('.select2-results');
                    let new_item_route = selectElement.attr("new_item_route")
                    let new_item_attrs = selectElement.attr("new_item_attrs")
                    let data_html_title = selectElement.attr("data-html-title")
                    $select2Container.append(`<div class='select2-results__option'>
                        <a href="${new_item_route}" ${new_item_attrs} data-html-title="${data_html_title}"  class="ajax-btn btn btn-link"><i class="fa fa-plus me-2"></i> ${data_html_title}</a>
                    </div>`);
                }
            });
        })

    }

    function onAjaxActionModalShow() {
        handleSelect2();
    }

    function onAjaxActionOffcanvasShow() {
        handleSelect2();
    }
</script>
