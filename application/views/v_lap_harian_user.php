<link href="<?php echo base_url(); ?>assets/plugins/calendar/calendarorganizer.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/plugins/calendar/calendarorganizer.min.js"></script>
<?php
// Ambil tanggal dibulan ini
$tgl_awal = date("1");
$tgl_akhir = date("t");
?>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <?php for ($x = $tgl_awal; $x <= $tgl_akhir; $x++):

                    $tgl = date("Y-m-" . sprintf("%02d", $x));
                    $s = date("l", strtotime($tgl));
                    $hari = $this->hitungterlambat->str_indonamahari($s);
                    $tanggal = $this->durasiwaktu->tgl_indo($tgl);
                    $dis = "block";
                    if ($hari === "Sabtu" or $hari === "Minggu") {
                        $dis = "none";
                    }
                    ?>
                <div class="row" style="display:<?= $dis ?>;">
                    <div class="col-md-6 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5><?= $tanggal .
                                                ", " .
                                                $hari ?></h5>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table data-laporan">
                                        <tr>
                                            <th width="20">No</th>
                                            <th width="20">Waktu</th>
                                            <th width="10">Durasi</th>
                                            <th width="20">Status</th>
                                            <th>Kegiatan</th>
                                        </tr>
                                        <?php
                    $no = 1;
                    $times = [];
                    //echo json_encode($laporan);
                    // var_dump($laporan);
                     
                    foreach ($laporan as $data):
                        $tgl_data = $data["tgl"];
                        if($tgl_data == $tgl):
                            if ($data["status"] == 1) {
                                $times[] = $this->durasiwaktu->selisihWaktu(
                                    $data["jammulai"],
                                    $data["jamselesai"]
                                );
                            } ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?php echo substr($data["jammulai"],0, 5); ?> -
                                                <?php echo substr($data["jamselesai"],0,5); ?></td>
                                            <td><?php echo $this->durasiwaktu->selisihWaktu(
                                                    $data["jammulai"],
                                                    $data["jamselesai"]
                                                ); ?> </td>

                                            <td>
                                                <?php //echo $data['status'];
                                                    if (
                                                        $data["status"] == 1
                                                    ): ?>
                                                <a href="#!"
                                                    class="btn drp-icon btn-rounded btn-success dropdown-toggle"
                                                    title="Terima"><i class="feather icon-check-circle"></i></a>
                                                <?php elseif (
                                                        $data["status"] == 2
                                                    ): ?>
                                                <a href="#!" class="btn drp-icon btn-rounded btn-danger dropdown-toggle"
                                                    title="Tolak"><i class="feather icon-slash"></i></a>
                                                <?php elseif (
                                                        $data["status"] == 3
                                                    ): ?>
                                                <a href="#!"
                                                    class="btn drp-icon btn-rounded btn-warning dropdown-toggle"
                                                    title="pengajuan"><i class="feather icon-alert-triangle"></i></a>
                                                <?php else: ?>
                                                <a href="#!"
                                                    class="btn drp-icon btn-rounded btn-secondary dropdown-toggle"
                                                    title="Pengajuan"><i class="feather icon-alert-triangle"></i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $data["rincian_kegiatan"] ?></td>
                                        </tr>
                                        <?php $no++;
                        else:
                           // echo '<br>'.$data["tgl"].' '.$tgl.'</br>';
                        endif; ?>
                                        <?php
                    endforeach;
                    ?>
                                        <tr>
                                            <td>#</td>
                                            <td>Total Jam Kerja</td>
                                            <td colspan="3">
                                                <?= $this->durasiwaktu->SumWaktu($times) ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endfor; ?>


                <div class='tab-content' style="display:none;">
                    <div id="calendarContainer"></div>
                    <div id="organizerContainer"></div>
                </div>
                <?php
 
echo "<center><div class='tab-content'>";
echo "<h5>LAPORAN HARIAN ABSENSI</h5>";
$nowYear = date('Y');
echo form_open(base_url('laporan_harian_controller/view'), 'target="_blank"', 'hidden');
echo "Laporan Harian : <select name='tahun'>";
echo "<option value=" . date('Y') . ">" . date('Y') . "</option>";
for ($y = 2020; $y <= $nowYear; $y++) {
    echo "<option value=" . $y . ">" . $y . "</option>";
}
echo "</select> ";
echo "<select name='bulan'>";
echo "<option value=" . date('m') . ">" . date('F') . "</option>";
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
echo "<select name='date'>";
echo "<option value=" . date('d') . ">" . date('d') . "</option>";
for ($dt = 1; $dt <= 31; $dt++) {
    echo "<option value=" . $dt . ">" . $dt . "</option>";
}
echo "</select> ";
echo "<button type='submit'>Tampil</button>";
echo form_close();
echo "</div></center>";
?>
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