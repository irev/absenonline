<?php
echo 'rekap';
    $idAdminInstansi = $this->input->post('instansi');
    // $nama = $this->Rekap_model->getRekap_nama($idAdminInstansi);
    // echo json_encode($nama);
    // echo json_encode($daftar_user);
    // die;
    
    
    $NAMA_INSTANSI =$this->Absen_model->getNamaOPDbyIDAdmin($idAdminInstansi)['data'][0]['nama_instansi'];
    echo "<h4>" . $NAMA_INSTANSI . "</h4>";
    //echo $this->db->last_query();
    //// VARIABEL DATA

    //use function PHPSTORM_META\sql_injection_subst;
    // DONE REKAP DATA PERBULAN
    //dd($this->session->all_userdata()); // DEBUG  tampilsession user
    if ($this->session->userdata('id_instansi') == '3050' || $this->session->userdata('id_instansi') == '3048') {
        $idAdminInstansi = $this->input->post('instansi');
        $idInstansi = $this->Absen_model->getNamaOPDbyIDAdmin($idAdminInstansi)['data'][0]['id_instansi'];
    } else {
        //$idAdminInstansi = $this->session->userdata('id_instansi'); 
        $idAdminInstansi = $this->input->post('instansi');
        $idInstansi = $this->Absen_model->getNamaOPDbyIDAdmin($idAdminInstansi)['data'][0]['id_instansi'];
    }
    $idUser = $this->session->userdata('id_user');
    $nama = $this->Rekap_model->getRekap_nama($idAdminInstansi);
    
     
    //$nama = $this->Rekap_model->getRekapNamaApiByIdIstansi($idInstansi)['data']; 
    //echo '<pre>'.var_dump($nama).'</pre>';
    //$tanggal = '2020-08-01';
    $tahun = date('Y');
    $tahun = $this->input->post('tahun'); // '2021';
    $bulan = date('m');
    $bulan =  $this->input->post('bulan');
    $bulan2d = sprintf("%'02d", $bulan);
    $tahun_bulan = join('-', [$tahun, $bulan2d]);
    $RekapHariTerakhir = $this->Rekap_model->getRekap_hariterakhir($tahun.'-'.$bulan2d.'-%', $idAdminInstansi);
    if(date('Y') != $tahun or  date('m') != $bulan){
       $RekapHariTerakhir = $tahun.'-'.$bulan2d.'-'.cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    }
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REKAP ABSEN <?= $NAMA_INSTANSI.' '. nice_date($tahun . $bulan2d, 'F Y')?></title>
    <style>
    @page {
        /* size: landscape; */
        margin: 5px;
        width: 1154px;
    }

    @media (orientation: landscape) {
        body {
            flex-direction: row;
        }
    }

    @media print {
        .print {
            display: none;
        }

        body {
            /* transform: scale(.7); */
        }

        table {
            size: landscape;

            /* transform: scale(0, .8, .9, .9); */
            /* page-break-inside: avoid; */
            /* transform: scale(.7); */
        }
    }

    table {
        /* width: $page-width - 2*$page-margin; */
        width: calc(100% / 2);
        page-break-inside: avoid;
        width: 100%;
        margin: 0 auto;
        clear: both;
        /* border-collapse: separate; */
        border-spacing: 0;
        /* box-sizing: border-box; */
        text-indent: initial;
        font-size: .7rem;
        border-color: grey;
        border-collapse: collapse;
    }

    h5,
    h4 {
        text-align: center;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 1px;
    }

    .row {
        padding: 5px;
    }

    .table-bordered,
    th,
    td {
        border: 1px solid #ddd;
    }


    table th,
    table td {
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        font-weight: bold !important;
        background-color: #f1f1f1;
    }

    .time {
        font-size: .6rem;
        min-width: 20px !important;
    }

    table>tr>td.name {
        font-weight: bold !important;
    }

    .keterangan {
        font-size: .7rem;
    }

    #kolom-nama {
        min-width: 150px;
        max-width: 300px;
    }

    /*.col-masuk {*/
    /*    background-color: #f1f1f1;*/
    /*}*/

    /*.col-pulang {*/
    /*    background-color: #ffffff;*/
    /*}*/

    .genab {
        background-color: #f1f1f1;
    }

    .ganjil {
        background-color: #ffffff;
    }

    .Minggu {
        background-color: #ffc7d1;
    }

    .Sabtu {
        background-color: #ffe2e8;
    }

    .show {
        display: block;
    }

    .hide {
        display: none;
    }

    code {
        color: red;
        font-size: 10px;
        font-style: italic;
        background-color: darkgray;
        border-radius: 4px 5px;
        margin: 200px;
    }
    </style>
</head>

<body onload="prints()">

    <h5>REKAP ABSEN <br> <button id="btnExport" onclick="fnExcelReport();"> EXPORT EXCEL</button> </h5>

    <?php
                //$idAdminInstansi = $this->session->userdata('id_user');  /// get session admin_instansi 4393
                $no=1;
                echo "<p style='margin: 0;'>Bulan " . nice_date($tahun . $bulan2d, 'F Y') . "</p>";
                // TODO Ambil hari dalam satu bulan 
                $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                //// TABLE HEADER
                echo "<div class='row'>";
/* ===========================================================                
* START HEADER TABEL 
=============================================================*/                
                echo '<table id="headerTable" class="table tabel-rekap table-bordered"><thead>' . "\n";
                echo '<th width="3px" rowspan="">No.</th>';
                echo '<th width="10%" min-width="20%" id="kolom-nama" rowspan="2">NAMA</th>';
                for ($i = 1; $i < $tanggal + 1; $i++) {
                    echo '<th colspan="2" class="' . tgl_indomerah($tahun, $bulan, $i) . '"> ';
                    echo $i . '<br>' . tgl_indomerah($tahun, $bulan, $i);
                    echo ' </th>' . "\n";
                }
                echo '<th colspan="4">Total Jam</th>' . "\n";
                echo '<th colspan="4">Keterangan</th>' . "\n";
                echo '</tr>' . "\n";
                // TODO Header rekap absen
                /// TABLE HEADER DAYs
                echo '<tr><th></th>';
                for ($x = 1; $x < $tanggal + 1; $x++) {
                    echo '<th  class="' . tgl_indomerah($tahun, $bulan, $x) . '">M</th><th class="' . tgl_indomerah($tahun, $bulan, $x) . '">P</th>' . "\n";
                }
                echo '<th>Kerja</th>' . "\n";
                echo '<th>Terlambat</th>' . "\n";
                echo '<th>PC</th>' . "\n";
                echo '<th>L</th>' . "\n";
                echo '<th>DL</th>' . "\n";
                echo '<th>I</th>' . "\n";
                echo '<th>S</th>' . "\n";
                echo '<th>TK</th>' . "\n";
                echo '</tr>';
                echo '</thead><tbody>';
/* ===========================================================                
* END HEADER TABEL
=============================================================*/
                //// EMPLOYEs NAME 
                // TODO TAMPILAN TOTAL WAKTU ABSEN
                // FIXME perbaikan total jam kerja tidak muncul
                $allDurasi = [];
                $allTanpaKeterangan = [];
                $TK=[];
                
                //foreach ($nama as $key) {
                foreach ($daftar_user as $key) {
                    $userKEY = $key['id_user'];
                    if($key['status'] == 1 ){
                    $userKEY = $key['id_user'];
                    echo '<tr>
                    <td>' . $no++ . '</td>';
                    echo '
                    <td  style="text-align: left !important; font-weight: bold; padding-left: 3px;">' . $key['nama_lengkap'] . '</td>';
                    //for tanggal pada bulan ini.
                    
                    for ($x = 1; $x < $tanggal + 1; $x++) {
                        if($x == 1){ 
                            $TK[$key['id_user']] = 0;
                            $tk=1;
                        }
                        $whari = tgl_indomerah($tahun, $bulan, $x);
                        $tgl = join('-', [$tahun, sprintf("%'02d", $bulan), sprintf("%'02d", $x)]);
                        // kolom jam masuk
                        echo '<td class="time col-masuk text-center' . tgl_indomerah($tahun, $bulan, $x) .' '. genab_ganjil($x). '">';
                        if(strtotime($RekapHariTerakhir) > strtotime($tgl) AND $whari != 'Sabtu' AND $whari != 'Minggu'){
                            $wMasuk = $this->Rekap_model->getRekap_time($idAdminInstansi, $key['id_user'], $tgl, 'in'); 
                            if ($wMasuk != 'i' AND $wMasuk != 'DL' AND $wMasuk != 'S' AND $wMasuk != 'TK' AND $wMasuk != 'CT' AND $wMasuk != 'TK') {
                                $xMasuk = $this->db->query("SELECT F_Get_CekJadwal('".$tgl."','MAX_IN') AS xMasuk")->row('xMasuk');
                                $jMasuk = $this->db->query("SELECT F_Get_CekJadwal('".$tgl."','IN') AS jMasuk")->row('jMasuk');
                                echo $this->durasiwaktu->Terlambat_Masuk($wMasuk,$xMasuk,$jMasuk,10);
                            }else if($wMasuk == 'i'){
                                echo 'I';
                            }else if($wMasuk == 'DL'){
                                echo 'DL';
                            }else if($wMasuk == 'S'){
                                echo 'S';
                            }else if($wMasuk == 'CT'){
                                echo 'CT';
                            }else if($wMasuk == 'TK'){
                                echo 'TK';
                            }
                        }else if($whari == 'Sabtu' or $whari == 'Minggu'){
                                echo '-';
                        }else{
                            echo '-';
                        }
                        echo '</td>';
                        //kolom jam pulang
                        echo '<td class="time col-pulang text-center' . tgl_indomerah($tahun, $bulan, $x) .' '. genab_ganjil($x).'">'; 
                            if(strtotime($RekapHariTerakhir) > strtotime($tgl) AND ($whari != 'Sabtu' AND $whari != 'Minggu')){
                                $wPulang = $this->Rekap_model->getRekap_time($idAdminInstansi, $key['id_user'], $tgl, 'out'); 
                                $xPulang = $this->db->query("SELECT F_Get_CekJadwal('".$tgl."','MIN_OUT') AS xOUT")->row('xOUT');
                                $jPulang = $this->db->query("SELECT F_Get_CekJadwal('".$tgl."','OUT') AS jOUT")->row('jOUT');
                                
                                if ($wPulang != 'i' AND $wPulang != 'DL' AND $wPulang != 'S' AND $wPulang != 'CT' AND $wPulang != 'TK') {
                                    echo substr($wPulang,10,6)."\n";
                                    echo $this->durasiwaktu->Pulang_Cepat($wPulang,$xPulang,$jPulang,10);
                                }else if($wPulang == 'i'){
                                    echo 'I';
                                }else if($wPulang == 'DL'){
                                    echo 'DL';
                                }else if($wPulang == 'S'){
                                    echo 'S';
                                }else if($wPulang == 'CT'){
                                    echo 'CT';
                                }else if($wPulang == 'TK'){
                                    echo 'TK';
                                }
                                if($wPulang =='TK' && $userKEY == $key['id_user']){
                                    $TK[$key['id_user']] = $tk++;
                                }
                            }else if($whari == 'Sabtu' or $whari == 'Minggu'){
                                echo '-';
                            }else{
                                echo '-';
                            }
                        echo '</td>';
                        
                        $start = $this->Rekap_model->getRekap_time($idAdminInstansi, $key['id_user'], $tgl, 'in');
                        $end   = $this->Rekap_model->getRekap_time($idAdminInstansi, $key['id_user'], $tgl, 'out');
                        // Hitung durasi
                        $drs = $this->durasiwaktu->Durasi_Masuk_Pulang($start, $end, $tgl);
                            // start Kumpulkan durasi jam kerja 
                            if ($drs != "null") {
                                // TODO PUSH ARRAY JAM KERJA
                                /**
                                 *  senin - kamis (07:30 - 16:00) 
                                 *  
                                 */
                                array_push($allDurasi, [$key['id_user'] => $drs]);
                            }
                    
                    }
                    
                    /// Total durasi
                    echo '<td class="time" id="col-pulang ">';
                    /*
                    * TODO jam absen Selama sebulan by user
                    * ambil semua jam masuk dalam satu bulan  $this->durasiwaktu->get_Absen_Sebulan_ByUser('2021-08', $key['id_user'])
                    * hitung durasi jam kerja 
                    * totalkan jam kerja
                    */
                    // FIXME explode tanggal "0000-00";
                    $post_tahun = $this->input->post('tahun');
                    $post_bulan = $this->input->post('bulan');
                    $set_bulan = join("-", [$post_tahun, $post_bulan]);
                    $allT = $this->durasiwaktu->get_Absen_Sebulan_ByUser($set_bulan, $key['id_user']);
                    //echo "ALL TIME";
                    $ALLDURASIBYUSER = [];
                    $ALL_TK_BYUSER = [];
                    $DL = $this->Rekap_model->getRekap_status($idAdminInstansi, $key['id_user'], $tahun.'-'.$bulan2d.'-%', '2');
                    foreach ($allDurasi as $v) {
                        if (array_key_exists($key['id_user'], $v)) {
                            array_push($ALLDURASIBYUSER, $v[$key['id_user']]);
                            array_push($ALL_TK_BYUSER, $v[$key['id_user']]);
                        }
                    }
                    for ($i=0; $i < $DL; $i++) { 
                                array_push($ALLDURASIBYUSER, '07:30');
                    }
                    //dd($ALLDURASIBYUSER);
                    //echo json_encode($ALLDURASIBYUSER).' DL = '. $DL .'<br>';
                    echo $timeDL = $this->durasiwaktu->Total_Durasi_Jam_Kerja($ALLDURASIBYUSER);
                    echo '</td>';
                    echo '<td>';
                    $ab_sen = $this->db->query("SELECT timestamp_masuk as m, timestamp_pulang as p , DAYNAME(tgl_absen) as hari FROM `absen5` WHERE id_user='" . $key['id_user'] . "' AND status='1' AND tgl_absen LIKE '" . $tahun_bulan . "%' ")->result_array();
                    //echo $this->db->last_query();
                    //dd($ab_sen);
                    $schedule = $this->db->query("SELECT * FROM `jam`")->result_array();

                    // $jadwals = [
                    //     'cm' => '07:30',
                    //     'cp' => '16:00'
                    // ];
                    // ketentuan 
                    // 07:30 - 16:00 senin-kamis total jam kerja total 7.5 jam
                    // 07:30 - 1630 jum'at total 7.5 jam
                    // set toleransi 07:40 toleransi  10 menit
                    $telat = [
                        [
                            'm' => '08:00',
                            'p' => '16:00'
                        ],
                        [
                            'm' => '09:52',
                            'p' => '07:00'
                        ],
                        [
                            'm' => '07:30',
                            'p' => '07:00'
                        ]
                    ];
                    // TODO Hitung Terlambat

                    $this->hitungterlambat->Hitung($ab_sen, $schedule, 'masuk');
                    //echo $key['id_user'];
                    echo '</td>';
                    echo '<td>';
                    $this->hitungterlambat->Hitung($ab_sen, $schedule, 'pulang_cepat');
                    echo '</td>';
                    echo '<td>';
                    $this->hitungterlambat->Hitung($ab_sen, $schedule, 'pulang_lama');
                    echo '</td>';
                    echo '<td>';
                        echo $DL ; // $this->Rekap_model->getRekap_status($idAdminInstansi, $key['id_user'], $tahun.'-'.$bulan2d.'-%', '2'); // DL
                    echo '</td>';
                    echo '<td>';
                        echo $this->Rekap_model->getRekap_status($idAdminInstansi, $key['id_user'], $tahun.'-'.$bulan2d.'-%', '3'); // IZIN
                    echo '</td>';
                    echo '<td>';
                        echo $this->Rekap_model->getRekap_status($idAdminInstansi, $key['id_user'], $tahun.'-'.$bulan2d.'-%', '4'); // SAKIT
                    echo '</td>';
                    echo '<td>';
                            //echo $this->Rekap_model->getRekap_hariterakhir($tahun.'-'.$bulan2d.'-%'); // TK
                            echo $TK[$key['id_user']];
                    echo '</td>';
                    //AKHIR TABLE
                    echo '</tr>';
                    }
                }
                //dd($allDurasi); // DEBUG  tampil durasi jam kerja  
                //dd($ALLDURASIBYUSER); // DEBUG tampil total jam kerja
                echo '</tbody></table>';
                echo "</div>";

            ?>
    <iframe id="txtArea1" style="display:none"></iframe>
    <!-- <hr> -->
    <p class="keterangan">
        <u style="font-weight: bold;">Keterangan:</u> <br>
    <ol style="margin-left: 10px; font-size:12px">
        <li>M : Jam Masuk<br></li>
        <li>P : Jam Pulang<br></li>
        <li>I : IZIN<br></li>
        <li>S : Saki<br></li>
        <li>DL : Dinas Luar<br></li>
        <li>CT : Cuti<br></li>
        <li>TK : Tanpa Keterangan</li>
    </ol> <br>
    </p>
    <center>
        <button onclick="minggu();" class="print" id="btn-minggu">Sembunyi Minggu</button>
        <button onclick="sabtu();" class="print" id="btn-sabtu">Sembunyi Sabtu</button>
        <hr class="print">
        <button onclick="print();" class="print">CETAK</button>
        <br>
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.</p>
    </center>

    <script>
    //document.addEventListener("DOMContentLoaded", function(event) { 
    console.log("ready!");

    function minggu() {
        var x = document.getElementsByClassName("Minggu");
        console.log(x);
        for (var i = 0; i < x.length; i++) {
            x[i].classList.toggle('hide');
        }
        var y = document.getElementById("btn-minggu");
        if (y.innerHTML === "Sembunyi Minggu") {
            y.innerHTML = "Tampil Minggu";
        } else {
            y.innerHTML = "Sembunyi Minggu";
        }

    }

    function sabtu() {
        var x = document.getElementsByClassName("Sabtu");
        console.log(x);
        for (var i = 0; i < x.length; i++) {
            x[i].classList.toggle('hide');
        }
        var y = document.getElementById("btn-sabtu");
        if (y.innerHTML === "Sembunyi Sabtu") {
            y.innerHTML = "Tampil Sabtu";
        } else {
            y.innerHTML = "Sembunyi Sabtu";
        }
    }
    // });
    </script>

    <script>
    function fnExcelReport() {
        var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById('headerTable'); // id of table

        for (j = 0; j < tab.rows.length; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
        } else //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

        return (sa);
    }
    </script>
</body>

</html>