@extends('dashboard.template')

@section('own_style')

@endsection

@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
      <div class="main-body">
        <div class="page-wrapper">
          <div class="page-header">
            <div class="row align-items-end">
              <div class="col-lg-8">
                <div class="page-header-title">
                  <div class="d-inline">
                    <h4>User Profile</h4>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                  <ul class="breadcrumb-title">
                    <li class="breadcrumb-item" style="float: left;">
                      <a href="/">
                        <i class="feather icon-home"></i>
                      </a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;">
                      <a href="#!">User Profile</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="page-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="cover-profile">
                  <div class="profile-bg-img">
                    <img class="profile-bg-img img-fluid" src="{{ asset('assets/assets/images/user-profile/bg-img1.j') }}pg" alt="bg-img">
                    <div class="card-block user-info">
                      <div class="col-md-12">
                        <div class="media-left">
                          <a href="#" class="profile-image">
                            <img src="{{ (session('user')->foto) ? asset('file_upload/user_image') . '/' . session('user')->foto : asset('my_assets/images/no_pict.jpg') }}" class="user-img img-radius" alt="User-Profile-Image">
                          </a>
                        </div>
                        <div class="media-body row">
                          <div class="col-lg-12">
                            <div class="user-title">
                              <h2>{{ session('user')->name }}</h2>
                              <span class="text-white">{{ '@'.session('user')->username }}</span>
                            </div>
                          </div>
                          <div>
                            <div class="pull-right cover-btn">
                              <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal">
                                <i class="fa fa-edit"></i> Edit Biodata </button>
                                <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal">
                                    <i class="fa fa-key"></i> Ubah Password </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="tab-header card">
                  <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal Info</a>
                      <div class="slide"></div>
                    </li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="personal" role="tabpanel">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-header-text">Biodata</h5>
                      </div>
                      <div class="card-block">
                        <div class="view-info">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="general-info">
                                <div class="row">
                                  <div class="col-lg-12 col-xl-6">
                                    <div class="table-responsive">
                                      <table class="table m-0">
                                        <tbody>
                                          <tr>
                                            <th scope="row"> Nama </th>
                                            <td>{{ session('user')->name }}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row"> Usernanme</th>
                                            <td>{{ session('user')->username }}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row"> NIP </th>
                                            <td>{{ session('user')->nip }}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row"> Tanggal Registrasi</th>
                                            <td>{{ session('user')->created_at }}</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <div class="col-lg-12 col-xl-6">
                                    <div class="table-responsive">
                                      <table class="table">
                                        <tbody>
                                          <tr>
                                            <th scope="row"> Foto Profile</th>
                                            <td>
                                                <img src="{{ (session('user')->foto) ? asset('file_upload/user_image') . '/' . session('user')->foto : asset('my_assets/images/no_pict.jpg') }}" class="user-img img-radius" alt="User-Profile-Image">
                                                <br>
                                                <input type="file" name="" id="" class="form-control">
                                            </td>
                                          </tr>
                                        </tbody>
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Pegawai</h4>
          <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
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
          <button type="button" class="btn btn-default waves-effect close-btn" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" id="store">Save changes</button>
        </div>
      </div>
    </div>
</div>
@endsection


@section('own_js')
<script src="{{ asset('assets/assets/pages/user-profile.js') }}"></script>
@endsection
