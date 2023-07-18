$(document).ready(function () {
    // $("#current_pwd").on("change", function () {
    //     alert("Works");
    // });
    //$("#current_pwd").keyup(function () {
    $("#current_pwd").on("change", function () {
        var current_pwd = $("#current_pwd").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            type: "POST",
            url: "/admin/check-current-pwd",
            data: { current_pwd: current_pwd },
            success: function (resp) {
                if (resp == "false") {
                    $("#verifycurrentpwd").html(
                        '<span style="color:red">Current password is Incorrect Password</span>'
                    );
                } else if (resp == "true") {
                    $("#verifycurrentpwd").html(
                        '<span style="color:green">Current password is Correct password</span>'
                    );
                }
            },
            error: function () {
                console.log("Error");
            },
        });
    });
    $("#confirm_pwd").on("change", function () {
        var new_pwd = $("#new_pwd").val();
        var confirm_pwd = $("#confirm_pwd").val();
        if (new_pwd !== confirm_pwd) {
            $("#verifyConfirmwd").html(
                '<span style="color:red">New password and Confirm password not matched</span>'
            );
            $("#confirm_pwd").val("");
        }
    });
});
