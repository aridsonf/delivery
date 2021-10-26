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
                errors = "";
                if (response.erros) {
                    Object.keys(response.erros).forEach(function (key) {
                        errors += response.erros[key] + "<br>";
                    });
                }
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(errors);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/crud_products/";
                } else {
                    $(".messageBoxSuccess")
                        .addClass("d-none")
                        .html(response.msg);
                    $(".messageBoxError").removeClass("d-none").html(errors);
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
                errors = "";
                if (response.erros) {
                    Object.keys(response.erros).forEach(function (key) {
                        errors += response.erros[key] + "<br>";
                    });
                }
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(errors);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/crud_products/";
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
