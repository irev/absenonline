@extends('index')
@section('title','Server 3')
@section('content')
Total Masuk : <b>{{$tot_absen}}</b> | Total Sudah Pulang : <b>{{$tot_sudah_pulang}}</b> | Total Belum Pulang : <b>{{$tot_belum_pulang}}</b>
    @php $i=1; @endphp
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Masuk</th>
            <th>Pulang</th>
        </tr> 
        @foreach($absen as $ab) 
            <tr> 
                <td>{{$i++}}</td> 
                <td>{{$ab['nama_lengkap']}}</td>
                <td>{{$ab['timestamp_masuk']}}</td>
                <td @if($ab['timestamp_pulang'] == null) style="background-color:pink" @endif>{{$ab['timestamp_pulang']}}</td> 
            </tr> 
        @endforeach 
    </table>  
@endsection