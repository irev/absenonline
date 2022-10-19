<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REKAP ABSEN</title>
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

        .col-masuk {
            background-color: #f1f1f1;
        }

        .col-pulang {
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
    </style>
</head>

<body onload="prints()">

    <h5>REKAP ABSEN</h5>
    <?php
    $idAdminInstansi = $this->input->post('instansi');
    echo "<h4>" . $this->Absen_model->getNamaOPDbyIDAdmin($idAdminInstansi)['data'][0]['nama_instansi'] . "</h4>";
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
    echo '<pre>'.var_dump($nama).'</pre>';
    //$tanggal = '2020-08-01';
    $tahun = date('Y');
    $tahun = $this->input->post('tahun'); // '2021';
    $bulan = date('m');
    $bulan =  $this->input->post('bulan');
    $bulan2d = sprintf("%'02d", $bulan);
    $tahun_bulan = join('-', [$tahun, $bulan2d]);
    

    //$idAdminInstansi = $this->session->userdata('id_user');  /// get session admin_instansi 4393

    echo "<p style='margin: 0;'>Bulan " . nice_date($tahun . $bulan2d, 'F Y') . "</p>";
    // TODO Ambil hari dalam satu bulan 
    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    //// TABLE HEADER
    echo "<div class='row'>";
    echo '<table class="table tabel-rekap table-bordered"><thead>' . "\n";
    echo '<th width="10%" min-width="20%" id="kolom-nama">NAMA</th>';
    for ($i = 1; $i < $tanggal + 1; $i++) {
        echo '<th colspan="2" class="' . tgl_indomerah($tahun, $bulan, $i) . '"> ';
        echo $i . '<br>' . tgl_indomerah($tahun, $bulan, $i);
        echo ' </th>' . "\n";
    }
    echo '<th colspan="4">Total Jam</th>' . "\n";
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
    echo '</tr></thead><tbody>';
    //// EMPLOYEs NAME 
    // TODO TAMPILAN TOTAL WAKTU ABSEN
    // FIXME perbaikan total jam kerja tidak muncul
    $allDurasi = [];
    foreach ($nama as $key) {
        echo '<tr>
        <td  style="text-align: left !important; font-weight: bold; padding-left: 3px;">' . $key['nama_lengkap'] . '</td>';
        for ($x = 1; $x < $tanggal + 1; $x++) {
            $tgl = join('-', [$tahun, sprintf("%'02d", $bulan), sprintf("%'02d", $x)]);
            echo '<td class="time col-masuk ' . tgl_indomerah($tahun, $bulan, $x) . '"> ' . $this->Rekap_model->getRekap_time($idAdminInstansi, $key['id_user'], $tgl, 'in') . '</td>
                <td class="time col-pulang ' . tgl_indomerah($tahun, $bulan, $x) . '">' . $this->Rekap_model->getRekap_time($idAdminInstansi, $key['id_user'], $tgl, 'out') . '</td>';
            $start = $this->Rekap_model->getRekap_time($idAdminInstansi, $key['id_user'], $tgl, 'in');
            $end   = $this->Rekap_model->getRekap_time($idAdminInstansi, $key['id_user'], $tgl, 'out');
            $drs = $this->durasiwaktu->Durasi_Masuk_Pulang($start, $end, $tgl);
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
        echo '<td class="time" id="col-pulang">';
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
        foreach ($allDurasi as $v) {
            if (array_key_exists($key['id_user'], $v)) {
                array_push($ALLDURASIBYUSER, $v[$key['id_user']]);
            }
        }
        echo $this->durasiwaktu->Total_Durasi_Jam_Kerja($ALLDURASIBYUSER);
        echo '</td>';
        echo '<td>';
        $ab_sen = $this->db->query("SELECT jam_masuk as m, jam_pulang as p , DAYNAME(tanggal_absen) as hari FROM `absen` WHERE id_user='" . $key['id_user'] . "' AND status='1' AND tanggal_absen LIKE '" . $tahun_bulan . "%' ")->result_array();
        $schedule = $this->db->query("SELECT * FROM `jam`")->result_array();

        // $jadwals = [
        //     'cm' => '07:30',
        //     'cp' => '16:00'
        // ];
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
        //AKHIR TABLE
        echo '</tr>';
    }
    //dd($allDurasi); // DEBUG  tampil durasi jam kerja  
    //dd($ALLDURASIBYUSER); // DEBUG tampil total jam kerja
    echo '</tbody></table>';
    echo "</div>";

    ?>

    <!-- <hr> -->
    <p class="keterangan">
        <u style="font-weight: bold;">Keterangan:</u> <br>
        <span style="margin-left: 10px; font-size:10px">
            M : Jam Masuk, P : Jam Pulang, PC: Pulang Cepat, L : Lembur
        </span><br>
        <span style="margin-left: 10px; font-size:10px"></span><br>
    </p>
    <center>
        <button onclick="minggu();" class="print" id="btn-minggu">Sembunyi Minggu</button>
        <button onclick="sabtu();" class="print" id="btn-sabtu">Sembunyi Sabtu</button>
        <hr class="print">
        <button onclick="print();" class="print">CETAK</button>

    </center>
    <?php
    //echo $this->db->last_query();
    ?>

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
</body>

</html>