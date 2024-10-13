$(document).ready(function () {
    $(".btn-Ukriteria").click(function () {
        var idKriteria = $("#idKriteria").val();
        var kode = $("#kode").val();
        var nama = $("#nama").val();
        if (kode.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Maaf.. kode Wajib Diisi !',
                icon: "warning"
            });
        } else if (nama.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Maaf .. nama Wajib Diisi !',
                icon: "warning"
            });
        } else {
            $.ajax({
                url: "../page/act/edit_kriteria.php",
                type: "POST",
                data: {
                    "idKriteria": idKriteria,
                    "kode": kode,
                    "nama": nama
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