@extends('layouts.print')
@section('content')
<div class="container">
    <div class="row">
        <img src="{{ asset('images/fastrack-logo.png') }}" alt="logo" />
</div>
<label for="">Fiture Name :</label>
<h6 class="font-weight-bold text-dark">Master - Location|Location List</h6>
<label for="">Company :</label>
<h6 class="font-weight-bold text-dark">PT Wahana Datarindo Sempurna</h6>
    <table class="table table-sm table-bordered ">
        <thead style="text-align: center" >
        <tr>
           <th>No</th>
           <th>Location Code</th>
           <th>Location Name</th>
           <th>SubLocation</th>
           <th>SmallLocation</th>
           <th>No.Telp</th>
        </tr>
        </thead>
        <tbody style="text-align: center" >
            @foreach ($location as $e => $loc) 
                <tr>
                    {{-- bigLocation --}}
                    <td>{{$e+1}}</td>
                    <td>{{$loc->locationcode}}</td>
                    <td>{{$loc->locationname}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    

                            {{-- Sub Location --}}
                            @foreach ($location_sub as $loc_sub) 
                            @if($loc_sub->locationcode_big === $loc->id)
                                <tr>
                                    <td><i style="color: blue;font-weight: bold;text-decoration: none;font-style: normal;font-size: 10px">SUB</i></td>
                                    <td></td>
                                    <td><i style="color: blue">#</i>{{$loc_sub->locationcode_sub}}</td>
                                    <td><i style="color: blue">#</i>{{$loc_sub->locationname_sub}}</td>
                                    <td></td>
                                    <td><i style="color: blue">#</i>{{$loc_sub->phone}}</td>
                                   
                            

                                         {{-- Small Location --}}
                                         @foreach ($location_sm as $loc_sm)  
                                         @if($loc_sm->locationcode_big === $loc->id && $loc_sm->locationcode_sub === $loc_sub->id)  
                                            <tr>
                                                <td><i style="color: red;font-weight: bold;text-decoration: none;font-style: normal;font-size: 10px">SM</i></td>
                                                <td></td>
                                                <td></td>
                                                <td><i style="color: red">*</i>{{$loc_sm->locationcode_sm}}</td>
                                                <td><i style="color: red">*</i>{{$loc_sm->locationname_sm}}</td>
                                                <td><i style="color: red">*</i>{{$loc_sm->phone}}</td>
                                            </tr>
                                        @endif
                                        @endforeach
                                   
                                </tr>
                            @endif
                            @endforeach
                  
                </tr>
            @endforeach 
        </tbody>
    </table>
    <script>
        window.print();
    </script>
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
</div>
@endsection