function loadData(){
    var today = new Date();
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    var date = today.toLocaleDateString('id-ID', options);
    $("#tanggal").text(date)

    return new Promise(function(resolve, reject){
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
                                                <h6 class="text-dark m-b-0 text-white count-down" data-tahapan="${element.tahap}">${element.waktu_masuk}</h6>
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

                    resolve();
                }else{
                    reject(response.status);
                }
            },
            error: function(response) {
                reject(response.status);
            }
        });
    })
}

function countDown(waktuAwal, waktuAkhir) {
    var waktuAwalObj = new Date("1970-01-01T" + waktuAwal + ":00");
    var waktuAkhirObj = new Date("1970-01-01T" + waktuAkhir + ":00");

    // Menghitung selisih waktu dalam milidetik
    var selisihMilidetik = waktuAkhirObj.getTime() - waktuAwalObj.getTime();

    // Mengonversi selisih waktu menjadi detik
    var selisihDetik = selisihMilidetik / 1000;

    // Menghitung jam, menit, dan detik
    var jam = Math.floor(selisihDetik / 3600);
    var sisaDetik = selisihDetik % 3600;
    var menit = Math.floor(sisaDetik / 60);
    var detik = Math.floor(sisaDetik % 60);

    return {
        jam: jam,
        menit: menit,
        detik: detik
    };
}

function hitungDurasi(waktuAwal, durasi){
    var waktuAwalSplit = waktuAwal.split(":");
    var durasiSplit = durasi.split(":");

    var jamAwal = parseInt(waktuAwalSplit[0]);
    var menitAwal = parseInt(waktuAwalSplit[1]);

    var jamDurasi = parseInt(durasiSplit[0]);
    var menitDurasi = parseInt(durasiSplit[1]);

    var jamHasil = jamAwal + jamDurasi;
    var menitHasil = menitAwal + menitDurasi;

    if (menitHasil >= 60) {
        jamHasil++;
        menitHasil -= 60;
    }
    jamHasil = jamHasil % 24;
    var hasilStr = (jamHasil < 10 ? '0' : '') + jamHasil + ':' + (menitHasil < 10 ? '0' : '') + menitHasil;

    return hasilStr;
}

$(document).ready(function(){
    loadData()
        .then(function(){
            let classLength = $(".count-down").length;

            setInterval(function(){
                for(let i = 0; i < classLength; i++){
                    let ctr = $(".count-down").eq(i);
                    let cd = countDown(ctr.html(), hitungDurasi(ctr.html(), ctr.data('tahapan')))
                    ctr.html(cd.jam + ":" + cd.menit + ":" + cd.detik);
                }
            }, 1000)
        })
        .catch(function(error){
            console.log(error);
        })
})
