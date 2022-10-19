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
                                            role="tab" aria-controls="home" aria-selected="true">Buat Absen</a>
                                    </li>
                                </ul>
                                
                                <div class="tab-content" id="myTabContent">
                                    <h4>Daftar Pengajuan <span id="jumlah-form"></span></h4>
                                    <form id="form-multiple" action="" method="post">
                                        <input type="hidden" value="<?= $this->input->post('idx') ?>" name="idx">
                                        <table class="table dataTable " id="tables">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                    <th>Jam Masuk</th>
                                                    <th><label class="checkbox">Pilih Semua</label><br><input type="checkbox" name="checkbox" id="checkbox-all"/></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($daftar_user as $dus) {
                                                    foreach ($pegawai as $peg) {
                                                        if($dus['id_user'] == $peg['id_user']){;
                                                            // Gabung array semua daftaruser dgn data pengajuan
                                                            $sData = array_merge($dus, $peg);
                                                            switch ($sData['status_absen']) {
                                                        case '1':
                                                            $status_absen = 'Hadir';
                                                            break;
                                                        case '2':
                                                            $status_absen = 'DL';
                                                            break;
                                                        case '3':
                                                            $status_absen = 'Izin';
                                                            break;
                                                        case '4':
                                                            $status_absen = 'Sakit';
                                                            break;
                                                        default:
                                                            $status_absen = '';
                                                            break;
                                                    }
                                                  // echo '<pre>'; var_dump($sData); echo '</pre>'; 
                                                            echo '<tr user-id="'.$sData['id_user'].'">';
                                                            echo '<td id="'.$sData['id_user'].'">'.$sData['nama_panjang'].'</td>';
                                                            echo '<td data-row="'.$sData['status_absen'].'">'.$status_absen.'</td>';
                                                            echo '<td >'.$sData['tgl_absen'].'</td>';
                                                            echo '<td >'.$sData['masuk'].'</td>';
                                                             echo '<td>
                                                            <input type="checkbox" class="checkbox checkboxs" name="checkbox['.$sData['id_user'].']" id="'.$sData['id_user'].'">
                                                            <input type="hidden" name="id['.$sData['id_user'].']" value="'.$sData['id'].'" >
                                                            <input type="hidden" name="id_user['.$sData['id_user'].']" value="'.$sData['id_user'].'" >
                                                            <input type="hidden" name="id_admin_instansi['.$sData['id_user'].']" value="'.$sData['id_admin_instansi'].'" >
                                                            <input type="hidden" name="username['.$sData['id_user'].']" value="'.$sData['username'].'" >
                                                            <input type="hidden" name="nama_lengkap['.$sData['id_user'].']" value="'.$sData['nama_lengkap'].'" >
                                                            <input type="hidden" name="instansi['.$sData['id_user'].']" value="'.$sData['id_instansi'].'" >
                                                            <input type="hidden" name="timestamp_masuk['.$sData['id_user'].']" value="'.$sData['masuk'].'" >
                                                            <input type="hidden" name="tgl_absen['.$sData['id_user'].']" value="'.$sData['tgl_absen'].'" >
                                                            <input type="hidden" name="status['.$sData['id_user'].']" value="'.$sData['status'].'" >
                                                            </td>';
                                                            echo '<tr>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr id="info-proses"></tr>
                                                <tr id="button-proses">
                                                    
                                                </tr>
                                            </tfoot>
                                            
                                        </table>
                                    </form>    
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