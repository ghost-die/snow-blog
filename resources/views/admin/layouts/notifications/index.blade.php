




@if (session('info'))
<script>
    md.notification("{{ session('info') }}",'info','notification_important')
</script>
@elseif(session('success'))
    <script>
        md.notification("{{ session('success') }}",'primary','add_alert')
    </script>
@elseif(session('error'))
    <script>
        md.notification("{{ session('error') }}",'danger','error')
    </script>
@elseif(session('warning'))
    <script>
        md.notification("{{ session('warning') }}",'warning','warning')
    </script>
@elseif(session('login'))
    <script>
        md.showNotification();
    </script>
@endif
