$(function () {
    $('form[name="attDeliveryRequest"]').submit(function (event) {
        event.preventDefault();

        var delivery_id = $(this).find("input#delivery_id").val();
        $.ajax({
            url: "/update_delivery/" + delivery_id,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.stts == 1) {
                    $(".messageBoxError").addClass("d-none").html(response.msg);
                    $(".messageBoxSuccess")
                        .removeClass("d-none")
                        .html(response.msg);
                    window.location.href = "/show_request/" + delivery_id;
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

    $('form[name="delDeliveryRequest"]').submit(function (event) {
        event.preventDefault();

        var dados = $(this).serialize();

        var delivery_id = $(this).find("input#delivery_id").val();
        var client_name = $(this).find("input#delivery_client_name").val();

        Swal.fire({
            title:
                "Tem certeza que deseja deletar o pedido nº" +
                delivery_id +
                " do cliente " +
                client_name +
                "?",
            showDenyButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Cancelar pedido",
            denyButtonText: `Voltar`,
            preConfirm: function () {
                return new Promise(function (response) {
                    $.ajax({
                        url: "/delete_delivery/" + delivery_id,
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
                            window.location.href = "/list_request";
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
});
