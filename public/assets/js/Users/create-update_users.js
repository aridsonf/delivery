$(function () {
    $('form[name="formEditUser"]').submit(function (event) {
        event.preventDefault();

        var user_id = $(this).find("input#user_id").val();
        $.ajax({
            url: "/update_users/" + user_id,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                errors = "";
                Object.keys(response.erros).forEach(function (key) {
                    errors += response.erros[key] + "<br>";
                });
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(errors);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/list_users";
                } else {
                    $(".messageBoxSuccess")
                        .addClass("d-none")
                        .html(response.msg);
                    $(".messageBoxError").removeClass("d-none").html(errors);
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
                errors = "";
                Object.keys(response.erros).forEach(function (key) {
                    errors += response.erros[key] + "<br>";
                });
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(errors);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/list_users";
                } else {
                    $(".messageBoxSuccess")
                        .addClass("d-none")
                        .html(response.msg);
                    $(".messageBoxError").removeClass("d-none").html(errors);
                }
            },
        });
    });
});
