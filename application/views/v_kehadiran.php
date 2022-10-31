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
                                <form action="" method="post">
                                    <div class="input-group">
                                    <label>Tanggal : </label>
                                            <input type="date" name="tgl" class="form-control pull-right" placeholder="dd-mm-yyyy" max="2050-12-30" value="<?= $this->input->post('tgl') ?>">
                                            <button type="submit" class="btn btn-primary">Tampil</button>
                                    </div>
                                </form> 
                                <hr>
                                <?php 
                                //echo $this->db->last_query();
                                ?>   
                                    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                                    <?php if($data['x_approv']==3){
                                                        echo '<tr style="background: #ffc1c1;">';
                                                    }else if($data['x_approv']==1){
                                                        echo '<tr style="background: #fffccc;">';
                                                    }else if($data['x_approv']==2){
                                                        if($data['x_status']==2){
                                                            echo '<tr style="background: #ccd9ff70;">';
                                                        }else if($data['x_status']==3){
                                                            echo '<tr style="background: #c1cbff;">';
                                                        }else if($data['x_status']==4){
                                                            echo '<tr style="background: ##ffeaea;">';
                                                        }else if($data['x_status']==5){
                                                                echo '<tr style="background: #c1cbff;">';
                                                        }else{
                                                            echo '<tr style="background: #c9ffc170;">';
                                                        }
                                                    }else{
                                                        echo '<tr>';
                                                    } ?>
                                                    
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
                                                                <?php 
                                                                if($data['x_status']==2){
                                                                    echo date('G:i:s', strtotime($data['x_masuk']));
                                                                }else{ 
                                                                    echo date('G:i:s', strtotime($data['timestamp_masuk'])); 
                                                                }
                                                                ?>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">
                                                                <?php 
                                                                if($data['x_status']==2){
                                                                    echo date('G:i:s', strtotime($data['x_pulang']));
                                                                }else{    
                                                                    if($data['timestamp_pulang']){
                                                                        echo date('G:i:s', strtotime($data['timestamp_pulang'])); 
                                                                    }else{  
                                                                        echo "-"; 
                                                                    }
                                                                } 
                                                                ?>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">
                                                                <?php 
                                                                //var_dump($this->db->query("CALL Get_CekJadwal('2022-09-20','OUT')"));
                                                                if($data['timestamp_pulang'] != null){
                                                                    if($data['x_status']==2){
                                                                        $dateTimeObject1 = date_create($data['x_masuk']);
                                                                    }else{
                                                                        $dateTimeObject1 = date_create($data['timestamp_masuk']);
                                                                    }
                                                                    
                                                                    if($data['x_status']==2){
                                                                        $dateTimeObject2 = date_create($data['x_pulang']); //date_create('16:00');
                                                                    }else{
                                                                        $dateTimeObject2 = date_create($data['timestamp_pulang']);
                                                                    }
                                                                      
                                                                    $difference = date_diff($dateTimeObject1, $dateTimeObject2); 
                                                                     
                                                                    echo $difference->h;
                                                                    echo " jam \n";
                                                                    //$minutes = $difference->days * 24 * 60;
                                                                    //$minutes += $difference->h * 60;
                                                                    //$minutes += $difference->i;
                                                                    //echo("The difference in minutes is:");
                                                                    echo $difference->i .' menit';
                                                                }elseif($data['status'] !=1 ){
                                                                    echo  $data['x_durasi']. ' Hari ' ;  
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
                                                        <td class="text-left">
                                                            <?php 
                                                             if($data['x_approv']==1){
                                                             echo  '<h6 class="m-0 text-c-yellow">Pengajuan</h6>';
                                                             }else if($data['x_approv']==3) {
                                                             echo  '<h6 class="m-0 text-c-red">Ditolak</h6>';
                                                            }
                                                            ?>
                                                            <?php if($data['x_status'] == 1){ ?>
                                                            <h6 class="m-0 text-c-green"><i class="fas fa-circle text-c-green f-10"></i> Hadir</h6>
                                                            <?php }else if($data['x_status'] == 2){ ?>
                                                            <h6 class="m-0 text-c-blue"><i class="fas fa-circle text-c-blue f-10"></i> Dinas Luar</h6>
                                                            <?php }else if($data['x_status'] == 3){ ?>                                                            
                                                            <h6 class="m-0 text-c-yellow"><i class="fas fa-circle text-c-yellow f-10"></i> Ijin</h6>
                                                            <?php }else if($data['x_status'] == 4){ ?>                                                            
                                                            <h6 class="m-0 text-c-red"><i class="fas fa-circle text-c-red f-10"></i> Sakit</h6>
                                                            <?php }else{ ?>                                                            
                                                            <h6 class="m-0 text-c-black"><i class="fas fa-circle text-c-black f-10"></i> Absen</h6>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php  
                                                            echo $data['x_ket'];
                                                            ?>
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