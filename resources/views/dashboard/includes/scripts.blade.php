<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset("assets/admin/sneat/vendor/libs/jquery/jquery.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/popper/popper.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/js/bootstrap.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/js/menu.js")}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset("assets/admin/sneat/vendor/libs/apex-charts/apexcharts.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/select2/select2.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/jquery-repeater/jquery-repeater.js")}}"></script>

<!-- Main JS -->
<script src="{{asset("assets/admin/sneat/js/main.js")}}"></script>

@livewireScripts
<script src="{{ asset('assets/admin/sneat/js/forms-extras.js') }}"></script>

{{--  datatables  --}}
<script src="{{ asset('assets/admin/sneat/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>


<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>


@stack("scripts")

<script src="{{asset("assets/admin/sneat/vendor/libs/pace/pace.js")}}"></script>

<script>
    $(document).ajaxStart(function () {
        Pace.restart();
    });
</script>

<script>
    // jQuery to handle editing for multiple inputs
    $(document).ready(function () {
        $('.edit-button').click(function () {
            let $input = $(this).closest('.input-group').find('.editable-input');
            if ($input.prop('readonly')) {
                $input.prop('readonly', false);
            } else {
                $input.prop('readonly', true);
            }
        });
    });
</script>

<script>
    $(function () {
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

        $("select[name$='-table_length']").each(function() {
            $(this).select2();
        });
    });
</script>
@include("includes.ajax-modals")
