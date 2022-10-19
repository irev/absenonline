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
                                            role="tab" aria-controls="home" aria-selected="true">Pengajuan Absen</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <form id="form-master" action="" method="POST">
                                        <div class="row">
                                            <div class="col-sm-2">
                                            <?php 
                                           echo  $this->uri->segment('4');
                                            ?>
                                            </div>
                                        </div>
                                        
                                    </form>
                                    <h4>Daftar Pengajuan <span id="jumlah-form"></span></h4>
                                    <div class="table-responsive">    
                                    <table class="table dataTable form-sementara" id="form-sementara">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Surat</th>
                                                    <th>Tanggal Absen</th>
                                                    <th>Penanggung Jawab</th>
                                                    <th>File</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //var_dump($pengajuan);
                                                //$idadmin = $this->uri->segment('4');
                                                foreach ($pengajuan as $val) {
                                                    echo '<tr>';
                                                    echo '<td style="white-space:pre-wrap; word-wrap:break-word">'.$val['nomor_surat'].'<br>Keterangan: <br/>'.$val['keterangan']. '</td>';
                                                    echo '<td>'.date_indo($val['tgl']).'</td>';
                                                    echo '<td>'.$val['ttd'].'<br>'.$val['nip'].'</td>';
                                                    echo '<td> <a class="text-red" target="_blank" href="'.base_url('buatabsen_controller/fileblob/').$val['id'].'"><i class="feather icon-paperclip"></i> file</a></td>';
                                                    if($val['status']!=1){
                                                         echo '<td> ✔️ Selesai </td>';
                                                    }else{
                                                        echo '<td> <form method="post" action="'.base_url('admin/admin_absen_manual_controller/viewlist/').$val['admin_instansi'].'/'.$val['id'].'"><button type="submit" class="btn btn-sm btn-warning" name="idx" value="'.$val['id']. '"/>Daftar Pegawai</button></form></td>';
                                                    }
                                                    echo '</tr>';
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
    </div>