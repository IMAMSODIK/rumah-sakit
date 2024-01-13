let data_table;

function clearFields(){
    $("#jenis_layanan").val("");
    $("#keterangan_layanan").val("");
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
    $("#large-Modal").modal('hide');
    let jenis_layanan = $("#jenis_layanan").val(),
        keterangan_layanan = $("#keterangan_layanan").val();

    $.ajax({
        url: '/jenis-layanan/store-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "jenis_layanan": jenis_layanan,
            "keterangan_layanan": keterangan_layanan
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
        url: '/jenis-layanan/edit-data',
        method: 'GET',
        data: {
            "id": id
        },
        success: function(response){
            if(response.status){
                $("#id_layanan").val(response.data.id);
                $("#edit_jenis_layanan").val(response.data.jenis_layanan);
                $("#edit_keterangan_layanan").val(response.data.keterangan);
            }else{
                Swal.fire({
                    title: 'Oops..',
                    text: `${response.message}`,
                    icon: 'error',
                    confirmButtonText: 'Oke'
                  }).then((result) => {
                    if (result.isConfirmed) {

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
        url: '/jenis-layanan/update-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "id": $("#id_layanan").val(),
            "jenis_layanan": $("#edit_jenis_layanan").val(),
            "keterangan_layanan": $("#edit_keterangan_layanan").val()
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
                url: '/jenis-layanan/delete-data',
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
