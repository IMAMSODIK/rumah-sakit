@extends('dashboard.template')

@section('own_style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/icon/icofont/css/icofont.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/component.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/pages/advance-elements/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datedropper/datedropper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/spectrum/spectrum.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/jquery-minicolors/jquery.minicolors.css') }}">

    <style>
        .table tr:hover td{
            background:#404E67;
            color: white;
        }
    </style>
@endsection

@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal">Tambah Data</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item" style="float: left;">
                                        <a href="/"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Daftar Pasien</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                  <h5>Daftar Pasien</h5>
                                </div>
                                <div class="card-block">
                                  <div class="dt-responsive table-responsive">
                                    <table id="order-table" class="table table-striped table-bordered nowrap">
                                      <thead>
                                        <tr>
                                            <th class="text-center">No. </th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Pasien</th>
                                            <th class="text-center">Triase</th>
                                            <th class="text-center">SPRI</th>
                                            <th class="text-center">Admisi Rawat Inap</th>
                                            <th class="text-center">Ketersediaan Ruang</th>
                                            <th class="text-center">Pemeriksaan Penunjang</th>
                                            <th class="text-center">Konsultasi DPJP</th>
                                            <th class="text-center">Transfer Pasien</th>
                                            <th class="text-center">Masuk Ruangan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $index = 1; ?>
                                        @foreach ($pasiens as $pasien)
                                            <tr class="data-row" data-id="{{ $pasien->id }}" style="cursor: pointer">
                                                <td>{{ $index++ }}</td>
                                                <td class="text-center align-middle">
                                                    <i class="m-1 ti-pencil text-success edit" style="font-size: 18px" data-id={{ $pasien->id }}></i>
                                                    <i class="m-1 ti-trash text-danger delete" style="font-size: 18px" data-id={{ $pasien->id }}></i>
                                                </td>
                                                <td>
                                                    Nama            : {{ $pasien->nama }} <br>
                                                    Usia            : {{ $pasien->usia }} <br>
                                                    No. Rekam Medis : {{ $pasien->no_rekam_medis }}
                                                </td>
                                                @if ($pasien->layanan)
                                                    <td class="text-center align-middle">
                                                        @if ($pasien->layanan->triase)
                                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> <br>
                                                            ({{ $pasien->layanan->time_triase }})
                                                        @else
                                                            <i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if ($pasien->layanan->spri)
                                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> <br>
                                                            ({{ $pasien->layanan->time_spri }})
                                                        @else
                                                            <i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if ($pasien->layanan->admisi)
                                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> <br>
                                                            ({{ $pasien->layanan->time_admisi }})
                                                        @else
                                                            <i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if ($pasien->layanan->pemeriksaan_penunjang)
                                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> <br>
                                                            ({{ $pasien->layanan->time_pemeriksaan_penunjang }})
                                                        @else
                                                            <i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if ($pasien->layanan->dpjp)
                                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> <br>
                                                            ({{ $pasien->layanan->time_dpjp }})
                                                        @else
                                                            <i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if ($pasien->layanan->transfer_pasien)
                                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> <br>
                                                            ({{ $pasien->layanan->time_transfer_pasien }})
                                                        @else
                                                            <i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if ($pasien->layanan->ketersediaan_ruang)
                                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> <br>
                                                            ({{ $pasien->layanan->time_ketersediaan_ruang }})
                                                        @else
                                                            <i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if ($pasien->layanan->masuk_ruang)
                                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> <br>
                                                            ({{ $pasien->layanan->time_masuk_ruang }})
                                                        @else
                                                            <i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td class="text-center align-middle"><i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i></td>
                                                    <td class="text-center align-middle"><i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i></td>
                                                    <td class="text-center align-middle"><i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i></td>
                                                    <td class="text-center align-middle"><i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i></td>
                                                    <td class="text-center align-middle"><i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i></td>
                                                    <td class="text-center align-middle"><i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i></td>
                                                    <td class="text-center align-middle"><i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i></td>
                                                    <td class="text-center align-middle"><i class="fa fa-hourglass-half text-warning" aria-hidden="true"></i></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                      </tbody>
                                      {{-- <tfoot>
                                        <tr>
                                            <th class="text-center">No. </th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Pasien</th>
                                            <th class="text-center">Triase</th>
                                            <th class="text-center">SPRI</th>
                                            <th class="text-center">Admisi Rawat Inap</th>
                                            <th class="text-center">Ketersediaan Ruang</th>
                                            <th class="text-center">Pemeriksaan Penunjang</th>
                                            <th class="text-center">Konsultasi DPJP</th>
                                            <th class="text-center">Transfer Pasien</th>
                                            <th class="text-center">Masuk Ruangan</th>
                                        </tr>
                                      </tfoot> --}}
                                    </table>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- modal tambah data --}}
<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Pasien</h4>
          <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="card">
                <div class="card-block">
                  <form id="main" novalidate>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Nama Pasien</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama" id="nama_pasien" placeholder="Masukkan Nama Pasien">
                        <span class="messages"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Usia Pasien</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" id="usia_pasien" placeholder="Masukkan Usia Pasien">
                            <span class="messages"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Nomor Rekam Medis Pasien</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" name="nama" id="rekam_medis" placeholder="Masukkan No. Rekam Medis Pasien">
                          <span class="messages"></span>
                      </div>
                  </div>
                    {{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-8">
                            <input id="dropper-animation" class="form-control" type="text" placeholder="Tanggal Masuk" />
                            <span class="messages"></span>
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Waktu Masuk</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="time" id="waktu_masuk"/>
                            <span class="messages"></span>
                        </div>
                    </div> --}}
                  </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect close-btn" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" id="store">Save changes</button>
        </div>
      </div>
    </div>
</div>

{{-- modal edit data --}}
<div class="modal fade" id="edit-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Pasien</h4>
          <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-block">
                  <form id="main" novalidate>
                    <input type="hidden" id="id_pasien">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Pasien</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="nama" id="edit_nama_pasien" placeholder="Masukkan Nama Pasien">
                          <span class="messages"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Usia Pasien</label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" name="nama" id="edit_usia_pasien" placeholder="Masukkan Usia Pasien">
                              <span class="messages"></span>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nomor Rekam Medis Pasien</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" id="edit_rekam_medis" placeholder="Masukkan No. Rekam Medis Pasien">
                            <span class="messages"></span>
                        </div>
                    </div>
                      {{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="date" id="edit_tanggal_masuk"/>
                            <span class="messages"></span>
                        </div>
                    </div> --}}
                      {{-- <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Waktu Masuk</label>
                          <div class="col-sm-8">
                              <input class="form-control" type="time" id="edit_waktu_masuk"/>
                              <span class="messages"></span>
                          </div>
                      </div> --}}

                      {{-- <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Keterangan Layanan</label>
                          <div class="col-sm-8">
                              <select name="" id="edit_jenis_layanan" class="form-control">
                                  <option value="0">:: Pilih Jenis Layanan ::</option>
                                  @foreach ($layanans as $layanan)
                                      <option value="{{ $layanan->id }}">{{ $layanan->jenis_layanan }}</option>
                                  @endforeach
                              </select>
                              <span class="messages"></span>
                          </div>
                      </div> --}}
                  </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect close-btn" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" id="update">Save changes</button>
        </div>
      </div>
    </div>
</div>

{{-- modal edit layanan --}}
<div class="modal fade" id="edit-layanan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Layanan Pasien</h4>
          <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-block">
                  <form id="main" novalidate>
                    <input type="hidden" id="id_pasien_layanan">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Pasien</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="nama" id="layanan_nama_pasien" readonly>
                          <span class="messages"></span>
                        </div>
                    </div>
                      <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Usia Pasien</label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" name="nama" id="layanan_usia_pasien" readonly>
                              <span class="messages"></span>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nomor Rekam Medis Pasien</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" id="layanan_rekam_medis" readonly>
                            <span class="messages"></span>
                        </div>
                    </div>
                  </form>
                </div>
            </div>

            <hr>

            <div class="card">
                <div class="card-block">
                  <form id="main" novalidate>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status Triase</label>
                        <div class="col-sm-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="status_triase">
                                <label class="form-check-label" for="status_triase">
                                  Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status SPRI</label>
                        <div class="col-sm-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="status_spri">
                                <label class="form-check-label" for="status_spri">
                                  Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status Admisi Rawat Inap</label>
                        <div class="col-sm-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="status_admisi">
                                <label class="form-check-label" for="status_admisi">
                                  Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status Pemeriksaan Penunjang</label>
                        <div class="col-sm-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="status_penunjang">
                                <label class="form-check-label" for="status_penunjang">
                                  Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status Konsultasi DPJP</label>
                        <div class="col-sm-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="status_dpjp">
                                <label class="form-check-label" for="status_dpjp">
                                  Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status Transfer Pasien</label>
                        <div class="col-sm-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="status_transfer">
                                <label class="form-check-label" for="status_transfer">
                                  Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status Masuk Ruangan</label>
                        <div class="col-sm-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="status_masuk_ruangan">
                                <label class="form-check-label" for="status_masuk_ruangan">
                                  Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status Ketersediaan Ruang</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="nama" id="status_ketersediaan_ruang">
                                <option value="0">Tidak Tersedia</option>
                                <option value="1">Tersedia</option>
                            </select>
                            <span class="messages"></span>
                        </div>
                    </div>
                  </form>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect close-btn" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" id="update_layanan">Save changes</button>
        </div>
      </div>
    </div>
</div>
@endsection

@section('own_js')
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/assets/pages/data-table/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/assets/pages/data-table/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/bower_components/i18next/i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/jquery-i18next/jquery-i18next.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/assets/js/sweetalert.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/js/modal.js') }}"></script>


    <script type="text/javascript" src="{{ asset('assets/assets/js/modalEffects.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/js/classie.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/assets/pages/form-validation/validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/pages/form-validation/form-validation.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/pages/advance-elements/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/datedropper/datedropper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/spectrum/spectrum.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/jscolor/jscolor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/pages/advance-elements/custom-picker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/pages/advance-elements/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('pages/pasien.js') }}"></script>
@endsection
