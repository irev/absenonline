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
                                    <form id="form-multiple" class="section-to-print">
                                        <table class="table form-sementara" id="form-sementara">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                    <th>Jam Masuk</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($pegawai as $val) {
                                                    switch ($val['status_absen']) {
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
                                                    echo '<tr>';
                                                    echo '<td id="'.$val['id_user'].'">'.$val['nama_panjang'].'</td>';
                                                    echo '<td>'.$status_absen.'</td>';
                                                    echo '<td>'.$val['tgl_absen'].'</td>';
                                                    echo '<td>'.$val['masuk'].'</td>';
                                                    echo '<tr>';
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                        <div id="check-box"></div>
                                        <div id="button-postinng"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>