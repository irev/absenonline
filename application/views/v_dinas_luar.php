<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 m-b-30">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Daftar Kehadiran</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade active show" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="table-responsive">
                                        <table class="table table-hover" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Tanggal</th>
                                                    <th>Durasi</th>
                                                    <th>Lampiran</th>
                                                    <th>Status</th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dinas_luar as $data) : ?>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10"
                                                                style="width:40px;"
                                                                src="<?php echo base_url()?>assets/images/user/avatar-2.jpg"
                                                                alt="activity-user"><?php echo $data['nama_lengkap']; ?>
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">
                                                            <?php echo date("d/m/Y", strtotime($data['tgl_absen']));  ?>
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">
                                                            <?php echo $data['status'];  ?> Hari
                                                        </h6>
                                                    </td>
                                                    <td><a class="btn btn-info"
                                                            onclick="return window.location='<?php echo base_url('foto/'.$data['file']) ?>'" target="_blank">
                                                            BUKA </a> 
                                                    </td>
                                                    <td>
                                                        <?php if($data['status'] == 1){ ?>
                                                        <h6 class="m-0 text-c-green">Hadir</h6>
                                                        <?php }else if($data['status'] == 2){ ?>
                                                        <h6 class="m-0 text-c-blue">Dinas Luar</h6>
                                                        <?php }else if($data['status'] == 3){ ?>
                                                        <h6 class="m-0 text-c-yellow">Ijin</h6>
                                                        <?php }else{ ?>
                                                        <h6 class="m-0 text-c-red">Absen</h6>
                                                        <?php } ?>

                                                    </td>
                                                    <td class="text-right">
                                                        <?php if($data['status'] == 1){ ?>
                                                        <i class="fas fa-circle text-c-green f-10"></i>
                                                        <?php }else if($data['status'] == 2){ ?>
                                                        <i class="fas fa-circle text-c-blue f-10"></i>
                                                        <?php }else if($data['status'] == 3){ ?>
                                                        <i class="fas fa-circle text-c-yellow f-10"></i>
                                                        <?php }else{ ?>
                                                        <i class="fas fa-circle text-c-red f-10"></i>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <?php endforeach; ?>

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