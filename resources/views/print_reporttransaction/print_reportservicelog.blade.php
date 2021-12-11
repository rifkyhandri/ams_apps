@extends('layouts.print')
@section('content')

<div class="container">
<div class="row">
        <img src="{{ asset('images/fastrack-logo.png') }}" alt="logo" />
</div>
<label for="">Transaction Name :</label>
<h6 class="font-weight-bold text-danger">Service Log</h6>
<label for="">Company :</label>
<h6 class="font-weight-bold text-danger">PT Wahana Datarindo Sempurna</h6>

    <table class="table table-sm table-bordered ">
        <thead style="text-align: center" >
        <tr>
           <th>No</th>
           <th>Asset Code</th>
           <th>Description</th>
           <th>Service Date</th>
           <th>Service Cost</th>
           <th>Service Provider</th>
           <th>Next Service</th>
           <th>Note</th>

        </tr>
        </thead>
        <tbody style="text-align: center" >
            @foreach ($service as $e => $srv)    
                <tr>
                    <td>{{$e+1}}</td>
                    <td>{{$srv->tangnumber}}</td>
                    <td>{{$srv->asset->assetname}}</td>
                    <td>{{$srv->servicedate}}</td>
                    <td>{{$srv->costservice}}</td>
                    <td>{{$srv->asset->objprovider->providername}}</td>
                    <td>{{$srv->nextservice}}</td>
                    <td>{{$srv->notes}}</td>
            
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="h6 font-weight-bold text-dark" style="margin-left: 80%;margin-top: 40px" >Tanda tangan</div>
        <img class="ttd" src="{{ asset('images/tandatangan.png') }}" alt="logo" style="height: 100px;margin-top: 20px"/>
        <div class="h6 font-weight-bold text-dark mt-5" style="margin-left: 80%" >{{Auth::user()->name}} ( WADAS )</div>
    </div>
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
     img  {
      max-width : 400px;
      height : auto;
      margin-bottom: -4%;
      margin-top: -3%;
      margin-left: 38%;
     }
     .ttd {
         max-width: 200px;
         margin-left: 79%;
     }
 }



</style>
@endsection