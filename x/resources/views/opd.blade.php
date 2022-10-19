@extends('index')
@section('title','Server 1')
@section('content')
Total Masuk : <b>{{$tot_absen}}</b> | Total Sudah Pulang : <b>{{$tot_sudah_pulang}}</b> | Total Belum Pulang : <b>{{$tot_belum_pulang}}</b>
    @php $i=1; @endphp
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>Server</th>
        </tr> 
        @foreach($data_absen as $ab)  
            @if($ab['id_admin_instansi'] !== $id_admin)
            @else
            <tr> 
                <td>{{$i++}}</td> 
                <td>{{$ab['nama_lengkap']}}</td>
                <td>{{$ab['timestamp_masuk']}}</td>
                <td @if($ab['timestamp_pulang'] == null) style="background-color:pink" @endif>{{$ab['timestamp_pulang']}}</td> 
                <td>SERVER 1</td>
            </tr> 
            @endif     
        @endforeach
        @foreach($data_absen3 as $ab)  
            @if($ab['id_admin_instansi'] !== $id_admin)
            @else
            <tr> 
                <td>{{$i++}}</td> 
                <td>{{$ab['nama_lengkap']}}</td>
                <td>{{$ab['timestamp_masuk']}}</td>
                <td @if($ab['timestamp_pulang'] == null) style="background-color:pink" @endif>{{$ab['timestamp_pulang']}}</td> 
                <td>SERVER 2</td>
            </tr> 
            @endif     
        @endforeach
        @foreach($data_absen4 as $ab)  
            @if($ab['id_admin_instansi'] !== $id_admin)
            @else
            <tr> 
                <td>{{$i++}}</td> 
                <td>{{$ab['nama_lengkap']}}</td>
                <td>{{$ab['timestamp_masuk']}}</td>
                <td @if($ab['timestamp_pulang'] == null) style="background-color:pink" @endif>{{$ab['timestamp_pulang']}}</td> 
                <td>SERVER 3</td>
            </tr> 
            @endif     
        @endforeach
    </table>  
@endsection