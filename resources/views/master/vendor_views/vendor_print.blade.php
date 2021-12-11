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
    <table class="table table-sm table-bordered table-responsive w-100 d-block d-md-table">
        <thead >
            <th>No</th>
            <th>Vendor Code</th>
            <th>Vendor Name</th>
            <th>Vendor Account</th>
            <th>Address</th>
            <th>City</th>
            <th>PHONE</th>
            <th>STATUS</th>
            <th>PIC</th>
            <th>PIC PHONE</th>
            <th>PIC EMAIL</th>
        </thead>
        <tbody>
            @foreach ($vendor as$no=>$vnd)
            <tr>
              <td>{{$no+1}}</td>  
              <td>{{$vnd->vendorcode}}</td>  
              <td>{{$vnd->vendorname}}</td>  
              <td>{{$vnd->account}}</td>  
              <td>{{$vnd->address}}</td>  
              <td>{{$vnd->city}}</td>  
              <td>{{$vnd->phone}}</td>  
              <td>{{$vnd->status}}</td>  
              <td>{{$vnd->pic}}</td>  
              <td>{{$vnd->pic_phone}}</td>  
              <td>{{$vnd->pic_email}}</td>  
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