$(function () {
    $('form[name="formEditUser"]').submit(function (event) {
        event.preventDefault();

        var user_id = $(this).find("input#user_id").val();
        $.ajax({
            url: "/list_users/" + user_id,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.stts == 1) {
                    console.log(response.msg);
                    $(".messageBoxError").addClass("d-none").html(response.msg);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/dashboard";
                } else {
                    $(".messageBoxSuccess")
                        .addClass("d-none")
                        .html(response.msg);
                    $(".messageBoxError")
                        .removeClass("d-none")
                        .html(response.msg);
                }
            },
        });
    });

    $('form[name="formCadUser"]').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/create_users",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                $(".messageBox").removeClass("d-none").html(response.message);
                if (response.stts == 1) {
                    console.log(response.msg);
                    $(".messageBoxError").addClass("d-none").html(response.msg);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/list_users";
                } else {
                    $(".messageBoxSuccess")
                        .addClass("d-none")
                        .html(response.msg);
                    $(".messageBoxError")
                        .removeClass("d-none")
                        .html(response.msg);
                }
            },
        });
    });
});
