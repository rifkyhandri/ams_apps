@extends('layouts.print')
@section('content')

<div class="container">
    <div class="row">
        <img src="{{ asset('images/fastrack-logo.png') }}" alt="logo" />
</div>
<label for="">Fiture Name :</label>
<h6 class="font-weight-bold text-dark">Master - Custodian</h6>
<label for="">Company :</label>
<h6 class="font-weight-bold text-dark">PT Wahana Datarindo Sempurna</h6>
    <table class="table table-sm table-bordered ">
        <thead style="text-align: center" >
            <tr>
                <th>No</th>
                <th>Custodian Code</th>
                <th>Custodian Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>usertype</th>
                <th>company</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody style="text-align: center" >
            @foreach ($custodian_print as $e => $custodian)    
                <tr>
                    <td>{{$e+1}}</td>
                    <td>{{$custodian->custodiancode}}</td>
                    <td>{{$custodian->custodianname}}</td>
                    <td>{{$custodian->phone}}</td>
                    <td>{{$custodian->email}}</td>
                    <td>{{$custodian->usertype}}</td>
                    <td>{{$custodian->company}}</td>
                    <td>{{$custodian->status}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</div>

<style type = "text/css">

    @media screen {
       p.bodyText {font-family:verdana, arial, sans-serif;}
    }

    @media print {
       p.bodyText {font-family:georgia, times, serif;}
    }
    @media screen, print {
     img {
      max-width : 400px;
      height : auto;
      margin-bottom: -4%;
      margin-top: -3%;
      margin-left: 38%;
     }
     
 }
</style>
@endsection