@extends('layouts.print')
@section('content')

<div class="container">
    <div class="row">
        <img src="{{ asset('images/fastrack-logo.png') }}" alt="logo" />
</div>
<label for="">Fiture Name :</label>
<h6 class="font-weight-bold text-dark">Master - Account Chart</h6>
<label for="">Company :</label>
<h6 class="font-weight-bold text-dark">PT Wahana Datarindo Sempurna</h6>
    <table class="table table-sm table-bordered ">
        <thead style="text-align: center" >
        <tr>
           <th>No</th>
           <th>Account No</th>
           <th>Account Name</th>
           <th>Account Short Name</th>
           <th>Old Account</th>
           <th>Subs Group</th>
           <th>Type</th>
           <th>Level</th>
           <th>Status</th>
        </tr>
        
        </thead>
        <tbody style="text-align: center" >
            @foreach ($print_accountchart as $e=>$count)      
                <tr>
                    <td>{{$e+1}}</td>
                    <td>{{$count->accountno}}</td>   
                    <td>{{$count->accountname}}</td>   
                    <td>{{$count->accountshortname}}</td>   
                    <td>{{$count->accountgroup}}</td>   
                    <td>{{$count->oldaccount}}</td>   
                    <td>{{$count->subgroup}}</td>   
                    <td>{{$count->level}}</td>   
                    <td>{{$count->status}}</td>   
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