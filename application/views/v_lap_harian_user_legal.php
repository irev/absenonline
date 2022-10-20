<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <title>DAFTAR LAPORAN KERJA HARIAN</title>
        <!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
        <!-- <link href="<?php echo base_url(); ?>assets/plugins/calendar/calendarorganizer.min.css" rel="stylesheet"> -->
        <!-- <script src="<?php echo base_url(); ?>assets/plugins/calendar/calendarorganizer.min.js"></script> -->
        <?php
// echo '<pre>';
// var_dump($laporan); die;
// echo '</pre>';

$user = $this->uri->segment('3');
$idp   = $this->uri->segment('4');
// Ambil tanggal dibulan ini
$angka_bulan = ($this->input->post('bulan') != null)? $this->input->post('bulan') : date('m') ;
$angkaTahun = $this->input->post('tahun');
$tgl_awal = date("1");
$tgl_akhir = ($this->input->post('bulan') != null)? date( 't', strtotime($angkaTahun.'-'.sprintf("%02d", $angka_bulan)."-1")) : date("t");
?>
        <script>
        // tableID– Required.Specify the HTML table ID to export data from.
        // filename– Optional.Specify the file name to download excel data.

        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel'; // file xls
            //var dataType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; // file xlsx

            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_laporan_harian.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
        </script>
        <style>
        body {
            background: #fff;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        table.minimalistBlack {
            border: 3px solid #000000;
            width: 100%;
            /* height: 100%; */
            text-align: left;
            border-collapse: collapse;
        }

        table.minimalistBlack td,
        table.minimalistBlack th {
            border: 1px solid #000000;
            padding: 5px 4px;
        }

        table.minimalistBlack tbody td {
            font-size: 13px;
        }

        table.minimalistBlack thead {
            background: #CFCFCF;
            background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            border-bottom: 3px solid #000000;
        }

        table.minimalistBlack thead th {
            font-size: 15px;
            font-weight: bold;
            color: #000000;
            text-align: left;
        }

        table.minimalistBlack tfoot {
            font-size: 14px;
            font-weight: bold;
            color: #000000;
            border-top: 3px solid #000000;
        }

        table.minimalistBlack tfoot td {
            font-size: 14px;
        }

        td.text-tengah {
            text-align: center !important;
        }
        </style>


        <style>
        td.keterangan {
            word-wrap: break-word;
            white-space: normal;
        }

        @media print {
            @page {
                size: landscape;
                /* size: portrait; */
            }

            body {
                background: #fff;
            }

            td .keterangan {
                word-wrap: break-word;
                white-space: pre-wrap;
            }

            pre.break {
                page-break-inside: avoid;
                page-break-after: always
            }

            div.page-laporan {
                page-break-after: always;
            }

            .no-print,
            .no-print * {
                display: none !important;
            }

            td.text-tengah {
                text-align: center !important;
            }

            table.minimalistBlack {
                border: 3px solid #000000;
                width: 100%;
                /* height: 100%; */
                text-align: left;
                border-collapse: collapse;
            }

            table.minimalistBlack td,
            table.minimalistBlack th {
                border: 2px solid #000000;
                padding: 5px 4px;
            }

            table.minimalistBlack tbody td {
                font-size: 13px;
            }

            table.minimalistBlack tbody tr {
                font-size: 13px;
                border: 2px solid #000000;
            }

            table.minimalistBlack thead {
                background: #CFCFCF;
                background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
                background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
                background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
                border-bottom: 3px solid #000000;
            }

            table.minimalistBlack thead th {
                font-size: 15px;
                font-weight: bold;
                color: #000000;
                text-align: left;
            }

            table.minimalistBlack tfoot {
                font-size: 14px;
                font-weight: bold;
                color: #000000;
                border-top: 3px solid #000000;
            }
        }
        </style>

    </head>

    <body>

        <!-- NO PRINT-->
        <?php
 
echo "<center class='no-print'><div class='tab-content'>";
echo "<h5>LAPORAN HARIAN</h5>";
$nowYear = date('Y');
echo form_open(base_url('laporan_harian_controller/view/'.$user.'/'.$idp), 'target="_blank-x"', 'hidden');
echo "Laporan Harian : <select name='tahun'>";
echo "<option value=" . date('Y') . ">" . date('Y') . "</option>";
for ($y = 2020; $y <= $nowYear; $y++) {
    echo "<option value=" . $y . ">" . $y . "</option>";
}
echo "</select> ";
echo "<select name='bulan'>";

if($this->input->post('bulan')){
    $y = $this->input->post('bulan');
    echo "<option value=" . $y . ">" . bulan($y) . "</option>";
}else{
    echo "<option value=" . date('m') . ">" . date('F') . "</option>";
}
for ($y = 1; $y <= 12; $y++) {
    switch ($y) {
        case '1':
            $bln = 'Januari';
            break;
        case '2':
            $bln = 'Februari';
            break;
        case '3':
            $bln = 'Maret';
            break;
        case '4':
            $bln = 'April';
            break;
        case '5':
            $bln = 'Mei';
            break;
        case '6':
            $bln = 'Juni';
            break;
        case '7':
            $bln = 'Juli';
            break;
        case '8':
            $bln = 'Agustus';
            break;
        case '9':
            $bln = 'September';
            break;
        case '10':
            $bln = 'Oktober';
            break;
        case '11':
            $bln = 'November';
            break;
        case '12':
            $bln = 'Desember';
            break;
        default:
            $bln = date('M');
            break;
    }
    echo "<option value=" . $y . ">" . $bln . "</option>";  
}
echo "</select> ";
$nowYear = date('Y');
$first_day_this_month = date('01'); // hard-coded '01' for first day
$last_day_this_month  = date('m-t-Y');
$last_day_this_month_day_only = explode("-", $last_day_this_month);
// echo "<select name='date'>";
// echo "<option value=" . date('d') . ">" . date('d') . "</option>";
// for ($dt = 1; $dt <= 31; $dt++) {
//     echo "<option value=" . $dt . ">" . $dt . "</option>";
// }
// echo "</select> ";
echo "<button type='submit'>Tampil</button>";
echo form_close();
echo "</div>";

if(! $this->input->post('bulan')){ die; }
?>
        <button onclick="exportTableToExcel('tblData')">Export Table Data To Excel File</button>
        <?php echo"<hr>
</center>";
//cek jumlah laporan yang ada
if(count($laporan) == 0){
    echo '<center> Tidak ditemukan data pada bulan '.bulan($this->input->post('bulan')).' </center>';
    echo '<center><br><?xml version="1.0" encoding="iso-8859-1"?>
    <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
    <svg width="150px" height="150px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
    <g>
        <g>
            <g>
                <path d="M145.067,136.542h102.4c4.719,0,8.533-3.823,8.533-8.533s-3.814-8.533-8.533-8.533h-102.4
                    c-4.719,0-8.533,3.823-8.533,8.533S140.348,136.542,145.067,136.542z"/>
                <path d="M196.267,273.075H128c-4.719,0-8.533,3.823-8.533,8.533c0,4.71,3.814,8.533,8.533,8.533h68.267
                    c4.719,0,8.533-3.823,8.533-8.533C204.8,276.898,200.986,273.075,196.267,273.075z"/>
                <path d="M170.667,230.409c0-4.71-3.814-8.533-8.533-8.533h-51.2c-4.719,0-8.533,3.823-8.533,8.533s3.814,8.533,8.533,8.533h51.2
                    C166.852,238.942,170.667,235.119,170.667,230.409z"/>
                <path d="M110.933,187.742H230.4c4.719,0,8.533-3.823,8.533-8.533c0-4.71-3.814-8.533-8.533-8.533H110.933
                    c-4.719,0-8.533,3.823-8.533,8.533C102.4,183.919,106.214,187.742,110.933,187.742z"/>
                <path d="M264.533,273.075H230.4c-4.719,0-8.533,3.823-8.533,8.533c0,4.71,3.814,8.533,8.533,8.533h34.133
                    c4.719,0,8.533-3.823,8.533-8.533C273.067,276.898,269.252,273.075,264.533,273.075z"/>
                <path d="M386.313,338.057c-3.328,3.328-3.328,8.738,0,12.066l18.108,18.108c1.664,1.673,3.849,2.5,6.033,2.5
                    c2.176,0,4.361-0.828,6.033-2.5c3.328-3.328,3.328-8.73,0-12.066l-18.099-18.108
                    C395.051,334.729,389.649,334.729,386.313,338.057z"/>
                <path d="M499.499,439.177l-59.802-59.793c-1.596-1.604-3.763-2.5-6.033-2.5h-0.008c-2.261,0-4.437,0.905-6.042,2.509
                    l-24.064,24.201c-3.328,3.345-3.311,8.738,0.034,12.066c3.354,3.328,8.747,3.319,12.066-0.034l18.031-18.125l53.751,53.743
                    c4.83,4.838,7.501,11.264,7.501,18.099s-2.671,13.269-7.501,18.099c-9.975,9.975-26.206,9.992-36.198,0.009l-101.12-101.12
                    c-3.328-3.328-8.73-3.328-12.066,0c-3.328,3.337-3.328,8.738,0,12.075l101.12,101.111c8.311,8.32,19.234,12.476,30.157,12.476
                    s21.862-4.164,30.174-12.476c8.055-8.064,12.501-18.773,12.501-30.174C512,457.95,507.554,447.232,499.499,439.177z"/>
                <path d="M409.6,204.809c0-112.922-91.878-204.8-204.8-204.8S0,91.887,0,204.809s91.878,204.8,204.8,204.8
                    S409.6,317.73,409.6,204.809z M204.8,392.542c-103.518,0-187.733-84.215-187.733-187.733S101.282,17.075,204.8,17.075
                    s187.733,84.215,187.733,187.733S308.318,392.542,204.8,392.542z"/>
                <path d="M204.8,34.142c-94.106,0-170.667,76.561-170.667,170.667S110.694,375.475,204.8,375.475s170.667-76.561,170.667-170.667
                    S298.906,34.142,204.8,34.142z M204.8,358.409c-84.693,0-153.6-68.907-153.6-153.6s68.907-153.6,153.6-153.6
                    s153.6,68.907,153.6,153.6S289.493,358.409,204.8,358.409z"/>
                <path d="M298.667,221.875h-102.4c-4.719,0-8.533,3.823-8.533,8.533s3.814,8.533,8.533,8.533h102.4
                    c4.719,0,8.533-3.823,8.533-8.533S303.386,221.875,298.667,221.875z"/>
                <path d="M298.667,170.675h-34.133c-4.719,0-8.533,3.823-8.533,8.533c0,4.71,3.814,8.533,8.533,8.533h34.133
                    c4.719,0,8.533-3.823,8.533-8.533C307.2,174.498,303.386,170.675,298.667,170.675z"/>
            </g>
        </g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    </svg>
    </center>
    ';
die;
}

?>
        <!-- NO PRINT-->
        <div id="tblData">
            <?php 
            // ambil data hari
            $num = 1;
            for ($x = $tgl_awal; $x <= $tgl_akhir; $x++):
            $tgl = date("Y-". sprintf("%02d", $angka_bulan).'-'. sprintf("%02d", $x));
            $s = date("l", strtotime($tgl));
            $hari = $this->hitungterlambat->str_indonamahari($s);
            $tanggal = $this->durasiwaktu->tgl_indo($tgl);
            $dis = "block";
            $show = true;
            if ($hari === "Sabtu" or $hari === "Minggu"){
                $dis = "none";
                $show = false;
            }else{    
        ?>
            <table style='width: 100%;' class='row'>
                <?php if($num % 2 == 0){
                         echo "</td class='atas'></td>";
                        }else{
                        echo "<tr class='atas'><td style='width: 50%;' valign='top'>"; 
                        }
                ?>
                <div class="page-laporan" hari="<?= $hari ?>">
                    <h5>DAFTAR LAPORAN KERJA HARIAN</h5>
                    <table class="minimalistBlack data-laporan" style="display:<?= $dis ?>;">
                        <tr>
                            <td>Nama</td>
                            <td colspan="5">:<?php echo (isset($laporan[0]))? $laporan[0]['nama_pegawai']:'-';?></td>
                        </tr>
                        <tr>
                            <td>Unit Kerja</td>
                            <td colspan="5">: Nama OPD</td>
                        </tr>
                        <tr>
                            <td>Hari/ Tgl</td>
                            <td colspan="5">: <?=  $hari . " / " .  $tanggal?></td>
                        </tr>
                        <tr>
                            <th width="5%" style="border: 0.5pt solid;">No</th>
                            <th width="10%" style="border: 0.5pt solid;">MULAI SELESAI</th>
                            <th width="5%" style="border: 0.5pt solid;">Durasi</th>
                            <th width="30%" style="border: 0.5pt solid;">RINCIAN KEGIATAN/ PEKERJAAN</th>
                            <th width="5%" style="border: 0.5pt solid;">PARAF<br>ATASAN</th>
                            <th width="5%" style="border: 0.5pt solid;">KET</th>
                        </tr>

                        <?php
                    $no = 1;
                    $times = [];
                    //echo json_encode($laporan);
                    // var_dump($laporan);
                    $nama_atasan = "---------------"; 
                    foreach ($laporan as $data):
                        $nama_atasan = $data["nama_atasan"];
                        $tgl_data = $data["tgl"];
                        if($tgl_data == $tgl):
                            if ($data["status"] == 1) {
                                $times[] = $this->durasiwaktu->selisihWaktu(
                                    $data["jammulai"],
                                    $data["jamselesai"]
                                );
                            } ?>
                        <tr>
                            <td style="border: 0.5pt solid;"><?= $no ?></td>
                            <td style="border: 0.5pt solid;"><?php echo substr($data["jammulai"],0, 5); ?> -
                                <?php echo substr($data["jamselesai"],0,5); ?></td>
                            <td style="border: 0.5pt solid;"><?php echo $this->durasiwaktu->selisihWaktu(
                                                    $data["jammulai"],
                                                    $data["jamselesai"]
                                                ); ?> </td>
                            <td class="keterangan" style="word-wrap: break-word; border: 0.5pt solid;">
                                <?php echo $data["rincian_kegiatan"] ?>
                            </td>
                            <td class="text-tengah" style="border: 0.5pt solid;">
                                <?php //echo $data['status'];
                                                    if (
                                                        $data["status"] == 1
                                                    ): ?>
                                <span class="terima">✔️</span>
                                <?php elseif (
                                                        $data["status"] == 2
                                                    ): ?>
                                <span class="tolak">❌</span>
                                <?php elseif (
                                                        $data["status"] == 3
                                                    ): ?>
                                <span class="pengajuan">⚠️</span>
                                <?php else: ?>
                                <span class="pengajuan">⚠️</span>
                                <?php endif; ?>
                            </td>
                            <td style="border: 0.5pt solid;"></td>
                        </tr>
                        <?php $no++;
                                        else:
                                        // echo '<br>'.$data["tgl"].' '.$tgl.'</br>';
                                        endif; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td style="border: 0.5pt solid;"></td>
                            <td style="border: 0.5pt solid;">Total Jam Kerja</td>
                            <td colspan="4" style="border: 0.5pt solid;">
                                <?= $this->durasiwaktu->SumWaktu($times) ?>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-ttd" style="width: 100%;">
                        <tr>
                            <td width="30%" class="text-tengah">
                                Mengetahui<br>
                                Atasan Langsung<br>
                                <br><br><br><br><br>
                                <u><span class="nama-atasan"><?php  echo ($nama_atasan != '')?  $nama_atasan : '--------------------' ?></span></u>
                            </td>
                            <td width="20%"></td>
                            <td width="30%" class="text-tengah">
                                Simpang Empat, <?= $tanggal ?><br>
                                Yang membuat laporan<br>
                                <br><br><br><br><br>
                                <u><?php echo (isset($laporan[0]))? $laporan[0]['nama_pegawai']: '-';?></u>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php 
                if($num % 2 == 0){
                                            echo '</td></tr>'; 
                                        }
                                        else{
                                            echo "</td><td></td><td valign='top'>";
                                        }
                                    //echo ' nomor  '.$x. ' NUM '.$num;  
                         ?>

                <?php $num++; } endfor; ?>
            </table>
        </div>
        </div>
        </div>
        </div>
        </div>


        <script>
        "use strict";
        // function that creates dummy data for demonstration
        function createDummyData() {
            var date = new Date();
            var data = {};

            for (var i = 0; i < 10; i++) {
                data[date.getFullYear() + i] = {};

                for (var j = 0; j < 12; j++) {
                    data[date.getFullYear() + i][j + 1] = {};

                    for (var k = 0; k < Math.ceil(Math.random() * 10); k++) {
                        var l = Math.ceil(Math.random() * 28);

                        try {
                            data[date.getFullYear() + i][j + 1][l].push({
                                startTime: "10:00",
                                endTime: "12:00",
                                text: "Some Event Here",
                                link: "https://github.com/nizarmah/calendar-javascript-lib"
                            });
                        } catch (e) {
                            data[date.getFullYear() + i][j + 1][l] = [];
                            data[date.getFullYear() + i][j + 1][l].push({
                                startTime: "10:00",
                                endTime: "12:00",
                                text: "Some Event Here",
                                link: "https://github.com/nizarmah/calendar-javascript-lib"
                            });
                        }
                    }
                }
            }

            return data;
        }

        // creating the dummy static data
        var data = createDummyData();
        // initializing a new calendar object, that will use an html container to create itself
        var calendar = new Calendar("calendarContainer", // id of html container for calendar
            "small", // size of calendar, can be small | medium | large
            [
                "Wednesday", // left most day of calendar labels
                3 // maximum length of the calendar labels
            ], [
                "#ffc107", // primary color
                "#ffa000", // primary dark color
                "#ffffff", // text color
                "#ffecb3" // text dark color
            ], {
                indicator: true,
                indicator_type: 1, // indicator type, can be 0 (not numeric) | 1 (numeric)
                indicator_pos: "bottom" // indicator position, can be top | bottom
            }
        );

        // initializing a new organizer object, that will use an html container to create itself
        var organizer = new Organizer("organizerContainer", // id of html container for calendar
            calendar, // defining the calendar that the organizer is related to
            data // giving the organizer the static data that should be displayed
        );
        </script>