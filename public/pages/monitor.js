$(document).ready(function(){
    var today = new Date();
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    var date = today.toLocaleDateString('id-ID', options);

    $("#tanggal").text(date)
    $.ajax({
        url: '/monitor/load-data',
        method: 'GET',
        success: function(response) {
            if(response.status){

                let container = $(".row");
                response.data.forEach(element => {
                    let newData = `
                        <div class="col-xl-3 col-md-6">
                            <div class="card" style="background-color: #1d3557">
                                <div class="card-block ml-3 mr-3">
                                    <div class="row align-items-center">
                                        <div class="col-5 bg-white mb-2 p-2 text-center" style="background-color: #f1faee !important">
                                            <h6 class="text-dark m-b-0">Keputusan</h6>
                                        </div>
                                        <div class="col-2">
                                        </div>
                                        <div class="col-5 bg-white mb-2 p-2 text-center" style="background-color: #f1faee !important">
                                            <h6 class="text-dark m-b-0">Total Layanan</h6>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-5 bg-white mb-2 p-2 d-flex justify-content-center align-items-center" style="height: 60px">
                                            <h6 class="text-dark m-b-0 text-white">${element.waktu_masuk}</h6>
                                        </div>
                                        <div class="col-2">
                                        </div>
                                        <div class="col-5 bg-white mb-2 p-2 d-flex justify-content-center align-items-center" style="height: 60px">
                                            <h6 class="text-dark m-b-0 text-white">${element.waktu_masuk}</h6>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-center text-white"><b>${element.nama} / ${element.kode}</b></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 d-flex align-items-center">
                                            <img src="https://cdn3d.iconscout.com/3d/premium/thumb/trendy-person-avatar-6299537-5187869.png" height="80px">
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center">
                                            <p class="text-center text-white"><b>${element.created_at}</b></p>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <p class="text-center text-white"><b>${element.jenis_layanan}</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                    container.append(newData);
                });
            }else{

            }
        },
        error: function(response) {

        }
    });
})
