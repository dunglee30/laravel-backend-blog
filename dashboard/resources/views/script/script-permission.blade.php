<script>
    $(function(){
        $("input[type='checkBox']").change(function(){
            len = $("input[type='checkBox']:checked").length;
            if(len == 0)
                $("button[type='submit']").prop("disabled", true);
            else
                $("button[type='submit']").removeAttr("disabled");
            });
        $("input[type='checkBox']").trigger('change');
    });
</script>
