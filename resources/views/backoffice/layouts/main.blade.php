<?php
$settingService = app(\App\Services\ApiService::class);
$settingResp = $settingService->get('admin/settings');
$settingData = $settingResp['data']['setting'] ?? [];
$setting = (object) $settingData;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:.*Dashboard*.:</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Google Font: Inter (modern) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            important: true,
            corePlugins: { preflight: false },
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/../../Admin/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- {{ asset('/css/bootstrap-tagsinput.css') }} --}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/../../Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/../../Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/../../Admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/../../Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/../../Admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/../../Admin/plugins/summernote/summernote-bs4.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/../../Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/../../Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/../../Admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('/../../Admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/../../Admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('/../../Admin/css/backoffice.css') }}">
    <link rel="stylesheet" href="{{ asset('/../../Admin/css/backoffice-modern.css') }}">
    <link rel="icon" href="{{ asset('/../../Admin/image/NYOBAINmini.png') }}" type="image/gif">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('backoffice.layouts.navbar')

        @include('backoffice.layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
           <section class="content">
                <div class="container-fluid">
                <audio id="notification-deposit" src="/../../assets/mp3/notif1.wav" preload="auto"></audio>
                <audio id="notification-withdraw" src="/../../assets/mp3/notif1.wav" preload="auto"></audio>
                    @yield('content')

                </div><!-- /.container-fluid -->
            </section> 
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>
                <!-- --> &copy; 2026 <a href="#"></a>.
            </strong>
            Semakin keras saya bekerja, maka semakin banyak keberuntungan yang saya miliki.

            <div class="float-right d-none d-sm-inline-block">
                <a target="_blank" href="" class="href">
                    <b style="color:black; ">Next Provide AMSGRUP</b>
                </a>
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/../../Admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/../../Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/../../Admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('/../../Admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/../../Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('/../../Admin/../../Admin/../../Admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/../../Admin/../../Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/../../Admin/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/../../Admin/dist/js/pages/dashboard.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/../../Admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/../../Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/../../Admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var notifiedIds = [];

        var depositToast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            showCloseButton: true,
            customClass: {
                popup: 'swal2-deposit-toast',
                title: 'swal2-toast-title',
                htmlContainer: 'swal2-toast-body'
            },
            showClass: { popup: 'animate__animated animate__fadeInRight animate__faster' },
            hideClass: { popup: 'animate__animated animate__fadeOutRight animate__faster' },
            didOpen: function(toast) {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        var withdrawToast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            showCloseButton: true,
            customClass: {
                popup: 'swal2-withdraw-toast',
                title: 'swal2-toast-title',
                htmlContainer: 'swal2-toast-body'
            },
            showClass: { popup: 'animate__animated animate__fadeInRight animate__faster' },
            hideClass: { popup: 'animate__animated animate__fadeOutRight animate__faster' },
            didOpen: function(toast) {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        function checkDeposits() {
            $.ajax({
                url: '/deposits/today',
                method: 'GET',
                success: function(data) {
                    if (data.length > 0) {
                        document.getElementById('notification-deposit').play().catch(function(){});

                        data.forEach(function(d) {
                            if (notifiedIds.indexOf(d.id) !== -1) return;
                            notifiedIds.push(d.id);
                            var u = d.user || {};
                            var amount = new Intl.NumberFormat('id-ID').format(d.amount || 0);
                            depositToast.fire({
                                title: '<span class="toast-icon">&#x1F4B0;</span> Deposit Baru',
                                html: '<strong>Rp ' + amount + '</strong><br><small style="color:#9ca3af">' + (u.username || '-') + ' &middot; ' + moment(d.created_at).fromNow() + '</small>'
                            });
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Gagal mengambil data:', error);
                }
            });
        }

        setInterval(checkDeposits, 15000);

        function checkWithdraws() {
            $.ajax({
                url: '/withdraw/today',
                method: 'GET',
                success: function(data) {
                    if (data.length > 0) {
                        document.getElementById('notification-withdraw').play().catch(function(){});
                        data.forEach(function(w) {
                            if (notifiedIds.indexOf(w.id) !== -1) return;
                            notifiedIds.push(w.id);
                            var u = w.user || {};
                            var amount = new Intl.NumberFormat('id-ID').format(w.amount || 0);
                            withdrawToast.fire({
                                title: '<span class="toast-icon">&#x1F4B8;</span> Withdraw Baru',
                                html: '<strong>Rp ' + amount + '</strong><br><small style="color:#9ca3af">' + (u.username || '-') + ' &middot; ' + moment(w.created_at).fromNow() + '</small>'
                            });
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Gagal mengambil data:', error);
                }
            });
        }

        setInterval(checkWithdraws, 15000);

        // Notifications
        function checkNotifications() {
            $.get('/Admin/Dashboard/notifications/unread', function(res) {
                var items = res.data || [];
                $('#notifCount').text(items.length);
                $('#notifHeader').text(items.length + ' Notifications');
                var html = '';
                items.forEach(function(n) {
                    var icon = n.type == 'deposit' ? 'fa-arrow-down text-success' : 'fa-arrow-up text-warning';
                    var link = n.type == 'withdraw' ? '/Admin/Dashboard/Withdraw' : '/Admin/Dashboard/Tranksaksi';
                    html += '<div class="dropdown-divider"></div><a href="' + link + '" class="dropdown-item"><i class="fas ' + icon + ' mr-2"></i> ' + n.message + ' <span class="float-right text-muted text-sm">' + n.time + '</span></a>';
                });
                if (!items.length) html = '<div class="dropdown-divider"></div><a href="#" class="dropdown-item text-muted">Tidak ada notifikasi</a>';
                $('#notifList').html(html);
            });
        }
        setInterval(checkNotifications, 30000);
        checkNotifications();
    </script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @php
        $__flashes = [];
        foreach (['success','error','info','warning','LoginError'] as $__t) {
            if (session($__t)) { $__flashes[] = ['type'=>$__t === 'LoginError' ? 'error' : $__t, 'message'=>session($__t)]; }
        }
        foreach ($errors->all() as $__e) { $__flashes[] = ['type'=>'error', 'message'=>$__e]; }
    @endphp
    @if(count($__flashes))
    <script>
    (function() {
        var customSwal = Swal.mixin({
            customClass: {
                popup: 'swal2-modern-popup',
                title: 'swal2-modern-title',
                htmlContainer: 'swal2-modern-text',
                confirmButton: 'swal2-modern-btn',
                icon: 'swal2-modern-icon'
            },
            confirmButtonText: 'OK',
            buttonsStyling: false,
            showCloseButton: true,
            showClass: { popup: 'animate__animated animate__fadeInDown animate__faster' },
            hideClass: { popup: 'animate__animated animate__fadeOutUp animate__faster' }
        });

        var __flashes = @json($__flashes);
        __flashes.forEach(function(f) {
            var cfg = { icon: f.type === 'LoginError' ? 'error' : f.type, title: f.message };

            if (f.type === 'success') {
                cfg.title = '<span style="color:#059669">&#10003; Berhasil</span>';
                cfg.html = '<p style="color:#6b7280;font-size:14px;margin-top:8px">' + f.message + '</p>';
                cfg.icon = null;
            } else if (f.type === 'error' || f.type === 'LoginError') {
                cfg.title = '<span style="color:#dc2626">&#10007; Gagal</span>';
                cfg.html = '<p style="color:#6b7280;font-size:14px;margin-top:8px">' + f.message + '</p>';
                cfg.icon = null;
            } else if (f.type === 'warning') {
                cfg.title = '<span style="color:#d97706">&#9888; Peringatan</span>';
                cfg.html = '<p style="color:#6b7280;font-size:14px;margin-top:8px">' + f.message + '</p>';
                cfg.icon = null;
            } else if (f.type === 'info') {
                cfg.title = '<span style="color:#0891b2">&#8505; Informasi</span>';
                cfg.html = '<p style="color:#6b7280;font-size:14px;margin-top:8px">' + f.message + '</p>';
                cfg.icon = null;
            }

            customSwal.fire(cfg);
        });
    })();
    </script>
    <style>
        .swal2-modern-popup {
            border-radius: 16px !important;
            box-shadow: 0 25px 60px rgba(0,0,0,.22), 0 8px 20px rgba(0,0,0,.1) !important;
            padding: 28px 32px !important;
            max-width: 440px !important;
        }
        .swal2-modern-title {
            font-size: 18px !important;
            font-weight: 700 !important;
            padding: 0 !important;
        }
        .swal2-modern-text {
            font-size: 14px !important;
            margin: 0 !important;
        }
        .swal2-modern-btn {
            display: inline-block !important;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            color: #fff !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 10px 32px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all .2s !important;
            box-shadow: 0 4px 14px rgba(99,102,241,.35) !important;
        }
        .swal2-modern-btn:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 20px rgba(99,102,241,.45) !important;
        }
        .swal2-modern-icon {
            border: none !important;
        }
    </style>
    @endif
    <style>
        .swal2-deposit-toast {
            background: #fff !important;
            border-left: 4px solid #059669 !important;
            border-radius: 10px !important;
            box-shadow: 0 8px 30px rgba(5,150,105,.15), 0 2px 8px rgba(0,0,0,.08) !important;
            padding: 14px 18px !important;
        }
        .swal2-withdraw-toast {
            background: #fff !important;
            border-left: 4px solid #d97706 !important;
            border-radius: 10px !important;
            box-shadow: 0 8px 30px rgba(217,119,6,.15), 0 2px 8px rgba(0,0,0,.08) !important;
            padding: 14px 18px !important;
        }
        .swal2-toast-title {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #1f2937 !important;
        }
        .swal2-toast-body {
            font-size: 13px !important;
            color: #374151 !important;
        }
        .toast-icon {
            font-size: 18px;
            margin-right: 6px;
        }
        .swal2-timer-progress-bar {
            background: linear-gradient(90deg, #6366f1, #8b5cf6) !important;
            height: 3px !important;
        }
    </style>
</body>

</html>
