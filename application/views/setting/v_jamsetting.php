<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10"><?= $pengaturan->nama_opd ?> </h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="javascript:">Pengaturan Absen</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5> <?= $title ?> Pengaturan Absen</h5>
                                        <?php
                                        dd($this->session->all_userdata());
                                        ?>
                                    </div>
                                    <div class="card-block">
                                        <div class="col-sm-12">
                                            <form action="<?= site_url() ?>pengaturan_jam/act_add_jadwal/<?= $this->session->userdata('username')  ?>" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Id Instansi</label>
                                                            <input type="text" class="form-control" name="id" id="exampleInputEmail1" aria-describedby="Id" value="<?php echo $id_instansi; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Nama Jam Kerja</label>
                                                            <input type="text" class="form-control" name="jam_kerja" value="<?php echo $nama_jamkerja ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Status</label>
                                                            <select name="status" class="form-control" id="status">
                                                                <option value="1"><?= $status_jamkerja ?></option>
                                                                <option value="1">Aktif</option>
                                                                <option value="0">Non Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <button type="submit" class="btn btn-primary"> SIMPAN </button>
                                                    <button type="submit" class="btn btn-danger"> Batal </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>