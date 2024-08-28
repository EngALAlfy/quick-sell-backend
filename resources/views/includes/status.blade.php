
<div class="p-l-20 p-r-20">
    @if (session()->has('success'))
        <script id="notification_script">
            if (Notification.permission === "granted") {
                new Notification("Success", {
                    body: "{{ session('success') }}",
                    icon: "{{ asset('assets/admin/img/lead.png') }}"
                });
            } else {
                Notification.requestPermission();
            }
        </script>
    @endif

    @include('flash::message')

    @if ($errors->any())
        <div class="alert alert-danger d-flex" role="alert">
            <span class="badge badge-center rounded-pill bg-danger border-label-danger p-3 me-2"><i
                    class="bx bx-block fs-6"></i></span>
            <div class="d-flex flex-column ps-1">
                <h6 class="alert-heading d-flex align-items-center mb-1">{{__('Error')}}</h6>
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session()->has('status'))
        <div class="alert alert-success d-flex" role="alert">
            <span class="badge badge-center bg-success border-label-success me-2 p-3 rounded-pill">
                <i class="bx bx-check-double fs-3"></i>
            </span>
            <div class="d-flex ps-1">
                <h6 class="alert-heading d-flex align-items-center mb-1">{{ session('status') }}</h6>
            </div>
        </div>
    @endif


</div>
