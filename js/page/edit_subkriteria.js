$(document).ready(function () {
    $(".btn-sUbkriteria").click(function () {
        var idSubkriteria = $("#idSubkriteria").val();
        var nama = $("#nama").val();
        var bobot = $("#bobot").val();
        if (nama.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Maaf.. nama Wajib Diisi !',
                icon: "warning"
            });
        } else if (bobot.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'bobot .. nama Wajib Diisi !',
                icon: "warning"
            });
        } else {
            $.ajax({
                url: "../page/act/edit_subkriteria.php",
                type: "POST",
                data: {
                    "idSubkriteria": idSubkriteria,
                    "nama": nama,
                    "bobot": bobot
                },
                success: function (response) {
                    if (response == "success") {
                        Swal.fire({
                                type: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan!',
                                icon: "success"
                            })
                            .then(function () {
                                window.location.reload();
                            });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Login Gagal!',
                            text: 'silahkan coba lagi!',
                            icon: "error"
                        });
                    }
                    console.log(response);
                },
                error: function (response) {
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'server error!',
                        icon: "question"
                    });
                    console.log(response);
                }
            });
        }
    });
});