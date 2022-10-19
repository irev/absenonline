<style>
@media print {
    body * {
        visibility: hidden;
    }

    .section-to-print,
    .section-to-print * {
        visibility: visible;
    }

    .section-to-print {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .pcoded-main-container * {
        margin: 0;
    }
}
</style>
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
                                            role="tab" aria-controls="home" aria-selected="true">Buat Permohonan </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <?php if(isset($error)): ?>
                                    <div class="alert alert-danger"><?php echo $error; ?>
                                         <?php (ENVIRONMENT !== 'production')? '' : $_SERVER['DOCUMENT_ROOT']; ?></div>
                                    <?php endif; ?>
                                <form action="<?= base_url(); ?>buatabsen_controller/RequestCreate" enctype="multipart/form-data" method="post">
                                    <div class="form-group col-sm-12">
                                        <label>Nomor Surat</label>
                                        <input type="text" name="nomor" id="nomor" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label>Pejabat/atasan Penanggu Jawab</label>
                                        <input type="text" name="ttd" id="ttd" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label>Nip</label>
                                        <input type="text" name="nip" id="nip" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label>Tanggal Absen</label>
                                        <input name="tgl" id="tgl" type="date" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label>Keteranagan</label>
                                        <textarea name="ket" id="keterangan" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label>File Pernyataan dengan format PDF </label>
                                        <input type="file" name="file" id="file" accept="application/pdf">
                                    </div>    
                                    <div class="form-group col-sm-12">
                                        <input type="submit" value="Simpan" class="btn btn-primary">
                                    </div>
                                </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>