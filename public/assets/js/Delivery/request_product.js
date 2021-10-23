$(function () {
    $('form[name="formAddProduct"]').submit(function (event) {
        event.preventDefault();
        console.log(this);

        $.ajax({
            url: "/shopping_request",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(response.msg);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/list_users";
                } else {
                    console.log(response.msg);
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
