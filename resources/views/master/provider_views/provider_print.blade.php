@extends('layouts.print')
@section('content')

<div class="container">
    <div class="row">
        <img src="{{ asset('images/fastrack-logo.png') }}" alt="logo" />
</div>
<label for="">Fiture Name :</label>
<h6 class="font-weight-bold text-dark">Master - Service Provider</h6>
<label for="">Company :</label>
<h6 class="font-weight-bold text-dark">PT Wahana Datarindo Sempurna</h6>
    <table class="table table-sm table-bordered ">
        <thead style="text-align: center" >
            <tr>
                <th>No</th>
                <th>Provider Code</th>
                <th>Provider Name</th>
                <th>Contact</th>
                <th>Address</th>
                <th>OpeningDate</th>
                <th>City</th>
                <th>Postal</th>
                <th>Phone</th>
                <th>Fax</th>
            </tr>
        </thead>
        <tbody style="text-align: center" >
            @foreach ($provider_print as $e => $provider)    
                <tr>
                    <td>{{$e+1}}</td>
                    <td>{{$provider->providercode}}</td>
                    <td>{{$provider->providername}}</td>
                    <td>{{$provider->contact}}</td>
                    <td>{{$provider->address}}</td>
                    <td>{{$provider->OpeningDate}}</td>
                    <td>{{$provider->city}}</td>
                    <td>{{$provider->postal}}</td>
                    <td>{{$provider->phone}}</td>
                    <td>{{$provider->fax}}</td>
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