<script>
    $(function(){
        $("input[type='radio']").change(function(){
            len = $("input[type='radio']:checked").length;
            if(len == 0)
                $("button[type='submit']").prop("disabled", true);
            else
                $("button[type='submit']").removeAttr("disabled");
            });
        $("input[type='radio']").trigger('change');
    });
</script>
