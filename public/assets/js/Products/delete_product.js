$(function () {
    $('form[name="formDeleteProduct"]').submit(function (event) {
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
                        url: "/crud_products/" + product_id,
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
                            window.location.href = "/crud_products";
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
