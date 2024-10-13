$(".btn-alternatif").click(function () {
    var kode = $("input[name='kode']").val();
    var nama = $("input[name='nama']").val();

    var idKriteriaArr = [];
    var subKriteriaArr = [];

    // Mengambil idKriteria dan subKriteria dari elemen yang aktif
    $("input[name='idKriteria[]']").each(function () {
        var idKriteria = $(this).val();
        var subKriteria = $("#subKriteria_" + idKriteria).val();

        // Menambahkan data ke array
        idKriteriaArr.push(idKriteria);
        subKriteriaArr.push(subKriteria);
    });

    // Validasi data sebelum mengirim ke server
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
    } else if (idKriteriaArr.length == 0) {
        Swal.fire({
            type: 'warning',
            title: 'Oops...',
            text: 'Maaf .. Kriteria Wajib Diisi !',
            icon: "warning"
        });
    } else if (subKriteriaArr.length == 0) {
        Swal.fire({
            type: 'warning',
            title: 'Oops...',
            text: 'Maaf .. subKriteria Wajib Diisi !',
            icon: "warning"
        });
    } else {
        // Mengirim data ke PHP melalui AJAX
        $.ajax({
            url: "../page/act/tambah_alternatif.php",
            type: "POST",
            data: {
                "kode": kode,
                "nama": nama,
                "idKriteria": idKriteriaArr,
                "subKriteria": subKriteriaArr
            },
            success: function (response) {
                if (response == "success") {
                    Swal.fire({
                        type: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil disimpan!',
                        icon: "success"
                    }).then(function () {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan, coba lagi!',
                        icon: "error"
                    });
                }
                console.log(response);
            },
            error: function (response) {
                Swal.fire({
                    type: 'error',
                    title: 'Opps!',
                    text: 'Server error!',
                    icon: "question"
                });
                console.log(response);
            }
        });
    }
});