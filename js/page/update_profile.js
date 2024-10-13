$(document).ready(function () {
    $(".btn-profile").click(function () {
        var id = $("#id").val();
        var nama = $("#nama").val();
        var email = $("#email").val();
        var password = $("#password").val();
        if (nama.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Maaf.. nama Wajib Diisi !',
                icon: "warning"
            });
        } else if (email.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Maaf .. email Wajib Diisi !',
                icon: "warning"
            });
        } else {
            $.ajax({
                url: "../page/act/edit_profile.php",
                type: "POST",
                data: {
                    "id": id,
                    "nama": nama,
                    "email": email,
                    "password": password
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