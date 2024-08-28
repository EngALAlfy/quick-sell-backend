<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/fonts/boxicons.css') }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/css/rtl/core.css') }}"
    class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/css/rtl/theme-default.css') }}"
    class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/apex-charts/apex-charts.css') }}" />
<link rel="stylesheet"
    href="{{ asset('assets/admin/sneat/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/select2/select2.css') }}" />

<!-- Page CSS -->

<!-- Helpers -->
<script src="{{ asset('assets/admin/sneat/vendor/js/helpers.js') }}"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/admin/sneat/js/config.js') }}"></script>

@if (\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() === 'rtl')
@else
@endif

<!-- Common CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/pace/pace-theme-default.css') }}" />

{{--  datatables  --}}
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/datatables-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/datatables-bs5/datatables.checkboxes.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/datatables-bs5/select.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/sneat/vendor/libs/datatables-bs5/buttons.bootstrap5.css') }}">

<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">

@vite(['resources/js/app.js', 'resources/css/app.css'])
@livewireStyles

@wireUiScripts
@stack('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
