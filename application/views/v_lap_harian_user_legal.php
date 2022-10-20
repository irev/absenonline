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
    echo '<?xml version="1.0" ?><svg width="512px" height="512px" viewBox="0 0 512 512" id="icon" xmlns="http://www.w3.org/2000/svg"><title/><path d="M120.5,481.88a5.59,5.59,0,0,0,5-3.18l55.61-116.08a5.58,5.58,0,1,0-10.07-4.82L115.47,473.87a5.59,5.59,0,0,0,5,8Z"/><path d="M329.26,481.88a5.59,5.59,0,0,0,5-8.16l-106.29-205,.88-.35a25.42,25.42,0,0,0,16-25.44l-.62-9.08,99.37-35.16,2.15,5.38a5.58,5.58,0,0,0,5.18,3.51,5.43,5.43,0,0,0,1.67-.26l65-20.24a5.59,5.59,0,0,0-3.33-10.67l-60,18.71-30.77-76.92,72.52-35.84L402,97.57a5.61,5.61,0,0,0,5.19,3.51,5.69,5.69,0,0,0,2.08-.4,5.6,5.6,0,0,0,3.11-7.26L394.87,49.79l17-6.82,2.53,6.32a5.58,5.58,0,1,0,10.37-4.15l-4.6-11.5A5.6,5.6,0,0,0,413,30.52l-27.42,11a5.6,5.6,0,0,0-3.11,7.27L391.72,72l-77.94,38.53a5.57,5.57,0,0,0-2.71,7.08l28.3,70.75L215,232.34a5.59,5.59,0,0,0,3.73,10.53l14.47-5.12.41,6a14.3,14.3,0,0,1-9,14.3l-31.33,12.53a19,19,0,0,1-6.58,1.34h-.35A19,19,0,0,1,174.75,268a5.58,5.58,0,0,0-6.8,8.86,30,30,0,0,0,10.2,5.06L87,473.89a5.59,5.59,0,1,0,10.1,4.79l93-195.87a29.85,29.85,0,0,0,7.38-1.87l17-6.8V476.29a5.59,5.59,0,0,0,11.18,0V288.6L324.3,478.86A5.57,5.57,0,0,0,329.26,481.88Z"/><path d="M239.4,359.26A5.58,5.58,0,0,0,237,366.8l58.8,112.08a5.59,5.59,0,1,0,9.9-5.19l-58.8-112.08A5.57,5.57,0,0,0,239.4,359.26Z"/><path d="M199,476.29V304.74a5.59,5.59,0,0,0-11.17,0V476.29a5.59,5.59,0,0,0,11.17,0Z"/><path d="M191.75,252.09a5.59,5.59,0,0,0,1.87-.33l1.68-.59a5.59,5.59,0,0,0-3.73-10.53l-1.68.59a5.59,5.59,0,0,0,1.86,10.86Z"/><path d="M413.75,112a5.58,5.58,0,0,0-3.11,7.26l.79,2a5.58,5.58,0,0,0,10.37-4.15l-.79-2A5.58,5.58,0,0,0,413.75,112Z"/><path d="M447.81,207.77a5.59,5.59,0,0,0,2.2.45,5.48,5.48,0,0,0,2.07-.4l27.42-11a5.58,5.58,0,0,0,3.11-7.26L432.17,63.53a5.58,5.58,0,0,0-10.37,4.15l48.36,120.88-17,6.81-23-57.48a5.59,5.59,0,1,0-10.37,4.16l25.07,62.66A5.57,5.57,0,0,0,447.81,207.77Z"/><path d="M57.89,290a5.56,5.56,0,0,0,2.07-.4l50.35-20.14,2.12,5.31a5.6,5.6,0,0,0,5.19,3.51,5.73,5.73,0,0,0,1.86-.32L172,259.43a5.58,5.58,0,1,0-3.72-10.53l-47.42,16.77-2.2-5.5h0l-12.81-32,194.65-87.19a5.59,5.59,0,0,0-4.56-10.2L189,178.61l-6.91-17.46a5.59,5.59,0,1,0-10.39,4.11l7.09,17.92-16.87,7.56-11.63-29.06,49.43-23.15a5.6,5.6,0,0,0,2.82-7.14l-6.12-15.28A5.58,5.58,0,1,0,186,120.26l4.15,10.39-70.36,33-10.06-25.14,67-41.47,1.62,4a5.58,5.58,0,1,0,10.37-4.15l-4.09-10.23A5.58,5.58,0,0,0,176.51,84L99.9,131.44a5.6,5.6,0,0,0-2.25,6.83l14,35a5.6,5.6,0,0,0,5.19,3.51,5.46,5.46,0,0,0,2.37-.53l20.93-9.8,11.56,28.88-55.38,24.8a5.6,5.6,0,0,0-2.9,7.18l12.74,31.83L59.08,278,44.88,264.9,83.3,249.53a5.59,5.59,0,0,0,3.11-7.27L67.52,195a5.59,5.59,0,0,0-7.26-3.11L35.19,202a5.6,5.6,0,0,0-3.12,7.26l9.16,22.89A5.59,5.59,0,1,0,51.6,228l-7.08-17.69,14.7-5.88L74,241.23,32.5,257.82a5.58,5.58,0,0,0-1.71,9.29L54.1,288.57A5.62,5.62,0,0,0,57.89,290Z"/></svg>';
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