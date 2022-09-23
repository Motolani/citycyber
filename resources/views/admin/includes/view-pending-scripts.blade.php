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
        // let res = confirm("Are you sure you want to Perform this action?");
        Swal.fire({
            showDenyButton: false,
            showCancelButton: true,
            icon: 'info',
            title: 'Confirm',
            text: 'Are you sure you want to Perform this action?',
            // footer: '<a href="">Why do I have this issue?</a>'
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                // Swal.fire('Saved!', '', 'success')
                $("#form").submit();
            } else if (result.isDenied) {
            }
        })
        // if (res) {
            
        // }
    });

     //When the Deny Bulk Button is clicked
     $("#bulkDeny").click(function(e) {
        $("#bulkActionField").val("deny");
        // let res = confirm("Are you sure you want to Perform this action?");
        Swal.fire({
            showCancelButton: true,
            icon: 'info',
            title: 'Confirm',
            text: 'State reason for disapproval',
            input: 'textarea'
        }).then(function(result) {
            if (result.value) {
                $("#bulkActionComment").val(result.value);
                $("#form").submit();
            }
        })
        // if (res) {
            
        // }
    });


    //When the Select all Checkbox is clicked
    $("#all").click(function(e) {
        $(".checkable").click();
    });
</script>