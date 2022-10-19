</body>
<script src="<?php echo base_url(); ?>assets/js/vendor-all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pcoded.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wickedpicker.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->

<!-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--LOCAL CDN -->
<!-- <script src="<?php echo base_url(); ?>assets/js/cdn/jquery-3.5.1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cdn/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cdn/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cdn/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cdn/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cdn/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cdn/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cdn/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cdn/buttons.print.min.js"></script> -->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>

<script>
var options = {
    now: "12:35", //hh:mm 24 hour format only, defaults to current time 
    twentyFour: false, //Display 24 hour format, defaults to false
    upArrow: 'wickedpicker__controls__control-up', //The up arrow class selector to use, for custom CSS 
    downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS 
    close: 'wickedpicker__close', //The close class selector to use, for custom CSS 
    hoverState: 'hover-state', //The hover state class to use, for custom CSS 
    title: 'Timepicker', //The Wickedpicker's title, s
    howSeconds: false, //Whether or not to show seconds, 
    secondsInterval: 1, //Change interval for seconds, defaults to 1 , 
    minutesInterval: 1, //Change interval for minutes, defaults to 1 
    beforeShow: null, //A function to be called before the Wickedpicker is shown 
    show: null, //A function to be called when the Wickedpicker is shown 
    clearable: false, //Make the picker's input clearable (has clickable "x") 
};
$('.timepicker').wickedpicker(options);
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.data-dashboard').DataTable({
        paging: false,
        dom: 'Bfrtip',
        <?php if ($this->session->userdata('id_instansi') == '3050' || $this->session->userdata('id_instansi') == '3048') {
                echo "buttons: ['copy', 'csv', 'excel', 'pdf', 'print']";
            } else {
                echo "buttons: ['pdf', 'print']";
            } ?>
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.data-kehadiran').DataTable({
        paging: false,
        dom: 'Bfrtip',
        <?php if ($this->session->userdata('id_instansi') == '3050' || $this->session->userdata('id_instansi') == '3048') {
                echo "buttons: ['copy', 'csv', 'excel', 'pdf', 'print']";
            } else {
                echo "buttons: ['pdf', 'print']";
            } ?>
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("p.username").css({
        'color': 'transparent',
        'text-shadow': '0 0 9px rgba(0,0,0,5)'
    });
    var instansi = $('.nama_instansi').text();
    $(document).prop('title',
        'Daftar User Absen Online <?php echo $this->session->userdata('nama_instansi'); ?>');
    $('.data-user').DataTable({
        dom: 'Bfrtip',
        <?php if ($this->session->userdata('id_instansi') == '3050' || $this->session->userdata('id_instansi') == '3048') {
                echo "'columnDefs': [
                                { 'type': 'string', 'targets': [0,1,':visible']}
                        ],";
                
                //echo "buttons: ['copy', 'csv', 'excel', 'pdf', 'print']";
                echo "
                'buttons': [
                        {
                            extend: 'copyHtml5',
                            messageTop: instansi,
                            exportOptions: {
                                columns: [ 0,1, ':visible']
                            }
                        },
                        {
                            extend: 'csv',
                            exportOptions: {
                                columns: [ 0,1,':visible' ]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            messageTop: instansi,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            messageTop: instansi,
                            exportOptions: {
                                columns: [ 0,1,':visible' ]
                            }
                        },
                        {
                            extend: 'print',
                            messageTop: '<center>'+instansi+'</center>',
                            exportOptions: {
                                columns: [ 0,1,':visible' ]
                            }
                        },
                        'colvis'
                    ]";
                            
                
            } else {
                echo "buttons: ['pdf', 'print']";
            } ?>,
        paging: false
    });

    $("p.username").on("mouseover", function() {
            $(this).css({
                'color': '#000',
                'text-shadow': '0 0 0 rgba(0,0,0,0)'
            });
        })
        .on("mouseleave", function() {
            $(this).css({
                'color': 'transparent',
                'text-shadow': '0 0 9px rgba(0,0,0,5)'
            });
        }).on("mouseout", function() {
            //$(this).css({'color': '#ddd', 'text-shadow': '0 0 0px rgba(0,70,0,20)'});
        });

});
</script>

<script type="text/javascript">
$(function() {
    $('#datetimepicker3').datetimepicker({
        format: 'LT',

    });
});
</script>

<script type="text/javascript">
//fungsi untuk filtering data berdasarkan tanggal 
var start_date;
var end_date;
var DateFilterFunction = (function(oSettings, aData, iDataIndex) {
    var dateStart = parseDateValue(start_date);
    var dateEnd = parseDateValue(end_date);
    //Kolom tanggal yang akan kita gunakan berada dalam urutan 2, karena dihitung mulai dari 0
    //nama depan = 0
    //nama belakang = 1
    //tanggal terdaftar =2
    var evalDate = parseDateValue(aData[1]);
    if ((isNaN(dateStart) && isNaN(dateEnd)) ||
        (isNaN(dateStart) && evalDate <= dateEnd) ||
        (dateStart <= evalDate && isNaN(dateEnd)) ||
        (dateStart <= evalDate && evalDate <= dateEnd)) {
        return true;
    }
    return false;
});

// fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona waktubrowser
function parseDateValue(rawDate) {
    var dateArray = rawDate.split("/");
    var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[
        0]); // -1 because months are from 0 to 11   
    return parsedDate;
}

$(document).ready(function() {
    //konfigurasi DataTable pada tabel dengan id example dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
    var $dTable = $('#example').DataTable({
        "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchbox'>>>" + "Bfrtip",

        "lengthChange": false,
        "order": [
            [1, "asc"]
        ],

        <?php if ($this->session->userdata('id_instansi') == '3050' || $this->session->userdata('id_instansi') == '3048') {
                echo "buttons: ['copy', 'csv', 'excel', 'pdf', 'print']";
            } else {
                echo "buttons: ['pdf', 'print']";
            } ?>

    });

    //menambahkan daterangepicker di dalam datatables
    $("div.datesearchbox").html(
        '<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Silahkan pilih tanggal"> </div>'
    );

    document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

    //konfigurasi daterangepicker pada input dengan id datesearch
    $('#datesearch').daterangepicker({
        autoUpdateInput: false
        // singleDatePicker: true,
    });

    //menangani proses saat apply date range
    $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
            'YYYY-MM-DD'));
        start_date = picker.startDate.format('DD/MM/YYYY');
        end_date = picker.endDate.format('DD/MM/YYYY');
        $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
        $dTable.draw();
        console.log(' tanggal ' + start_date + parseDateValue(start_date));
        console.info(start_date);
        console.info(end_date);

    });

    $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        start_date = '';
        end_date = '';
        $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
        $dTable.draw();
    });
});
</script>

<script>
$(function() {
    $('#datesearch').daterangepicker({
        opens: 'left'
    }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
            .format('YYYY-MM-DD'));

    });
});
</script>

<script type="text/javascript">
//fungsi untuk filtering data berdasarkan tanggal 
var start_date;
var end_date;
var DateFilterFunction = (function(oSettings, aData, iDataIndex) {
    var dateStart = parseDateValue(start_date);
    var dateEnd = parseDateValue(end_date);
    //Kolom tanggal yang akan kita gunakan berada dalam urutan 2, karena dihitung mulai dari 0
    //nama depan = 0
    //nama belakang = 1
    //tanggal terdaftar =2
    var evalDate = parseDateValue(aData[1]);
    if ((isNaN(dateStart) && isNaN(dateEnd)) ||
        (isNaN(dateStart) && evalDate <= dateEnd) ||
        (dateStart <= evalDate && isNaN(dateEnd)) ||
        (dateStart <= evalDate && evalDate <= dateEnd)) {
        return true;
    }
    return false;
});

// fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona waktubrowser
function parseDateValue(rawDate) {
    var dateArray = rawDate.split("/");
    var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[
        0]); // -1 because months are from 0 to 11   
    return parsedDate;
}

$(document).ready(function() {
    //konfigurasi DataTable pada tabel dengan id example dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
    var $dTable = $('#ijin').DataTable({
        "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchboxijin'>>>" + "Bfrtip",

        "lengthChange": false,
        "order": [
            [1, "asc"]
        ],

        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']

    });

    //menambahkan daterangepicker di dalam datatables
    $("div.datesearchboxijin").html(
        '<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearchijin" placeholder="Silahkan pilih tanggal"> </div>'
    );

    document.getElementsByClassName("datesearchboxijin")[0].style.textAlign = "right";

    //konfigurasi daterangepicker pada input dengan id datesearch
    $('#datesearchijin').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
    });

    //menangani proses saat apply date range
    $('#datesearchijin').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
            'DD/MM/YYYY'));
        start_date = picker.startDate.format('DD/MM/YYYY');
        end_date = picker.endDate.format('DD/MM/YYYY');
        $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
        $dTable.draw();
    });

    $('#datesearchijin').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        start_date = '';
        end_date = '';
        $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
        $dTable.draw();
    });
});
</script>

<script type="text/javascript">
//fungsi untuk filtering data berdasarkan tanggal 
var start_date;
var end_date;
var DateFilterFunction = (function(oSettings, aData, iDataIndex) {
    var dateStart = parseDateValue(start_date);
    var dateEnd = parseDateValue(end_date);
    //Kolom tanggal yang akan kita gunakan berada dalam urutan 2, karena dihitung mulai dari 0
    //nama depan = 0
    //nama belakang = 1
    //tanggal terdaftar =2
    var evalDate = parseDateValue(aData[1]);
    if ((isNaN(dateStart) && isNaN(dateEnd)) ||
        (isNaN(dateStart) && evalDate <= dateEnd) ||
        (dateStart <= evalDate && isNaN(dateEnd)) ||
        (dateStart <= evalDate && evalDate <= dateEnd)) {
        return true;
    }
    return false;
});

// fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
function parseDateValue(rawDate) {
    var dateArray = rawDate.split("/");
    var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[
        0]); // -1 because months are from 0 to 11   
    return parsedDate;
}

$(document).ready(function() {
    //konfigurasi DataTable pada tabel dengan id example dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
    var $dTable = $('#kehadiran').DataTable({
        "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchboxkehadiran'>>>" + "Bfrtip",

        "lengthChange": false,
        "order": [
            [1, "asc"]
        ],

        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']

    });

    //menambahkan daterangepicker di dalam datatables
    $("div.datesearchboxkehadiran").html(
        '<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearchkehadiran" placeholder="Silahkan pilih tanggal"> </div>'
    );

    document.getElementsByClassName("datesearchboxkehadiran")[0].style.textAlign = "right";

    //konfigurasi daterangepicker pada input dengan id datesearch
    $('#datesearchkehadiran').daterangepicker({
        autoUpdateInput: false,

    });

    //menangani proses saat apply date range
    $('#datesearchkehadiran').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
            'DD/MM/YYYY'));
        start_date = picker.startDate.format('DD/MM/YYYY');
        end_date = picker.endDate.format('DD/MM/YYYY');
        $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
        $dTable.draw();

    });

    $('#datesearchkehadiran').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        start_date = '';
        end_date = '';
        $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
        $dTable.draw();
    });
});
</script>



<script>
function delete_item(url, id, message) {
    swal({
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function(willDelete) {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>" + url,
                    data: {
                        id
                    },
                    success: function(response) {
                        console.log(response);
                        console.log(response.status);
                        if (response.status == 'true') {
                            swal("Device ID berhasil di hapus! ", {
                                icon: "success",
                            });
                        } else {
                            console.log(response);
                            swal('data gagal di hapus', 'Data tidak ditemukan!');
                        }

                    },
                    error: function(response) {
                        console.log(response);
                        swal('data gagal di hapus', 'error');
                    }
                });
            }
        },
        function(dismiss) {
            if (dismiss === "cancel") {
                swal(
                    "Cancelled",
                    "Canceled Note",
                    "error"
                )
            }
        });
};
</script>

<script>
function laporan_user(url, id, message) {
    var data = {
        'id': id,
    };
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>" + url,
        data: data,
        success: function(response) {


        }
    });
};
</script>

<!-- Script -->
<script type="text/javascript">
$(document).ready(function() {
    $('#empTable').DataTable({
        "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchboxkehadiran'>>>" + "Bfrtip",

        'lengthChange': false,
        'order': [
            [1, "asc"]
        ],
        'buttons': ['copy', 'csv', 'excel', 'pdf', 'print'],
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?=base_url()?>index.php/kehadiran_controllers/empList'
        },
        'columns': [{
                data: 'nama_lengkap'
            },
            {
                data: 'tgl_absen'
            },
            {
                data: 'timestamp_masuk'
            },
            {
                data: 'timestamp_pulang'
            },
            {
                data: 'status'
            },
        ]
    });
});
</script>

<?php if($this->uri->segment(1) == 'buatabsen_controller'): ?>
    <script type="text/javascript">
    $.fn.pernyataan = function() {
        this.html('<p><input type="checkbox" name="pernyataan" value="ya"><label for="pernyataan">  Data diatas sudah benar.</label><br></p>');
    };

    $(document).ready(function() {
        $(".add_form").click(function() {
            var tr_rand = 'tr-'+Math.floor(Math.random() * 500)+Math.floor(Math.random() * 200);
            var rowCount = $('#form-sementara>tbody>tr').length;
            var textUsername = $('#select-username option:selected').text();
            var textStatus = $('#select-status option:selected').text();
            var values = $('#form-master').serializeArray();
            console.log(values);
            if (values[0].value != '' && values[1].value != '' && values[3].value != '') {
                $(".form-sementara").append(
                    '<tr id="'+tr_rand+'"><td scope="row">' + textUsername +
                    '<input type="hidden" name="nama[]" value="' + values[0]
                    .value +
                    '"><input type="hidden" name="nama_panjang[]" value="' + textUsername +
                    '"></td><td>' + textStatus + '<input type="hidden" name="status[]"  value="' +
                    values[1]
                    .value +
                    '"/></td><td>'+values[2].value+'<input type="hidden" name="tanggal[]"  value="' + values[2].value +
                    '"/></td><td>'+values[3].value+'<input type="hidden" name="jam[]"  value="' + values[3].value +
                    '"/></td><td><a href="javascript:void(0);" class="remove" onclick="removeThis(\''+tr_rand+'\');">hapus</a></td></tr>'
                );
                $('#form-master').trigger("reset");
            }
            countTR();
            btnPosting();
        });
        
        $("form#form-multiple").submit(function (event) {
            $('#posting').html('Prosess');
            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>buatabsen_controller/PengajuanCreate/<?= $this->input->post("idx"); ?>',
                data: $('#form-multiple').serialize(),
                dataType: 'json',
                //encode: true,
                //success: 'success'
            }).done(function (data) {
            console.log(data);
            if(data.success == true){
                alert('Data berhasil diposting !');
                    windows.reload();
            }else{
                    countTR();
                    btnPosting();
            }
            });
        event.preventDefault();
        });
        
        $('#checkbox-done').click(function () {
            //console.log('#checkbox-done click');
            btnPosting();
        });
    });

    var removeThis = function(id) {
            console.log(id);
            element = document.getElementById(id).remove();
            countTR();
            btnPosting();
            return element;
    }

    var countTR = function() {
        var trCount = document.getElementById("form-sementara");
        console.log(trCount.rows.length);
        var trTot = trCount.rows.length;
        if(trTot >= 2){
            $("#check-box").html('<div class="col-sm-12 alert alert-warning" ><input type="checkbox" id="checkbox-done" onclick="btnPosting()" name="pernyataan" value="ya"><label for="pernyataan">  Data diatas sudah benar.</label><br></div>');
            $("#jumlah-form").html(trTot-1);
        }else{
            $("#check-box").html('');
            $("tfoot").html('');
            $("#jumlah-form").html(0);
        }
        return trCount.rows.length;
    }

    var btnPosting = function(params) {
        if($('#checkbox-done').prop("checked")){
            $('#button-postinng').html('<button type="submit" id="posting" class="btn btn-sm btn-primary" >Posting Absen</button>');
        }else{
            $('#button-postinng').html('');
        }    
    }
    </script>
<?php endif; ?>

<?php if(($this->uri->segment(1) == 'admin') && ($this->uri->segment(2) == 'admin_absen_manual_controller')): ?>
    <script type="text/javascript">
    // admin_absen_manual_controller
    $("form#form-multiple").submit(function (event) {
      $('#button-proses').html('Proses...');
            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>admin/admin_absen_manual_controller/AbsenManualCreate/<?= $this->input->post("idx"); ?>',
                data: $('#form-multiple').serialize(),
                dataType: 'json',
                //encode: true,
                //success: 'success'
            }).done(function (data) {
            console.log(data);
            if(data.success == true){
                alert('Data berhasil diposting !');
                    window.location.replace('<?= base_url('admin/admin_absen_manual_controller/view/').$this->uri->segment('4').'/'.$this->uri->segment('5') ?>');
            }else{
                    countTR();
                    btnPosting();
            }
            });
        event.preventDefault();
    });
    var checkboxAll = function(params) {
        if($('#checkbox-all').prop("checked")){
            $('.checkbox').prop("checked", true);
        }else{
            $('.checkbox').prop("checked", false);
        } 
        countCheckboxs(); 
    }
    var countCheckboxs = function(params) {
        var numberOfChecked = $('input.checkboxs:checked').length;
        var totalCheckboxes = $('input.checkboxs').length;
        if(numberOfChecked < 1 || numberOfChecked == 0){
            $('input:checkbox').prop("checked", false);
            $('label.checkbox').text(' Pilih Semua ');
            $('#button-proses').html('<td></td>');
            $('#info-proses').html('');
        }else{
            $('label.checkbox').text(' Hapus Semua ');
            $('#info-proses').html('<td colspan="5" class="alert alert-info"><input type="checkbox" onclick="checkboxInfo()" class="checkbox-info" id="checkbox-info"> Data diatas sudah benar ?</td>');
        }
    }
    var checkboxInfo = function(params) {
        if($('input#checkbox-info').prop("checked")){
            $('#button-proses').html('<td colspan="5"><button class="btn btn-primary" type="submit">Proses</button></td>');
        }else{
            $('#button-proses').html('.');
        }
        console.log('checkbox-info');
    }
    $('input#checkbox-info').click(function() {
        console.log('checkbox-info');
        checkboxInfo();
    });
    $('input.checkboxs').click(function() {
        countCheckboxs();
    });
    $('#checkbox-all').click(function () {
            console.log('#checkbox-all click');
            checkboxInfo();
            checkboxAll();
    });
    </script>
<?php endif; ?>


<script>
    $('.dataTable').DataTable();
</script>


<!-- <script>
function hapus_data() {
    swal({
            title: "Hapus Device ID?",
            
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Device ID berhasil dihapus", {
                    icon: "success",
                });
            } else {
                swal("Device ID gagal dihapus!");
            }
        });
}
</script> -->