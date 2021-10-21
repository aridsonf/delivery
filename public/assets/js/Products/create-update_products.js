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
                $(".messageBox").removeClass("d-none").html(response.message);
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
                $(".messageBox").removeClass("d-none").html(response.message);
                if (response.success === true) {
                    window.location.href = "/crud_products/";
                }
            },
        });
    });
});
