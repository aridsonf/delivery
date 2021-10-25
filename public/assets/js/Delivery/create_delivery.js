$(function () {
    $('form[name="formCreateDelivery"]').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/create_delivery",
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(response.msg);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/list_request";
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
