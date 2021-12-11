@extends('layouts.dashboard')
@section('content')
@include('layouts.css_custom')
@section('link')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
@stop

    <div class="font-weight-bold  h2" style="font-family:'Oswald', sans-serif;color: black">Audit Trail</div>
    <div class="text-dark h5 mb-3">Monitor any changes made to your project,schema with <span class="font-weight-bold">Audit Trail</span> </div>
    
    
   
      <div class="row">
        <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin mt-3">
            <div class="card" style="border-radius: 8px;">
                    <div class="card-body">
                    {{-- <h4 class="card-title">Data table</h4> --}}
                    <div class="row">
                        <div class="col-12">
                            <table id="AuditTable" class="table table-hover">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>NO</th>
                                    <th style="width: 100px;">User</th>
                                    <th style="width: 100px;">ID Related</th>
                                    <th style="padding-left: 10px;">Action</th>
                                    <th style="width: 200px;">Type</th>
                                    <th style="width: 200px;">Timestamp</th>
                                </tr>
                            </thead>
                            </table>
                      
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    </div>
    {{-- Table End --}}
    @endsection
    
    @section('jscustom')
    <script>
    
        var mTable;
    
        $(document).ready(function () {
            //RENDER DATA TABLE
            var url = "{{url('/')}}";
            mTable = $('#AuditTable').DataTable({
                fixedHeader: true,
                responsive: true,
                processing: true,
                "language": {
                    "processing": "<div class='dot-opacity-loader'></div>"
                },
                "order": [[ 0, "desc" ]],
                serverSide: true,
                ajax: "{{ route('auditrail.create')}}",
                dom: 'Bfrtip',
                buttons: [
                   
                ],
                
                columns: [
                    {  data: 'id',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'UserID', name: 'UserID' },
                    { data: 'Asset_ID', name: 'Asset_ID' },
                    { data: 'Action_Activity', name: 'Action_Activity' },
                    { data: 'Module_Feature', name: 'Module_Feature' },
                    { data: 'ChangedDateandTime', name: 'ChangedDateandTime' },
                ],
                
               
            });
          
          
    
        });
      
      
    </script>
    @endsection
    