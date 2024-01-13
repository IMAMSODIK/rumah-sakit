let data_table;

function clearFields(){
    $("#jam_pertama").val("");
    $("#jam_kedua").val("");
    $("#jam_ketiga").val("");
    $("#jam_keempat").val("");
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

$(".edit").on('click', function(){
    $.ajax({
        url: '/tahapan/edit-data',
        method: 'GET',
        success: function(response){
            if(response.status){
                $("#jam_pertama").val(response.data.jam_pertama);
                $("#jam_kedua").val(response.data.jam_kedua);
                $("#jam_ketiga").val(response.data.jam_ketiga);
                $("#jam_keempat").val(response.data.jam_keempat);
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
        url: '/tahapan/update-data',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "jam_pertama": $("#jam_pertama").val(),
            "jam_kedua": $("#jam_kedua").val(),
            "jam_ketiga": $("#jam_ketiga").val(),
            "jam_keempat": $("#jam_keempat").val(),
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
