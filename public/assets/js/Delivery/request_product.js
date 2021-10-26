$(function () {
    $('form[name="formAddRequestData"]').submit(function (event) {
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
    $('form[name="formAttRequestData"]').submit(function (event) {
        event.preventDefault();

        var product_id = $(this).find("input#product_id").val();
        $.ajax({
            url: "/update_request/" + product_id,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(response.msg);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
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
    $('form[name="formDelRequestData"]').submit(function (event) {
        event.preventDefault();

        var dados = $(this).serialize();

        var product_id = $(this).find("input#product_id").val();
        var product_name = $(this).find("input#product_name").val();

        Swal.fire({
            title:
                "Tem certeza que deseja deletar o produto: " +
                product_name +
                "?",
            showDenyButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Deletar",
            denyButtonText: `Cancelar`,
            preConfirm: function () {
                return new Promise(function (response) {
                    $.ajax({
                        url: "/delete_request/" + product_id,
                        type: "delete",
                        data: dados,
                        dataType: "json",
                    })
                        .done(function (response) {
                            Swal.fire(
                                "Deletado!",
                                "Produto deletado com sucesso",
                                "success"
                            );
                            window.location.href = "/edit_request";
                        })
                        .fail(function () {
                            Swal.fire(
                                "Não deletado!",
                                "Ação cancelada pelo usuário",
                                "error"
                            );
                        });
                });
            },
        });
    });
    //Atualizando para colocar a quantidade dos produtos atendida
    $('form[name="formAttRequestDataDelivered"]').submit(function (event) {
        event.preventDefault();

        var dados = $(this).serialize();

        var product_id = $(this).find("input#product_id").val();
        $.ajax({
            url: "/update_request_delivered/" + product_id,
            type: "put",
            data: dados,
            dataType: "json",
            success: function (response) {
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(response.msg);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
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
