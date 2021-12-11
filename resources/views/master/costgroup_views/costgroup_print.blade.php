@extends('layouts.print')
@section('content')

<div class="container">
    <div class="row">
        <img src="{{ asset('images/fastrack-logo.png') }}" alt="logo" />
</div>
<label for="">Fiture Name :</label>
<h6 class="font-weight-bold text-dark">Master - Cost Group</h6>
<label for="">Company :</label>
<h6 class="font-weight-bold text-dark">PT Wahana Datarindo Sempurna</h6>
    <table class="table table-sm table-bordered ">
        <thead style="text-align: center" >
        <tr>
            <th>No</th>
            <th>Code</th>
            <th>Name</th>
            <th>Book Valuation Rate</th>
            <th>Life</th>
            <th>Book Dep</th>
            <th>Book Dep Value</th>
            <th>Tax Dep</th>
            <th>Tax Dep Value</th>
        </tr>
        </thead>
        <tbody style="text-align: center" >
            @foreach ($costgroup_print as $e => $costgroup)    
                <tr>
                    <td>{{$e+1}}</td>
                    <td>{{$costgroup->groupcode}}</td>
                    <td>{{$costgroup->groupname}}</td>
                    <td>{{$costgroup->bookvalrate}}</td>
                    <td>{{$costgroup->life}}</td>
                    <td>{{$costgroup->bookdepreciation}}</td>
                    <td>{{$costgroup->bookdeptrate}}</td>
                    <td>{{$costgroup->taxdepreciation}}</td>
                    <td>{{$costgroup->taxdeprate}}</td>
                   


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