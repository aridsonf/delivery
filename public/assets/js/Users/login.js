$(function () {
    $('form[name="formLogin"]').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/auth/",
            type: "get",
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
});
