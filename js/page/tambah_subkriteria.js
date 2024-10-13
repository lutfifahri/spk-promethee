$(document).ready(function () {
    $(".btn-subkriteria").click(function () {
        var idKriteria = $("#idKriteria").val();
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
                text: 'Maaf .. bobot Wajib Diisi !',
                icon: "warning"
            });
        } else {
            $.ajax({
                url: "../page/act/tambah_subkriteria.php",
                type: "POST",
                data: {
                    "idKriteria": idKriteria,
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