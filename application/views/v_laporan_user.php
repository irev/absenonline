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
                                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Dinas Luar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Kehadiran</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Ijin</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <table class="table table-hover" id="example">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <th>Tanggal</th>
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
                                                                src="<?php echo base_url(); ?>assets/images/user/avatar-2.jpg"
                                                                alt="activity-user"><?php echo $data['nama_lengkap']; ?>
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">
                                                            <?php echo date("d/m/Y", strtotime($data['tanggal_absen']));  ?>
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info"
                                                            onclick="window.location.href='<?php echo base_url('file_ijin/'.$data['file']) ?>', '_blank'">
                                                            BUKA </button>
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
                                        <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <table class="table table-hover" id="kehadiran">
                                                <thead>
                                                    <tr>
                                                    <th>Nama Lengkap</th>
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
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="<?php echo base_url(); ?>assets/images/user/avatar-2.jpg" alt="activity-user"><?php echo $data['nama_lengkap']; ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo date("d/m/Y", strtotime($data['tanggal_absen']));  ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo $data['jam_masuk']; ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo $data['jam_pulang']; ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0"><?php echo $data['waktu_kerja']; ?></h6>
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
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <table class="table table-hover" id="ijin">
                                                <thead>
                                                    <tr>
                                                    <th>Nama Lengkap</th>
                                                        <th>Tanggal</th>
                                                        <th>Lampiran</th>
                                                        <th>Status</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($ijin as $data) : ?>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10"
                                                                style="width:40px;"
                                                                src="<?php echo base_url(); ?>assets/images/user/avatar-2.jpg"
                                                                alt="activity-user"><?php echo $data['nama_lengkap']; ?>
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">
                                                            <?php echo date("d/m/Y", strtotime($data['tanggal_absen']));  ?>
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info"
                                                            onclick="window.location.href='<?php echo base_url('file_ijin/'.$data['file']) ?>', '_blank'">
                                                            BUKA </button>
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



<script>
function hapus_data(id) {
    swal({
            title: "Hapus Device ID?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }),
        function() {
            $.ajax({
                url: "<?php echo base_url('daftar_user_controller/hapus_device_id/') ?>",
                type: "post",
                data: {
                    id: id
                },
                success: function() {
                    swal('Data Berhasil Di Hapus', ' ', 'success');
                    $("#delete" + id).fadeTo("slow", 0.7, function() {
                        $(this).remove();
                    })

                },
                error: function() {
                    swal('data gagal di hapus', 'error');
                }
            });

        };

}
</script>