<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 
    <style type="text/css">
              .display{display:block;}
              .hide{display:none;} 
       </style>
</head>
<body>
<?php $i=1; $semua = 'semua'; ?> 
  <div class="row">
    <div class="col-sm-3"> 
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link text-uppercase text-start " id="v-<?=$semua?>-tab"  data-bs-toggle="pill" data-bs-target="#v-<?=$semua?>" type="button" role="tab" aria-controls="v-<?=$semua?>" aria-selected="true">Semua</button> 
                
            @foreach($admin->data as $instansi) 
                @if($instansi->nama_instansi !== 'Kabupaten Pasaman Barat')  
                    <button class="nav-link text-uppercase text-start item" title="{{$instansi->id_user}}"  id="v-{{$instansi->id_user}}-tab"  data-bs-toggle="pill" data-bs-target="#v-{{$instansi->id_user}}" type="button" role="tab" aria-controls="v-{{$instansi->id_user}}" aria-selected="true">{{$instansi->nama_instansi}}</button> 
                
                    <script type="text/javascript">
                        function ShowAndHideDiv{{$instansi->id_user}}(obj, s) {
                                var element = document.getElementById(obj);
                                if (element.className == "display") { 
                                    if (s == "show") {
                                            element.className = "col-sm-4 display";
                                    }else {
                                            element.className = "hide";
                                    }
                                }else if (element.className != "{{$instansi->id_user}}") {
                                    if (s == "show") {
                                                    element.className = "hide";
                                    } 
                                }else {  
                                    if (s == "hide") {
                                                    element.className = "hide";
                                            }
                                    else {
                                                element.className = "col-sm-4 display";
                                    }
                                }}
                                </script>
                @endif
            @endforeach 
        </div>    
    </div>
    <div class="col-sm-5">
        @if($semua)
        <div class="tab-content" id="v-pills-tabContent">  
            <div class="tab-pane fade show" id="v-<?=$semua?>" role="tabpanel" aria-labelledby="v-<?=$semua?>-tab" tabindex="0">
                    hallo
            </div>
        </div>
        @endif
        <div class="tab-content" id="v-pills-tabContent"> 
        <?php $nomor = $instansi->id_user.'nomor'; $nomor=1;?> 
                @foreach($admin->data as $instansi) 
                <div class="tab-pane fade show" id="v-{{$instansi->id_user}}" role="tabpanel" aria-labelledby="v-{{$instansi->id_user}}-tab" tabindex="0">
                ID Admin : <b>{{$instansi->id_user}}</b> | Total Masuk : <b>{{$tot_absen}}</b> | Total Sudah Pulang : <b>{{$tot_sudah_pulang}}</b> | Total Belum Pulang : <b>{{$tot_belum_pulang}}</b> 
                    <table class="table table-striped">  
                        <thead>
                            <th align="left" width="5%">No</th>
                            <th align="left" width="40%">Nama</th>
                            <th align="left" width="20%">Jam Masuk</th>
                            <th align="left" width="20%">Jam Pulang</th>
                        </thead>  
                        @foreach($data_absen as $datas)    
                            @if($datas['id_admin_instansi'] === $instansi->id_user)      
                            <tbody> 
                                <tr> 
                                <td align="center">{{$nomor}}</td>
                                <td align="left">{{$datas['nama_lengkap']}}</td>
                                <td>{{$datas['timestamp_masuk']}}</td>
                                @if($datas['timestamp_pulang']=='')
                                    <td style="background-color:red"></td> 
                                @else
                                    <td>{{$datas['timestamp_pulang'] }}</td> 
                                @endif
                                </tr>
                            </tbody>  
                            @endif 
                        @endforeach 
                        </table> 
                    </div>
                @endforeach 
        </div> 
        
    </div> 
    @foreach($admin->data as $instansi)  
        <div class="hide"  id="divId{{$instansi->id_user}}"> 
            @foreach($data_absen as $datas)   
                @if($datas['id_admin_instansi'] === $instansi->id_user)            
                        {{$instansi->id_user}} 
                @else
                 
                @endif 

            @endforeach 
        </div>  
    @endforeach         




    <div class="col-sm-5 p-4 table-responsive">
    Total Masuk : <b>{{$tot_absen}}</b> | Total Sudah Pulang : <b>{{$tot_sudah_pulang}}</b> | Total Belum Pulang : <b>{{$tot_belum_pulang}}</b>
            <table class="table table-striped">
                <thead>
                    <th align="left" width="5%">No</th>
                    <th align="left" width="40%">Nama</th>
                    <th align="left" width="20%">Jam Masuk</th>
                    <th align="left" width="20%">Jam Pulang</th>
                </thead>
                <?php $i=1; ?>
                @foreach($data_absen as $datas) 
                <tbody> 
                    <tr> 
                    <td align="center">{{$i++;}}</td>
                    <td align="left">{{$datas['nama_lengkap']}}</td>
                    <td>{{$datas['timestamp_masuk']}}</td>
                    @if($datas['timestamp_pulang']=='')
                        <td style="background-color:red"></td> 
                    @else
                        <td>{{$datas['timestamp_pulang'] }}</td> 
                    @endif
                    </tr>
                </tbody>
                @endforeach
                <tfoot>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                </tfoot>
            </table>
    </div>
    <div class="col-sm-7 p-4 table-responsive">
    <table class="table table-striped">
                <thead>
                    <th align="left" width="5%">No</th>
                    <th align="left" width="50%">Nama OPD</th> 
                    <th align="left" width="50%">Total</th> 
                </thead>
                <?php $j=1; ?>
                @foreach($admin->data as $datas) 
                    @if($datas->nama_instansi !== 'Kabupaten Pasaman Barat')
                    <tbody> 
                        <tr> 
                            <td align="center">{{$j++;}}</td>
                            <td align="left"><{{$datas->nama_instansi}}</td>
                            <td align="left">{{$datas->id_user}}</td>  
                        </tr>
                    </tbody>
                    @endif
                @endforeach 
                <tfoot>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                </tfoot>
            </table>
    </div> 
  </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
