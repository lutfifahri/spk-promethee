$(document).ready(function () {
    $(".btn-login").click(function () {
        var email = $("#email").val();
        var password = $("#password").val();
        if (email.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'email Wajib Diisi !'
            });
        } else if (password.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Password Wajib Diisi !'
            });
        } else {
            $.ajax({
                url: "login.php",
                type: "POST",
                data: {
                    "email": email,
                    "password": password
                },
                success: function (response) {
                    if (response == "success") {
                        Swal.fire({
                                type: 'success',
                                title: 'Login Berhasil!',
                                text: 'Anda Berhasil Login',
                            })
                            .then(function () {
                                window.location.href = "page/dashboard.php";
                            });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Login Gagal!',
                            text: 'silahkan coba lagi!'
                        });
                    }
                    console.log(response);
                },
                error: function (response) {
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'server error!'
                    });
                    console.log(response);
                }
            });
        }
    });
});