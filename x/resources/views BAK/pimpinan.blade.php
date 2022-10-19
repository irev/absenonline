@extends('index')
@section('title','Pimpinan')
@section('content')
    @php $i=1; @endphp
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>Server</th>
        </tr>
        @foreach($pimpinan->data as $pm) 
            @foreach($absen1 as $ab)
                @if($pm->id_user === $ab['id_user'])
                <tr> 
                    <td>{{$i++}}</td> 
                    <td>{{$pm->nama_lengkap}}</td>
                    <td>{{$ab['timestamp_masuk']}}</td>
                    <td>{{$ab['timestamp_pulang']}}</td> 
                    <td align="center">SERVER 1</td>
                </tr>
                @endif
            @endforeach  
            @foreach($absen2 as $ab)
                @if($pm->id_user === $ab['id_user'])
                <tr> 
                    <td>{{$i++}}</td> 
                    <td>{{$pm->nama_lengkap}}</td>
                    <td>{{$ab['timestamp_masuk']}}</td>
                    <td>{{$ab['timestamp_pulang']}}</td> 
                    <td align="center">SERVER 2</td>
                </tr>
                @endif
            @endforeach  
            @foreach($absen3 as $ab)
                @if($pm->id_user === $ab['id_user'])
                <tr> 
                    <td>{{$i++}}</td> 
                    <td>{{$pm->nama_lengkap}}</td>
                    <td>{{$ab['timestamp_masuk']}}</td>
                    <td>{{$ab['timestamp_pulang']}}</td> 
                    <td align="center">SERVER 3</td>
                </tr>
                @endif
            @endforeach 
        @endforeach
    </table>  
@endsection