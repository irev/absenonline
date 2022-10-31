<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="row">

                            <div class="col-md-12 col-xl-12">
                                <div class="card daily-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Total Kehadiran Hari Ini</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-2">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                                        class="feather icon-user text-c-gray f-30 m-r-10"></i><?php echo $alluser; ?>
                                                </h3>
                                                Pegawai
                                            </div>
                                            <div class="col-2">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                                        class="feather icon-user text-c-green f-30 m-r-10"></i><?php echo $total_riwayat_absen; ?>
                                                </h3>
                                                Hadir
                                            </div>
                                            <div class="col-2">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                                        class="feather icon-user text-c-blue f-30 m-r-10"></i><?php echo $total_riwayat_absen_pulang; ?>
                                                </h3>
                                                Pulang
                                            </div>
                                            <div class="col-2">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                                        class="feather icon-user text-c-orange f-30 m-r-10"></i><?php echo $total_riwayat_absen_dl; ?>
                                                </h3>
                                                Dinas Luar
                                            </div>
                                            <div class="col-2">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                                        class="feather icon-user text-c-yellow f-30 m-r-10"></i><?php echo $total_riwayat_absen_izin; ?>
                                                </h3>
                                                Izin
                                            </div>
                                            <div class="col-2">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i
                                                        class="feather icon-user text-c-red f-30 m-r-10"></i><?php echo $total_riwayat_absen_sakit; ?>
                                                </h3>
                                                Sakit
                                            </div>


                                            <!--<div class="col-3 text-right">-->
                                            <!--    <p class="m-b-0"></p>-->
                                            <!--</div>-->

                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar"
                                                style="width: <?= ($persen_hadir); ?>%;"
                                                aria-valuenow="<?php echo $total_riwayat_absen; ?>" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                        <?= ($persen_hadir); ?> %
                                    </div>
                                </div>
                            </div>

                            <div>
                                <p>sds</p>
                            </div>

                            <div class="col-xl-12 col-md-12 m-b-30">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Riwayat Kehadiran Hari
                                            Ini</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover data-dashboard">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Pulang</th>
                                                        <th>Waktu Kehadiran</th>
                                                        <th>On Wifi</th>
                                                        <th>Status</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1; foreach ($riwayat_absen as $data) : ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10"
                                                                    style="width:40px;"
                                                                    src="<?= base_url('assets/images/user/avatar-2.jpg') ?>"
                                                                    alt="activity-user"><?php echo $data['nama_lengkap']; ?>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo $data['tgl_absen']; ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">
                                                                <?php echo date('G:i:s', strtotime($data['timestamp_masuk'])); ?>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">
                                                                <?php if($data['timestamp_pulang']){
                                                            echo date('G:i:s', strtotime($data['timestamp_pulang'])); 
                                                            }else{ 
                                                                echo "-"; 
                                                            
                                                            } ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">
                                                                <?php echo substr(str_replace('-','',$data['jam_kerja']),0,5); ?>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">
                                                                <?php 
                                                                if($data['file']!=''){
                                                                    if($data['status']==2){
                                                                        echo "<a href='".base_url()."foto/$data[file]' target='_blank'>File DL</a>";
                                                                    }else if($data['status']==3){
                                                                         echo "<a href='".base_url()."foto/$data[file]' target='_blank'>File Ijin</a>";
                                                                    }else if($data['status']==4){
                                                                         echo "<a href='".base_url()."foto/$data[file]' target='_blank'>File Sakit</a>";
                                                                    }
                                                                    //echo ' '. $data['file'];
                                                                }else{
                                                                    echo  $data['SSID'];
                                                                }
                                                                  
                                                                ?>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <?php if ($data['status'] == 1) { ?>
                                                            <h6 class="m-0 text-c-green">Hadir</h6>
                                                            <?php } else if ($data['status'] == 2) { ?>
                                                            <h6 class="m-0 text-c-blue">Dinas Luar</h6>
                                                            <?php } else if ($data['status'] == 3) { ?>
                                                            <h6 class="m-0 text-c-yellow">Menunggu Persetujuan Ijin</h6>
                                                            <?php } else if ($data['status'] == 4) { ?>
                                                            <h6 class="m-0 text-c-blue">Ijin</h6>
                                                            <?php } else if ($data['status'] == 5) { ?>
                                                            <h6 class="m-0 text-c-yellow">Ijin Ditolak</h6>
                                                            <?php } else { ?>
                                                            <h6 class="m-0 text-c-red">Absen</h6>
                                                            <?php } ?>

                                                        </td>
                                                        <td class="text-right">
                                                            <?php if ($data['status'] == 1) { ?>
                                                            <i class="fas fa-circle text-c-green f-10"></i>
                                                            <?php } else if ($data['status'] == 2) { ?>
                                                            <i class="fas fa-circle text-c-blue f-10"></i>
                                                            <?php } else if ($data['status'] == 3) { ?>
                                                            <i class="fas fa-circle text-c-yellow f-10"></i>
                                                            <?php } else if ($data['status'] == 4) { ?>
                                                            <i class="fas fa-circle text-c-yellow f-10"></i>
                                                            <?php } else if ($data['status'] == 5) { ?>
                                                            <i class="fas fa-circle text-c-yellow f-10"></i>
                                                            <?php } else { ?>
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