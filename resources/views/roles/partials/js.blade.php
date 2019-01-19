<script>
    (function(){
        $('input:radio').click(function(){
            $('input:checkbox').prop('checked', false);
        });
        $('input:checkbox').click(function(){
            $('input:radio').prop('checked', false);
        });

    })()
</script>