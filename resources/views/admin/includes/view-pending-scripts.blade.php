<script>
    //When Accept button is clicked
    $(".accept, .deny").click(function(e) {
        e.preventDefault();
        let res = confirm("Are you sure you want to Perform this action?");
        if (res) {
            window.location.href = $(this).attr('href');
        }
    });

    //When the Accept Bulk Button is clicked
    $("#bulkAccept").click(function(e) {
        $("#bulkActionField").val("accept");
        let res = confirm("Are you sure you want to Perform this action?");
        if (res) {
            $("#form").submit();
        }
    });

     //When the Deny Bulk Button is clicked
     $("#bulkDeny").click(function(e) {
        $("#bulkActionField").val("deny");
        let res = confirm("Are you sure you want to Perform this action?");
        if (res) {
            $("#form").submit();
        }
    });


    //When the Select all Checkbox is clicked
    $("#all").click(function(e) {
        $(".checkable").click();
    });
</script>ß