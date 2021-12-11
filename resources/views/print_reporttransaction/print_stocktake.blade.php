@extends('layouts.print')
@section('content')

<div class="container">
    <div class="row">
        <img s class="logo" src="{{ asset('images/fastrack-logo.png') }}" alt="logo" />
    </div>
<label for="">Transaction Name :</label>
<h6 class="font-weight-bold text-danger">Stock take</h6>
<label for="">Company :</label>
<h6 class="font-weight-bold text-danger">PT Wahana Datarindo Sempurna</h6>
    <table class="table table-sm table-bordered ">
        <thead style="text-align: center" >
        <tr>
           <th>No</th>
           <th>Asset Code</th>
           <th>Serial</th>
           <th>Asset Name</th>
           <th>Departement</th>
           <th>Location</th>
           <th>Transaction date</th>
           <th>Approver</th>
           <th>Change Stock Opname</th>
           <th>Condition</th>

        </tr>
        </thead>
        <tbody style="text-align: center" >
            @foreach ($stock_take as $e => $stock)    
                <tr>
                    <td>{{$e+1}}</td>
                    <td>{{$stock->tangnumber}}</td>
                    <td>{{$stock->approveasset->serial}}</td>
                    <td>{{$stock->approveasset->assetname}}</td>
                    <td>{{$stock->approveasset->objdepartement->departementdesc}}</td>
                    <td>{{$stock->approveasset->objlocation->locationname_sm}}</td>
                    <td>{{$stock->transaction_date}}</td>
                    <td>{{$stock->approver}}</td>
                    <td>{{$stock->change_stock_opname}}</td>
                    <td>{{$stock->approvecondition->conditiondesc}}</td>
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