let data_table;

function clearFields(){
    $("#nama").val("");
    $("#nip").val("");
}

$(document).ready(function() {
    data_table = $('#order-table').DataTable({
        "order": [
            [3, "asc"]
        ]
    });

    $.extend(true, $.fn.dataTable.defaults, {
        "searching": false,
        "ordering": false
    });
});

$(".close-btn").on("click", function(){
    clearFields();
})

$("#store").on("click", function(){
    let nama_pasien = $("#nama_pasien").val(),
        kode_pasien = $("#kode_pasien").val(),
        waktu_masuk = $("#waktu_masuk").val(),
        jenis_layanan = $("#jenis_layanan").val();

    $("#large-Modal").modal('hide');

    $.ajax({
        url: '/pasien/store-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "nama": nama_pasien,
            "kode": kode_pasien,
            "waktu_masuk": waktu_masuk,
            "jenis_layanan": jenis_layanan,
        },
        success: function(response){
            if(response.status){
                Swal.fire({
                    title: 'Success',
                    text: "Berhasil Menambahkan Data!",
                    icon: 'success',
                    confirmButtonText: 'Oke'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            }else{
                Swal.fire({
                    title: 'Oops..',
                    text: `${response.message}`,
                    icon: 'error',
                    confirmButtonText: 'Oke'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $("#large-Modal").modal('show');
                    }
                })
            }
        },
        error: function(response){
            console.log(response);
        }
    })
})

$(".edit").on('click', function(){
    let id = $(this).data('id');

    $.ajax({
        url: '/pasien/edit-data',
        method: 'GET',
        data: {
            "id": id
        },
        success: function(response){
            if(response.status){
                $("#id_pasien").val(response.data.id);
                $("#edit_nama_pasien").val(response.data.nama);
                $("#edit_kode_pasien").val(response.data.kode);
                $("#edit_waktu_masuk").val(response.data.waktu_masuk);
                $("#edit_jenis_layanan").val(response.data.jenis_layanan_id);
            }else{
                Swal.fire({
                    title: 'Oops..',
                    text: `${response.message}`,
                    icon: 'error',
                    confirmButtonText: 'Oke'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $("#large-Modal").modal('show');
                    }
                })
            }
        },
        error: function(response){
            console.log(response);
        }
    })
    $("#edit-Modal").modal('show');
})

$("#update").on('click', function(){
    $("#edit-Modal").modal('hide');
    $.ajax({
        url: '/pasien/update-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "id": $("#id_pasien").val(),
            "nama": $("#edit_nama_pasien").val(),
            "kode": $("#edit_kode_pasien").val(),
            "waktu_masuk": $("#edit_waktu_masuk").val(),
            "jenis_layanan": $("#edit_jenis_layanan").val()
        },
        success: function(response){
            if(response.status){
                Swal.fire({
                    title: 'Success',
                    text: "Berhasil Mengupdate Data!",
                    icon: 'success',
                    confirmButtonText: 'Oke'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            }else{
                Swal.fire({
                    title: 'Oops..',
                    text: `${response.message}`,
                    icon: 'error',
                    confirmButtonText: 'Oke'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $("#edit-Modal").modal('show');
                    }
                })
            }
        },
        error: function(response){
            Swal.fire({
                title: 'Oops..',
                text: `${response.message}`,
                icon: 'error',
                confirmButtonText: 'Oke'
              }).then((result) => {
                if (result.isConfirmed) {
                    $("#large-Modal").modal('show');
                }
            })
        }
    })
})

$(".delete").on("click", function(){
    let id = $(this).data('id');

    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda yakin menghapus data ini",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "delete"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/pasien/delete-data',
                method: 'POST',
                data: {
                    "_token": $("meta[name='csrf-token']").attr('content'),
                    "id": id,
                },
                success: function(response){
                    if(response.status){
                        Swal.fire({
                            title: 'Success',
                            text: "Berhasil Menghapus Data!",
                            icon: 'success',
                            confirmButtonText: 'Oke'
                          }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    }else{
                        Swal.fire({
                            title: 'Oops..',
                            text: `${response.message}`,
                            icon: 'error',
                            confirmButtonText: 'Oke'
                          }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: "Error..",
                                    text: `${response.message}`,
                                    icon: "success"
                                });
                            }
                        })
                    }
                },
                error: function(response){
                    Swal.fire({
                        title: 'Oops..',
                        text: `${response.message}`,
                        icon: 'error',
                        confirmButtonText: 'Oke'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Error..",
                                text: `${response.message}`,
                                icon: "success"
                            });
                        }
                    })
                }
            })
        }
      });
})
