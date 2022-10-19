@extends('index')
@section('title','Home')
@section('content') 
    @php $i=1; @endphp
    <table>
        <tr>
            <th>No</th>
            <th>Nama Instansi</th> 
            <th>Total Absen</th> 
        </tr> 
        @foreach($admin->data as $ad) 
            @if($ad->no < 31 || $ad->no==67 || $ad->no==69 || $ad->no==68 || $ad->no==72)
                @if($ad->nama_instansi > 1)
                <tr> 
                    <td>{{$i++}}</td>  
                    <td style="text-transform: uppercase">2</td>
                    <td></td>  
                </tr> 
                @else
                <tr> 
                    <td>{{$i++}}</td>  
                    <td style="text-transform: uppercase">{{$ad->nama_instansi}}</td>
                    <td></td>  
                </tr> 
                @endif
            @else 
            @endif 
        @endforeach 
    </table>  
@endsection