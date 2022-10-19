@extends('index')
@section('title','Server 1')
@section('content')
Total Masuk : <b>{{$tot_absen}}</b> | Total Sudah Pulang : <b>{{$tot_sudah_pulang}}</b> | Total Belum Pulang : <b>{{$tot_belum_pulang}}</b> | Result : <b>{{substr($persen,0,2)}}%</b>
    @php $i=1; @endphp
    <table>
        <tr>
            <th width="5%" align="center">No</th>
            <th width="35%" align="left">Nama</th>
            <th width="15%" align="center">Masuk</th>
            <th width="15%" align="center">Pulang</th>
            <th width="15%" align="center">SSID</th>
        </tr> 
        @foreach($absen as $ab) 
            <tr> 
                <td align="center">{{$i++}}</td> 
                <td>{{$ab['nama_lengkap']}}</td>
                <td align="center">{{$ab['timestamp_masuk']}}</td>
                <td @if($ab['timestamp_pulang'] == null) style="background-color:pink" @endif align="center">   {{$ab['timestamp_pulang']}}  </td> 
                <td  align="left">{{$ab['SSID']}}</td>
            </tr> 
        @endforeach 
    </table>  
    <script>
        
    </script>
@endsection