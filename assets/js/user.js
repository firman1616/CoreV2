$(document).ready(function () {
    tableUser();
    // tableUserAkses();
    $('#id').val('');
    $('#userForm').trigger("reset");

    $('#save-data').click(function (e) {
        e.preventDefault();

        $.ajax({
            data: $('#userForm').serialize(),
            url: BASE_URL + "User/store",
            type: "POST",
            datatype: 'json',
            success: function (data) {
                $('#userForm').trigger("reset");
                swal("Good job!", "Data Berhasil disimpan!", {
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                });
                tableUser();
            },
            error: function (data) {
                console.log('Error:', data);
                $('$save-data').html('Simpan Data');
            }
        });
    })

    $('body').on('click', '.edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "UOM/vedit/" + id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#id').val(id);
                $('#kode_satuan').val(data.kode);
                $('#nama_satuan').val(data.uom);

            }
        })
    })


    $('#showPassword').on('change', function () {
        var passwordInput = $('#password');
        var type = $(this).is(':checked') ? 'text' : 'password';
        passwordInput.attr('type', type);
    });

    // save role akses user
    $('#formAkses').submit(function (e) {
        e.preventDefault(); // mencegah reload

        var formData = $(this).serialize();
        const userId = $(this).data('user-id');

        $.ajax({
            url: BASE_URL + "User/update_akses/" + userId,
            type: "POST",
            data: formData,
            success: function (response) {
                swal("Good job!", "Data Berhasil disimpan!", {
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                });
                setTimeout(() => {
                    window.location.href = BASE_URL + "User";
                }, 1600);
            },
            error: function () {
                swal("Gagal!", "Terjadi kesalahan saat menyimpan!", {
                    icon: "error",
                    buttons: true,
                });
            }
        });
    });

});

function tableUser() {
    $.ajax({
        url: BASE_URL + "User/tableUser",
        type: "POST",
        success: function (data) {
            $('#div-table-user').html(data);
            $('#tableUser').DataTable({
                "processing": true,
                "responsive": true,
            });
        }
    });
}