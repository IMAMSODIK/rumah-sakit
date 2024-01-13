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
    $("#large-Modal").modal('hide');
    let nama_pegawai = $("#nama").val(),
        nip = $("#nip").val();

    $.ajax({
        url: '/pegawai/store-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "nama_pegawai": nama_pegawai,
            "nip": nip
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
        url: '/pegawai/edit-data',
        method: 'GET',
        data: {
            "id": id
        },
        success: function(response){
            if(response.status){
                $("#id_pegawai").val(response.data.id);
                $("#edit_nama").val(response.data.name);
                $("#edit_nip").val(response.data.nip);
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
        url: '/pegawai/update-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "id": $("#id_pegawai").val(),
            "nama_pegawai": $("#edit_nama").val(),
            "nip": $("#edit_nip").val()
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
                url: '/pegawai/delete-data',
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
