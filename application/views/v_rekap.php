 
 <?php
    //dd($this->session->all_userdata());
    echo "<center><div class='tab-content'>";
    echo "<h5>REKAP ABSENSI</h5>";
    $nowYear = '2021';
    echo form_open(base_url('Rekap_controller/view'), 'target="_blank"', 'hidden');
    echo "<input name='instansi' type='hidden' value='".$this->uri->segment('2')."'>";
    echo "Rekap Bulan : <select name='tahun'>";
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
    echo "<button type='submit'>Tampil</button>";
    echo form_close();
    echo "</div></center>";
