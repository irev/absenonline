
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
                                        <h5>Pengaturan Absen</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nama Wifi</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $pengaturan->SSID ?>" readonly>

                                                    </div>

                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <form>
                                                    <div class="form-group">
                                                        <label>BSSID</label>
                                                        <input type="text" class="form-control" value="<?php echo $pengaturan->BSSID ?>">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form>
                                                    <div class="form-group">

                                                        <label for="exampleInputEmail1">Jam Masuk</label>
                                                        <input type="text" class="form-control" id='datetimepicker3' aria-describedby="emailHelp" value="<?php echo $pengaturan->jam_masuk ?>">

                                                    </div>

                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <form>
                                                    <div class="form-group">
                                                        <label>Jam Pulang</label>
                                                        <input type="text" class="form-control timepicker" value="<?php echo $pengaturan->jam_pulang ?>" id="timepicker" name="timepicker">
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