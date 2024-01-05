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
                table.ajax.reload();
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Berhasil Menambahkan Data!"
                });
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
