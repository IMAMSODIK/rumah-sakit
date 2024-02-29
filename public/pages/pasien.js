let data_table;

function clearFields(){
    $("#nama").val("");
    $("#nip").val("");
}

$(document).ready(function() {
    data_table = $('#order-table').DataTable({
        "order": [
            [0, "asc"]
        ],
    });

    $.extend(true, $.fn.dataTable.defaults, {
        "searching": false,
        "ordering": false
    });
});

$(".close-btn").on("click", function(){
    clearFields();
})

// $(".waves-effect").on("click", function(){
//     let currentTime = new Date();
//     let currentHours = currentTime.getHours();
//     let currentMinutes = currentTime.getMinutes();
//     let formattedHours = currentHours < 10 ? '0' + currentHours : currentHours;
//     let formattedMinutes = currentMinutes < 10 ? '0' + currentMinutes : currentMinutes;
//     let currentTimeString = formattedHours + ':' + formattedMinutes;

//     document.getElementById('waktu_masuk').value = currentTimeString;
// })

$("#store").on("click", function(){
    let nama_pasien = $("#nama_pasien").val(),
        usia = $("#usia_pasien").val(),
        rekam_medis = $("#rekam_medis").val();

    $("#large-Modal").modal('hide');

    $.ajax({
        url: '/pasien/store-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "nama": nama_pasien,
            "usia": usia,
            "no_rekam_medis": rekam_medis,
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

$(".edit").on('click', function(event){
    event.stopPropagation();
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
                $("#edit_usia_pasien").val(response.data.usia);
                $("#edit_rekam_medis").val(response.data.no_rekam_medis);
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

$(".data-row").on('click', function(){
    let id = $(this).data('id');

    $.ajax({
        url: '/pasien/edit-layanan',
        method: 'GET',
        data: {
            "id": id
        },
        success: function(response){
            if(response.status){
                $("#id_pasien_layanan").val(response.data.id);
                $("#layanan_nama_pasien").val(response.data.nama);
                $("#layanan_usia_pasien").val(response.data.usia);
                $("#layanan_rekam_medis").val(response.data.no_rekam_medis);

                if(response.data.layanan){
                    $('#status_triase').prop('checked', response.data.layanan.triase)
                    $('#status_spri').prop('checked', response.data.layanan.spri)
                    $('#status_admisi').prop('checked', response.data.layanan.admisi)
                    $('#status_penunjang').prop('checked', response.data.layanan.pemeriksaan_penunjang)
                    $('#status_dpjp').prop('checked', response.data.layanan.dpjp)
                    $('#status_transfer').prop('checked', response.data.layanan.transfer_pasien)
                    $('#status_masuk_ruangan').prop('checked', response.data.layanan.time_masuk_ruang)
                }

                $("#edit-layanan").modal('show');
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

$("#update").on('click', function(){
    $("#edit-Modal").modal('hide');
    $.ajax({
        url: '/pasien/update-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "id": $("#id_pasien").val(),
            "nama": $("#edit_nama_pasien").val(),
            "usia": $("#edit_usia_pasien").val(),
            "no_rekam_medis": $("#edit_rekam_medis").val(),
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

$(".delete").on("click", function(event){
    event.stopPropagation();
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


$("#update_layanan").on("click", function(){
    $("#edit-layanan").modal('hide');
    $.ajax({
        url: '/pasien/update-status-layanan',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            'id': $("#id_pasien_layanan").val(),
            'status_triase': ($('#status_triase').prop('checked') ? 1 : 0),
            'status_spri': ($('#status_spri').prop('checked') ? 1 : 0),
            'status_admisi': ($('#status_admisi').prop('checked') ? 1 : 0),
            'status_penunjang': ($('#status_penunjang').prop('checked') ? 1 : 0),
            'status_dpjp': ($('#status_dpjp').prop('checked') ? 1 : 0),
            'status_transfer': ($('#status_transfer').prop('checked') ? 1 : 0),
            'status_masuk_ruangan': ($('#status_masuk_ruangan').prop('checked') ? 1 : 0),
            'status_ketersediaan_ruang': ($("#status_ketersediaan_ruang").val() ? 1 : 0)
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
                        $("#edit-layanan").modal('show');
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
                    $("#edit-layanan").modal('show');
                }
            })
        }
    })
})
