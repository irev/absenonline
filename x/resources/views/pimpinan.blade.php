@extends('index')
@section('title','Pimpinan')
@section('content')
    @php $i=1; @endphp
    <table>
        <tr>
            <th width="5%" align="center">No</th>
            <th width="35%" align="left">Nama</th>
            <th width="15%" align="center">Masuk</th>
            <th width="15%" align="center">Pulang</th>
            <th width="15%">Server</th>
        </tr>
        @foreach($pimpinan->data as $pm) 
            @foreach($absen1 as $ab)
                @if($pm->id_user === $ab['id_user'])
                <tr> 
                    <td align="center">{{$i++}}</td> 
                    <td>{{$ab['nama_lengkap']}}</td>
                    <td align="center">{{$ab['timestamp_masuk']}}</td>
                    <td @if($ab['timestamp_pulang'] == null) style="background-color:pink" @endif align="center">{{$ab['timestamp_pulang']}}</td> 
                    <td align="center">SERVER 1</td>
                </tr>
                @endif
            @endforeach  
            
            @foreach($absen2 as $ab2)
                @if($pm->id_user === $ab2['id_user'])
                    <tr> 
                        <td align="center">{{$i++}}</td> 
                        <td>{{$ab2['nama_lengkap']}}</td>
                        <td align="center">{{$ab2['timestamp_masuk']}}</td>
                        <td @if($ab['timestamp_pulang'] == null) style="background-color:pink" @endif align="center">{{$ab2['timestamp_pulang']}}</td> 
                        <td align="center">SERVER 2</td>
                    </tr>
                @endif
            @endforeach 
            
            @foreach($absen3 as $ab3)
                @if($pm->id_user === $ab3['id_user'])
                    <tr> 
                        <td align="center">{{$i++}}</td> 
                        <td>{{$ab3['nama_lengkap']}}</td>
                        <td align="center">{{$ab3['timestamp_masuk']}}</td>
                        <td @if($ab['timestamp_pulang'] == null) style="background-color:pink" @endif align="center">{{$ab3['timestamp_pulang']}}</td> 
                        <td align="center">SERVER 3</td>
                    </tr>
                @endif
            @endforeach 
        @endforeach
    </table>  
@endsection