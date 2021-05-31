{{--This has jquery, bootstrap--}}
<script src="{{ asset('js/app.js') }}"></script>

<!-- daterangepicker -->
{{--<script src="{{ asset('AdminLTE/plugins/moment/min/moment.min.js') }}"></script>--}}
{{--<script src="{{ asset('AdminLTE/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>--}}

<!-- datepicker -->
{{--<script src="{{ asset('AdminLTE/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}
{{--<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js') }}"></script>--}}

<!-- Slimscroll -->
<script src="{{ asset('AdminLTE/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- FastClick -->
<script src="{{ asset('AdminLTE/plugins/fastclick/lib/fastclick.js') }}"></script>

{{--<script src="{{ asset('AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>--}}

<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="{{ asset('js/Loading.js') }}"></script>
<script src="{{ asset('js/APIService.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        }
    });

    $("#sidebar_toggle").click(function() {
        if(localStorage.getItem("sidebar")){
            localStorage.removeItem("sidebar");
        } else {
            localStorage.setItem("sidebar", "sidebar-collapse");
        }
    });

    if(localStorage.getItem("sidebar")){
        $('body').addClass('sidebar-collapse');
    }

    $('.delete-item').click(function(){
        if (confirm("Are you sure?")) {
            $("#" + $(this).data('form')).submit();
        }
    });

    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
