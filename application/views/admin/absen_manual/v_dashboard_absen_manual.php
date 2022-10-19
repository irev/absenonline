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
                                            role="tab" aria-controls="home" aria-selected="true">Absen Manual</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <h4>Daftar Pengajuan <span id="jumlah-form"></span></h4>
                                    <div class="alert alert-info">Daftar (OPD/INSTANSI/BADAN) pengajuan <b>Absensi Manual</b>  </div>
                                        <table class="table dataTable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Permohonan</th>
                                                    <th>Admin / username</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //var_dump($adminOPD);
                                                foreach ($adminOPD as $val) {
                                                    $countText ="";
                                                    $count = $this->Buatkehadiran_model->getPengajuanRow($val['username'],$val['id_user']);
                                                    if($count >= 1){
                                                       $countX = '<a href="'.base_url("admin/admin_absen_manual_controller/view/").$val['username'].'/'.$val['username'].'" class="btn btn-warning" title="Tampil Data">'.$count.'</a>';
                                                        $countText = $countX;
                                                    }else{       
                                                        $countX = '<a href="'.base_url("admin/admin_absen_manual_controller/view/").$val['username'].'/'.$val['username'].'" class="btn btn-success" title="Tampil Data"><i class="feather icon-search"><i></a>';                                                 
                                                        $countText = $countX; 
                                                    }
                                                    echo '<tr>';
                                                    echo '<td>'.$val['no'].'</td>';
                                                    echo '<td id="'.$val['id_user'].'">'.$val['nama_instansi'].'</td>';
                                                    echo '<td>'.$val['name'].'</br>'.$val['username'].'</td>';
                                                    echo '<td>'.$countText.'</td>';
                                                    echo '<tr>';
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                        <div id="check-box"></div>
                                        <div id="button-postinng"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>