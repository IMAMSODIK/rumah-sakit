@extends('dashboard.template')

@section('own_style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/icon/icofont/css/icofont.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/component.css') }}">
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
                                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Daftar Pegawai</a></li>
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
                                  <h5>Daftar Pegawai</h5>
                                </div>
                                <div class="card-block">
                                  <div class="dt-responsive table-responsive">
                                    <table id="order-table" class="table table-striped table-bordered nowrap">
                                      <thead>
                                        <tr>
                                          <th>Name</th>
                                          <th>Position</th>
                                          <th>Office</th>
                                          <th>Age</th>
                                          <th>Start date</th>
                                          <th>Salary</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>Bradley Greer</td>
                                          <td>Software Engineer</td>
                                          <td>London</td>
                                          <td>41</td>
                                          <td>2012/10/13</td>
                                          <td>$132,000</td>
                                        </tr>
                                        <tr>
                                          <td>Dai Rios</td>
                                          <td>Personnel Lead</td>
                                          <td>Edinburgh</td>
                                          <td>35</td>
                                          <td>2012/09/26</td>
                                          <td>$217,500</td>
                                        </tr>
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th>Name</th>
                                          <th>Position</th>
                                          <th>Office</th>
                                          <th>Age</th>
                                          <th>Start date</th>
                                          <th>Salary</th>
                                        </tr>
                                      </tfoot>
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
          <h4 class="modal-title">Tambah Pegawai</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-block">
                  <form id="main" method="post" action="https://demo.dashboardpack.com/" novalidate>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Nama Pegawai</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Pegawai">
                        <span class="messages"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">NIP</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan Nomor Induk Pegawai">
                          <span class="messages"></span>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" id="store">Save changes</button>
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

    <script src="{{ asset('assets/assets/pages/data-table/js/data-table-custom.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/assets/js/sweetalert.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/js/modal.js') }}"></script>


    <script type="text/javascript" src="{{ asset('assets/assets/js/modalEffects.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/js/classie.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/assets/pages/form-validation/validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/pages/form-validation/form-validation.js') }}"></script>

    <script type="text/javascript" src="{{ asset('pages/pegawai.js') }}"></script>
@endsection
