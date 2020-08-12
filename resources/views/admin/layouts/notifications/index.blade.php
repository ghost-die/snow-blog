






@if (session('info'))
<script>
    {{--md.notification("{{ session('info') }}",'info','notification_important')--}}

    toastr.info("{{ session('info') }}");
</script>
@elseif(session('success'))
    <script>
{{--        md.notification("{{ session('success') }}",'primary','add_alert')--}}
        toastr.success("{{ session('success') }}");
    </script>
@elseif(session('error'))
    <script>
        {{--md.notification("{{ session('error') }}",'danger','error')--}}
        toastr.error("{{ session('error') }}");
    </script>
@elseif(session('warning'))
    <script>
{{--        md.notification("{{ session('warning') }}",'warning','warning')--}}

        toastr.warning("{{ session('warning') }}");
    </script>
@elseif(session('login'))
    <script>
        // md.showNotification();
        toastr.success("欢迎登陆");
    </script>
@endif
