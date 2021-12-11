 <!-- Modal Starts Insert Data Service -->
 <div class="modal fade" id="showModalInsertService" tabindex="-1" role="dialog"
 aria-labelledby="ServiceModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content" style="border-radius: 30px;">
         <div class="modal-header">
             <h5 class="modal-title" id="ServiceModalLabel">Service Tools</h5>
             {{-- <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalImport"><i class="ti-upload menu-icon"></i> IMPORT</button> --}}
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <form class="forms-sample" method="POST" action="#" id="formInputService">
             <input type="hidden" value="{{ csrf_token() }}" name="_token" />
             <input type="hidden" value="" id="tangnumber" name="tangnumber" />
             <div class="modal-body">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Service Date</label>
                             <div class="col-sm-9">
                                 <div class="text-left" id="error_servicedate" style="padding: 2px; color:red;"></div>
                                 <input style="border-radius: 15px;" type="date" class="form-control form-control-sm" id="servicedate" name="servicedate"/>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Next Service</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_nextservice" style="padding: 2px; color:red;"></div>
                                <input style="border-radius: 15px;" type="date"
                                    class="form-control form-control-sm" name="nextservice"
                                    id="nextservice" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                           <label style="padding-top: 5px;"
                           class="col-sm-3 col-form-label">Service Provider</label>
                           <div class="col-sm-9">
                               <div class="input-group">
                                   <select class="form-control" id="serviceprovider" name="serviceprovider" disabled>
                                       <option value=""></option>
                                   </select>
                                   <div class="input-group-append">
                                       <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('provider')"></button>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Contract No</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_servicecontract" style="padding: 2px; color:red;"></div>
                                <input style="border-radius: 15px;" type="text"
                                    class="form-control form-control-sm" name="servicecontract"
                                    id="servicecontract" placeholder="Service Contract"
                                    aria-label="Service Contract" />
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Service Cost</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_costservice" style="padding: 2px; color:red;"></div>
                                <input type="number" min="0" class="form-control" id="costservice" name="costservice">
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Notes</label>
                             <div class="col-sm-9">
                                 <div class="text-left" id="error_notes" style="padding: 2px; color:red;"></div>
                                 <textarea class="form-control" id="notes" name="notes"></textarea>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-outline-success btn-fw"
                     style="border-radius: 21px;">Submit</button>
                 <button type="button" class="btn btn-outline-danger btn-fw"
                     style="border-radius: 21px;" data-dismiss="modal"
                     id="btnCloseModalServiceInsert">Cancel</button>
             </div>
         </form>
     </div>
 </div>
</div>

<!-- Modal End Insert Data Service -->