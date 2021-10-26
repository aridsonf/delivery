$(function () {
    $('form[name="formEditProduct"]').submit(function (event) {
        event.preventDefault();

        var product_id = $(this).find("input#product_id").val();
        $.ajax({
            url: "/crud_products/" + product_id,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.stts == 1) {
                    $(".messageBoxError")
                        .addClass("d-none")
                        .html(response.erros);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.erros);
                } else {
                    $(".messageBoxSuccess")
                        .addClass("d-none")
                        .html(response.erros);
                    $(".messageBoxError")
                        .removeClass("d-none")
                        .html(response.erros);
                }
            },
        });
    });

    $('form[name="formCadProduct"]').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/crud_products",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.stts == 1) {
                    $(".messageBoxError")
                        .addClass("d-none")
                        .html(response.erros);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.erros);
                    window.location.href = "/crud_products/";
                } else {
                    $(".messageBoxSuccess")
                        .addClass("d-none")
                        .html(response.erros);
                    $(".messageBoxError")
                        .removeClass("d-none")
                        .html(response.erros[1]);
                }
            },
        });
    });
});
