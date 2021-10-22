$(function () {
    $('form[name="formDeleteUser"]').submit(function (event) {
        event.preventDefault();

        var dados = $(this).serialize();

        var user_id = $(this).find("input#user_id").val();

        Swal.fire({
            title: "Tem certeza que deseja deletar o usuário?",
            showDenyButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Deletar",
            denyButtonText: `Cancelar`,
            preConfirm: function () {
                return new Promise(function (response) {
                    $.ajax({
                        url: "/delete_user/" + user_id,
                        type: "delete",
                        data: dados,
                        dataType: "json",
                    })
                        .done(function (response) {
                            Swal.fire(
                                "Deletado!",
                                "Usuário deletado com sucesso",
                                "success"
                            );
                            window.location.href = "/list_users";
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
