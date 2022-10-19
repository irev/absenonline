<!-- [ ################################# NAVBAR START ################################# ] -->
<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="<?php echo base_url(); ?>" class="b-brand">
                <!-- <div class="b-bg">
                        <i class="feather icon-trending-up"></i>
                    </div> -->
                <img src="<?php echo base_url(); ?>assets/images/calendar.png" style="width:40px;height:40px;"
                    alt="Italian Trulli">
                <span class="b-title">Presensi Online</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div" style='overflow-y: scroll;  scrollbar-color:blue;'>
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project"
                    class="nav-item <?php echo $this->uri->segment(1) == '' ? 'active' : '' ?>">
                    <a href="<?php echo base_url(); ?>" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <?php if ($this->session->userdata('id_user') == '4373'): ?>
                <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project"
                    class="nav-item <?php echo $this->uri->segment(1) == '' ? 'active' : '' ?>">
                    <a href="<?php echo base_url('admin/Admin_absen_manual_controller'); ?>" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Absen Manual</span></a>
                </li>
                <?php endif; ?>
                <li class="nav-item pcoded-menu-caption">
                    <label><?php echo $this->session->userdata('nama_instansi'); ?></label>
                </li>

                <?php if ($this->session->userdata('id_user') == '4332') {
                    foreach ($adminOPD as $data) :
                        if($data['username']== 'admin.pasbar'){
                ?>
                <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds"
                    class="nav-item pcoded-hasmenu <?php echo $this->uri->segment(1) == '' ? '' : 'active pcoded-trigger' ?>">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-box"></i></span><span class="pcoded-mtext">Berita</span></a>
                    <ul class="pcoded-submenu">
                        <li class="<?php echo $this->uri->segment(1) == 'berita' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('berita/' . $this->session->userdata('id_user')); ?>"
                                class="">Semua Berita</a></li>
                        <li class="<?php echo $this->uri->segment(1) == 'tambah_berita' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('tambah_berita/' . $this->session->userdata('id_user')); ?>"
                                class="">Tambah Berita</a></li>
                    </ul>
                </li>
                <?php } endforeach;
                } else { ?>
                <?php } ?>

                <?php  if ($this->session->userdata('id_instansi') == '3050') {
                    foreach ($adminOPD as $data) :
                ?>
                <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds"
                    id="<?php echo $this->uri->segment(1) == 'kehadiran_controller' ? $this->uri->segment(2) : '' ?>"
                    class="nav-item pcoded-hasmenu ">
                    <!-- class="nav-item pcoded-hasmenu <?php echo $this->uri->segment(1) == '' ? '' : 'active pcoded-trigger' ?>"> -->
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-box"></i></span><span
                            class="pcoded-mtext"><?php echo $data['nama_instansi']; ?></span></a>
                    <ul <?php echo $this->uri->segment(2) == $data['id_user'] ? 'style="display: block;"':'' ?>
                        class="pcoded-submenu" id="<?= $this->uri->segment(2) ?>">
                        <li
                            class="<?php echo $this->uri->segment(1) == 'kehadiran_controller' && $this->uri->segment(2) == $data['id_user'] ? 'active' : '' ?>">
                            <a href="<?php echo base_url('kehadiran_controller/' . $data['id_user']); ?>"
                                class="">Laporan Absen</a>
                        </li>
                        <li
                            class="<?php echo $this->uri->segment(1) == 'ijin_controller' && $this->uri->segment(2) == $data['id_user'] ? 'active' : '' ?>">
                            <a href="<?php echo base_url('ijin_controller/' . $data['id_user']); ?>" class="">Laporan
                                Ijin</a>
                        </li>
                        <li
                            class="<?php echo $this->uri->segment(1) == 'dinas_luar_controller' && $this->uri->segment(2) == $data['id_user'] ? 'active' : '' ?>">
                            <a href="<?php echo base_url('dinas_luar_controller/' . $data['id_user']); ?>"
                                class="">Laporan Dinas Luar</a>
                        </li> 

                        <li
                            class="<?php echo $this->uri->segment(1) == 'laporan_harian_controller' && $this->uri->segment(2) == $data['id_user'] ? 'active' : '' ?>">
                            <a href="<?php echo base_url('laporan_harian_controller/' .$data['id_user'].'/'.$data['username']); ?>"
                                class="">Laporan Harian</a>
                        </li>

                        <li
                            class="<?php echo $this->uri->segment(1) == 'upload_data_controller' && $this->uri->segment(2) == $data['id_user'] ? 'active' : '' ?>">
                            <a href="<?php echo base_url('upload_data_controller/' . $this->session->userdata('id_user')); ?>"
                                class="">Upload Data</a>
                        </li>
                        

                        <li class="<?php echo $this->uri->segment(1) == 'daftar_user_controller/' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('daftar_user_controller/' . $data['username']); ?>"
                                class="">Daftar User</a></li>
                        <!-- <li class="<?php echo $this->uri->segment(1) == 'daftar_user_controller/' . $data['username'] ? 'active' : '' ?>"><a
                                href="<?php echo base_url('daftar_user_controller/' . $data['username']); ?>" class="">Daftar User</a></li> -->
                        <!-- <li class=""><a href="bc_collapse.html" class="">Pengaturan Absen</a></li> -->
                        <!-- <li class=""><a href="bc_tabs.html" class="">Tabs & pills</a></li>
                                <li class=""><a href="bc_typography.html" class="">Typography</a></li>
                                <li class=""><a href="icon-feather.html" class="">Feather<span class="pcoded-badge label label-danger">NEW</span></a></li> -->
                        <li
                            class="<?php echo $this->uri->segment(1) == 'Rekap_controller' && $this->uri->segment(2) == $data['id_user'] ? 'active' : '' ?>">
                            <a href="<?php echo base_url('Rekap_controller/' .$data['id_user']); ?>" class="">Rekap
                                Absen</a>
                        </li>
                    </ul>
                </li>
                <?php endforeach;
                } else { ?>
                <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds"
                    class="nav-item pcoded-hasmenu <?php echo $this->uri->segment(1) == '' ? '' : 'active pcoded-trigger' ?>">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-box"></i></span><span class="pcoded-mtext">Managemen Data</span></a>
                    <ul class="pcoded-submenu">
                        <li class="<?php echo $this->uri->segment(1) == 'kehadiran_controller' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('kehadiran_controller/' . $this->session->userdata('id_user')); ?>"
                                class="">Laporan Absen</a></li>
                        <li class="<?php echo $this->uri->segment(1) == 'ijin_controller' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('ijin_controller/' . $this->session->userdata('id_user')); ?>"
                                class="">Laporan Ijin</a></li>
                        <li class="<?php echo $this->uri->segment(1) == 'dinas_luar_controller' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('dinas_luar_controller/' . $this->session->userdata('id_user')); ?>"
                                class="">Laporan Dinas Luar</a>
                        </li>
                        <li class="<?php echo $this->uri->segment(1) == 'laporan_harian_controller' ? 'active' : '' ?>">
                            <a href="<?php echo base_url('laporan_harian_controller/' . $this->session->userdata('id_user').'/'.$this->session->userdata('username')); ?>"
                                class="">Laporan Harian</a>
                        </li>
 
 
                        <li class="<?php echo $this->uri->segment(1) == 'buatabsen_controller' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('buatabsen_controller/' . $this->session->userdata('username')); ?>"
                                class="">Buat Kehadiran</a></li>
 
                        <li class="<?php echo $this->uri->segment(1) == 'daftar_user_controller' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('daftar_user_controller/' . $this->session->userdata('username')); ?>"
                                class="">Daftar User</a></li>

                        <!--li class=""><a href="<?php echo base_url('pengaturan_absen_controller/' . $this->session->userdata('username')); ?>" class="">Pengaturan Absen</a></li-->
                        <!-- <li class=""><a href="bc_tabs.html" class="">Tabs & pills</a></li>
                            <li class=""><a href="bc_typography.html" class="">Typography</a></li>
                            <li class=""><a href="icon-feather.html" class="">Feather<span class="pcoded-badge label label-danger">NEW</span></a></li> -->
                        <li class="<?php echo $this->uri->segment(1) == 'Rekap_controller' ? 'active' : '' ?>"><a
                                href="<?php echo base_url('Rekap_controller/' . $this->session->userdata('id_user')); ?>"
                                class="">Rekap Absen</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>
<!-- [ ################################# NAVBAR END ################################# ] -->