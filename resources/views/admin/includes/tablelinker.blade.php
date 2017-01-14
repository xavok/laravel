<script>
    $(document).ready(function() {
        $('.table-linker tr').click(function(x) {
            x.preventDefault();
            var href = $(this).data('href');
            if (href != '' && href != 'undefined' && href != null) {
                window.location.href = href;
                return false;
            }
        });
    });
</script>