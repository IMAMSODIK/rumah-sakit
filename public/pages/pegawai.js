$("#store").on("click", function(){
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
            console.log(response);
        },
        error: function(response){
            console.log(response);
        }
    })
})
