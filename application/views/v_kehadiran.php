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
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Pulang</th>
                                                        <th>Waktu Kehadiran (Menit)</th>
                                                        <th>Status</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($kehadiran as $data) : ?>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10"
                                                                    style="width:40px;"
                                                                    src="<?php echo base_url() ?>assets/images/user/avatar-2.jpg"
                                                                    alt="activity-user"><?php echo $data['nama_lengkap']; ?>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"
                                                                data-sort="<?php echo date_format(date_create($data['tgl_absen']), 'd/m/Y'); ?>">
                                                                <?php echo date_format(date_create($data['tgl_absen']), 'd/m/Y'); ?>
                                                            </h6>
                                                            <h6 class="m-0"
                                                                data-sort="<?php echo $data['tgl_absen']; ?>">
                                                                <?php echo $data['tgl_absen'];  ?></h6>
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

                                                                <?php 
                                                                if($data['timestamp_pulang'] != null){
                                                                    $dateTimeObject1 = date_create($data['timestamp_masuk']); 
                                                                    $dateTimeObject2 = date_create($data['timestamp_pulang']);  
                                                                    $difference = date_diff($dateTimeObject1, $dateTimeObject2); 
                                                                     
                                                                    echo $difference->h;
                                                                    echo " jam \n";
                                                                    //$minutes = $difference->days * 24 * 60;
                                                                    //$minutes += $difference->h * 60;
                                                                    //$minutes += $difference->i;
                                                                    //echo("The difference in minutes is:");
                                                                    echo $difference->i .' menit';
                                                                }else{
                                                                    $dateTimeObject1 = date_create($data['timestamp_masuk']); 
                                                                    $dateTimeObject2 = date_create($data['timestamp_masuk']);  
                                                                    $difference = date_diff($dateTimeObject1, $dateTimeObject2); 
                                                                     
                                                                    echo $difference->h;
                                                                    echo " jam \n";
                                                                    //$minutes = $difference->days * 24 * 60;
                                                                    //$minutes += $difference->h * 60;
                                                                    //$minutes += $difference->i;
                                                                    //echo("The difference in minutes is:");
                                                                    echo $difference->i .' menit';
                                                                }
                                                                ?>
                                                                <?php
                                                            // if($data['timestamp_pulang'] != ""){
                                                                
                                                            //         $waktu_awal        =strtotime($data['timestamp_masuk']);
                                                            //         $waktu_akhir        = strtotime($data['timestamp_pulang']); 
                                                            //         $diff    = $waktu_awal - $waktu_akhir; 
                                                            //         $jam    =floor($diff / (60 * 60)); 
                                                            //         $menit    =$diff - $jam * (60 * 60); 
                                                            //         echo  abs($jam) .  ' jam ' . floor( $menit / 60 ) . ' menit'; 
                                                            
                                                            // }else{  
                                                                 
                                                            //         echo "-";
                                                            
                                                            // }
                                                            ?>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <?php if($data['status'] == 1){ ?>
                                                            <h6 class="m-0 text-c-green">Hadir</h6>
                                                            <?php }else if($data['status'] == 2){ ?>
                                                            <h6 class="m-0 text-c-blue">Dinas Luar</h6>
                                                            <?php }else if($data['status'] == 3){ ?>
                                                            <h6 class="m-0 text-c-yellow">Ijin</h6>
                                                            <?php }else if($data['status'] == 4){ ?>
                                                            <h6 class="m-0 text-c-red">Sakit</h6>
                                                            <?php }else{ ?>
                                                            <h6 class="m-0 text-c-black">Absen</h6>
                                                            <?php } ?>

                                                        </td>
                                                        <td class="text-right">
                                                            <?php if($data['status'] == 1){ ?>
                                                            <i class="fas fa-circle text-c-green f-10"></i>
                                                            <?php }else if($data['status'] == 2){ ?>
                                                            <i class="fas fa-circle text-c-blue f-10"></i>
                                                            <?php }else if($data['status'] == 3){ ?>
                                                            <i class="fas fa-circle text-c-yellow f-10"></i>
                                                            <?php }else if($data['status'] == 4){ ?>
                                                            <i class="fas fa-circle text-c-red f-10"></i>
                                                            <?php }else{ ?>
                                                            <i class="fas fa-circle text-c-black f-10"></i>
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