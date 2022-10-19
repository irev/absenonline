<link href="<?php echo base_url(); ?>assets/plugins/calendar/calendarorganizer.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/plugins/calendar/calendarorganizer.min.js"></script>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="row">
                    <pre>
                   <?php
                   //var_dump($laporan);
                   //var_dump($daftar_user);
                   
                   ?></pre>
                    <div class="col-xl-12 col-md-12 m-b-30">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Laporan Harian</a>

                            </li>
                            <!--li class="nav-item">
                                            <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Kehadiran</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Ijin</a>
                                        </li-->
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover data-laporan">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($daftar_user as $data): ?>
                                            <tr class="unread" id="<?php echo $data['id_user']; ?>">
                                                <td>
                                                    <h6 class="m-0"><img class="rounded-circle  m-r-10"
                                                            style="width:40px;"
                                                            src="<?php echo base_url() ?>assets/images/user/avatar-2.jpg"
                                                            alt="activity-user"><?php echo $data['nama_lengkap']; ?>
                                                    </h6>
                                                </td>
                                                <td><a href="<?=base_url('laporan_harian_controller').'/view/'. $data['username'].'/'.$data['id_user'] ?>"
                                                        class="btn btn-primary"><i class="feather icon-eye"></i>
                                                        Rincian</a></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='tab-content' style="display:none;">
                    <div id="calendarContainer"></div>
                    <div id="organizerContainer"></div>
                </div>
                <?php
                //dd($this->session->all_userdata());
                // echo "<center><div class='tab-content'>";
                // echo "<h5>LAPORAN HARIAN ABSENSI</h5>";
                // $nowYear = date('Y');
                // echo form_open(base_url('laporan_harian_controller/view'), 'target="_blank"', 'hidden');
                // echo "Laporan Harian : <select name='tahun'>";
                // echo "<option value=" . date('Y') . ">" . date('Y') . "</option>";
                // for ($y = 2020; $y <= $nowYear; $y++) {
                //     echo "<option value=" . $y . ">" . $y . "</option>";
                // }
                // echo "</select> ";
                // echo "<select name='bulan'>";
                // echo "<option value=" . date('m') . ">" . date('F') . "</option>";
                // for ($y = 1; $y <= 12; $y++) {
                //     switch ($y) {
                //         case '1':
                //             $bln = 'Januari';
                //             break;
                //         case '2':
                //             $bln = 'Februari';
                //             break;
                //         case '3':
                //             $bln = 'Maret';
                //             break;
                //         case '4':
                //             $bln = 'April';
                //             break;
                //         case '5':
                //             $bln = 'Mei';
                //             break;
                //         case '6':
                //             $bln = 'Juni';
                //             break;
                //         case '7':
                //             $bln = 'Juli';
                //             break;
                //         case '8':
                //             $bln = 'Agustus';
                //             break;
                //         case '9':
                //             $bln = 'September';
                //             break;
                //         case '10':
                //             $bln = 'Oktober';
                //             break;
                //         case '11':
                //             $bln = 'November';
                //             break;
                //         case '12':
                //             $bln = 'Desember';
                //             break;
                //         default:
                //             $bln = date('M');
                //             break;
                //     }
                //     echo "<option value=" . $y . ">" . $bln . "</option>";
                // }
                // echo "</select> ";

                // $nowYear = date('Y');
                // $first_day_this_month = date('01'); // hard-coded '01' for first day
                // $last_day_this_month  = date('m-t-Y');
                // $last_day_this_month_day_only = explode("-", $last_day_this_month);
                // echo "<select name='date'>";
                // echo "<option value=" . date('d') . ">" . date('d') . "</option>";
                // for ($dt = 1; $dt <= 31; $dt++) {
                //     echo "<option value=" . $dt . ">" . $dt . "</option>";
                // }
                // echo "</select> ";
                // echo "<button type='submit'>Tampil</button>";
                // echo form_close();
                // echo "</div></center>";
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