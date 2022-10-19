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
    @foreach ($admin->data as $row)   
            <tr> 
                <td>{{$i++}}</td>  
                <td><a href="{{url('opd/'.$row->id_user)}}" style="text-transform: uppercase">{{$row->nama_instansi}}</a></td>
                <td> 
                </td>  
             </tr>   
    @endforeach 
    </table>  
@endsection
<!-- style="text-transform: uppercase" -->