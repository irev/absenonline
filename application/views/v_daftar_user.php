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
                                        <a class="nav-link active show" id="home-tabs" data-toggle="tab"
                                            href="<?= base_url('daftar_user_controller/'.$this->uri->segment(2, 0)) ?>#aktifuser"
                                            role="tab" aria-controls="home" aria-selected="true">Daftar User </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">

                                    <div class="alert alert-danger">
                                        <p>
                                            <b>Perhaian:</b>
                                            <hr> jika <b>Device ID </b> dihapus Maka user harus melakukan <i>login</i>
                                            ulang pada prangkat atau HP yang akan digunakan!
                                            <hr>
                                            <b>Status :</b> <br>
                                            <i class="fas fa-circle text-c-green f-10 m-r-15"></i> Perangkat Aktif<br>
                                            <i class="fas fa-circle text-c-red f-10 m-r-15"></i> Tidak Aktif
                                        </p>
                                    </div>
                                    <div class="tab-pane fade active show" id="profile" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <h4 class="nama_instansi">
                                            <?php 
                                            echo $nama_instansi['nama_instansi'];
                                            ?>

                                        </h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a class="btn label theme-bg2 text-white f-12 "
                                                    href="<?= base_url('daftar_user_controller/'.$this->uri->segment(2, 0)) ?>#aktifuser"
                                                    aria-selected="true"> User Aktif <?= $alluser ?> Orang </a>
                                                <a class="btn theme-bg text-white f-12 " data-toggle="all-data-tab"
                                                    href="<?= base_url('daftar_user_controller/'.$this->uri->segment(2, 0).'?all=1') ?>#alldata"
                                                    aria-controls="alldata" aria-selected="true">Tapil Semua User </a>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover data-user">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Nama</th>
                                                                <th>Username</th>
                                                                <th>Status Pegawai</th>
                                                                <th>Perangkat</th>
                                                                <th class="text-right">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $n=1; ?>
                                                            <?php foreach ($daftar_user as $data) : ?>
                                                            <?php if(isset($_GET['all'])!=1): ?>
                                                            <?php if($data['status']==1 && $data['id_group']!=2): ?>
                                                            <tr class="unread" id="<?php echo $data['id_user']; ?>">
                                                                <td><?php echo $n++; ?></td>
                                                                <td>
                                                                    <h6 class="m-0"><img class="rounded-circle  m-r-10"
                                                                            style="width:40px;"
                                                                            src="<?php echo base_url() ?>assets/images/user/avatar-2.jpg"
                                                                            alt="activity-user"><?php echo $data['nama_lengkap']; ?>
                                                                    </h6>

                                                                </td>
                                                                <td>
                                                                    <p class="username"><?php echo $data['username']; ?>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                        if($data['status']==1){
                                                            echo  '<i class="fas fa-circle text-c-green f-10 m-r-15"></i>';
                                                           echo  '<b style="color: #24b500;">Aktif</b>';
                                                        }else{
                                                            echo  '<i class="fas fa-circle text-c-red f-10 m-r-15"></i>';
                                                            echo  '<code>Non Aktif</code>';
                                                        }
                                                        //echo $this->Absen_model->getStatusAuth($data['id_user']);
                                                        ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                        if($this->Absen_model->getStatusAuth($data['id_user'])==1){
                                                            echo  '<i class="fas fa-circle text-c-green f-10 m-r-15"></i>';
                                                           echo  '<b style="color: #24b500;">Aktif</b>';
                                                        }else{
                                                            echo  '<i class="fas fa-circle text-c-red f-10 m-r-15"></i>';
                                                            echo  '-';
                                                        }
                                                        //echo $this->Absen_model->getStatusAuth($data['id_user']);
                                                        ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                        // if($this->Absen_model->getStatusAuth($data['id_user'])==1){
                                                        //   echo  '<i class="fas fa-circle text-c-green f-10 m-r-15"></i>';
                                                        // }else{
                                                        //     echo  '<i class="fas fa-circle text-c-red f-10 m-r-15"></i>';
                                                        // }
                                                        //echo $this->Absen_model->getStatusAuth($data['id_user']);
                                                        ?>
                                                                    <a href="javascript:void(0)"
                                                                        id="id_<?= $data['id_user'];?>"
                                                                        onclick="delete_item('Action_user/hapus_device_id','<?php echo $data['id_user']; ?>','<?php echo 'Hapus Device ID '.$data['nama_lengkap'] ?>');"
                                                                        class="label theme-bg2 text-white f-12 remove">Hapus
                                                                        Device
                                                                        ID</a><a
                                                                        href="<?php echo base_url('absen_user_controller/') ?><?php echo $data['id_user']; ?>"
                                                                        class="label theme-bg text-white f-12">Lihat
                                                                        Laporan</a>
                                                                    <br>
                                                                    <code>Admin = <?php echo $data['admin']; ?></code>
                                                                </td>

                                                            </tr>
                                                            <?php endif;?>
                                                            <?php endif;?>
                                                            <?php if(isset($_GET['all'])==1): ?>
                                                            <tr class="unread" id="<?php echo $data['id_user']; ?>">
                                                                <td><?php echo $n++; ?></td>
                                                                <td>
                                                                    <h6 class="m-0"><img class="rounded-circle  m-r-10"
                                                                            style="width:40px;"
                                                                            src="<?php echo base_url() ?>assets/images/user/avatar-2.jpg"
                                                                            alt="activity-user"><?php echo $data['nama_lengkap']; ?>
                                                                    </h6>
                                                                </td>
                                                                <td>
                                                                    <p class="username"><?php echo $data['username']; ?>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                        if($data['status']==1){
                                                            echo  '<i class="fas fa-circle text-c-green f-10 m-r-15"></i>';
                                                           echo  '<b style="color: #24b500;">Aktif</b>';
                                                        }else{
                                                            echo  '<i class="fas fa-circle text-c-red f-10 m-r-15"></i>';
                                                            echo  '<code>Non Aktif</code>';
                                                        }
                                                        //echo $this->Absen_model->getStatusAuth($data['id_user']);
                                                        ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                        if($this->Absen_model->getStatusAuth($data['id_user'])==1){
                                                            echo  '<i class="fas fa-circle text-c-green f-10 m-r-15"></i>';
                                                           echo  '<b style="color: #24b500;">Aktif</b>';
                                                        }else{
                                                            echo  '<i class="fas fa-circle text-c-red f-10 m-r-15"></i>';
                                                            echo  '-';
                                                        }
                                                        //echo $this->Absen_model->getStatusAuth($data['id_user']);
                                                        ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                        // if($this->Absen_model->getStatusAuth($data['id_user'])==1){
                                                        //   echo  '<i class="fas fa-circle text-c-green f-10 m-r-15"></i>';
                                                        // }else{
                                                        //     echo  '<i class="fas fa-circle text-c-red f-10 m-r-15"></i>';
                                                        // }
                                                        //echo $this->Absen_model->getStatusAuth($data['id_user']);
                                                        ?>
                                                                    <a href="javascript:void(0)"
                                                                        id="id_<?= $data['id_user'];?>"
                                                                        onclick="delete_item('Action_user/hapus_device_id','<?php echo $data['id_user']; ?>','<?php echo 'Hapus Device ID '.$data['nama_lengkap'] ?>');"
                                                                        class="label theme-bg2 text-white f-12 remove">Hapus
                                                                        Device
                                                                        ID</a><a
                                                                        href="<?php echo base_url('absen_user_controller/') ?><?php echo $data['id_user']; ?>"
                                                                        class="label theme-bg text-white f-12">Lihat
                                                                        Laporan</a>
                                                                </td>

                                                            </tr>
                                                            <?php endif;?>
                                                            <?php endforeach; ?>

                                                        </tbody>
                                                    </table>
                                                    <pre>
                                            <?php
                                            echo (isset($_GET['bug'])==1)? var_dump($daftar_user): "";
                                            ?>
                                            </pre>
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