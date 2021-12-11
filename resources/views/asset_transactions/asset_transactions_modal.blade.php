 <!-- Modal Starts Insert Data Disposal -->
 <div class="modal fade" id="showModalInsertDisposal" tabindex="-1" role="dialog"
 aria-labelledby="DisposalModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content" style="border-radius: 30px;">
         <div class="modal-header">
             <h5 class="modal-title" id="DisposalModalLabel">Disposal</h5>
             {{-- <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalImport"><i class="ti-upload menu-icon"></i> IMPORT</button> --}}
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <form class="forms-sample" method="POST" action="#" id="formInputDisposal">
             <input type="hidden" value="{{ csrf_token() }}" name="_token" />
             <input type="hidden" id="disposal_asset_id" name="disposal_asset_id" />
             <input type="hidden" id="tangnumber_disposal" name="disposal_tangnumber" />
             <div class="modal-body">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Transaction Date</label>
                             <div class="col-sm-9">
                                 <div class="text-left" id="error_transactions_date" style="padding: 2px; color:red;"></div>
                                 <input style="border-radius: 15px;" type="date"
                                     class="form-control form-control-sm" name="transactions_date"
                                     id="disposal_transactions_date" placeholder="Disposal Name"
                                     aria-label="Disposal Desc" required />
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">WDV at time of sale</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_wdv" style="padding: 2px; color:red;"></div>
                                <input style="border-radius: 15px;" type="number"
                                    class="form-control form-control-sm" name="wd_value"
                                    id="disposal_wd_value" placeholder="WDV value" min="0"
                                    aria-label="Disposal Desc" required disabled/>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Sale Ammount</label>
                             <div class="col-sm-9">
                                 <div class="text-left" id="error_saleammount" style="padding: 2px; color:red;"></div>
                                 <input style=" border-radius: 15px;" type="number" 
                                     class="form-control form-control-sm"
                                     name="saleammount" id="disposal_saleammount" min="0"
                                     placeholder="Sale Ammount" required />
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label style="padding-top: 5px;"
                                 class="col-sm-3 col-form-label">Gain/Loss</label>
                             <div class="col-sm-9">
                                 <div class="text-left" id="error_diff" style="padding: 2px; color:red;"></div>
                                 <input style=" border-radius: 15px;" type="number"
                                     class="form-control form-control-sm"
                                     name="diff" id="disposal_diff" min="0"
                                     placeholder="Gain/Loss" aria-label="Disposal Code" required disabled/>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                            <label style="padding-top: 5px;"
                            class="col-sm-3 col-form-label">Transfer Account</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select class="form-control account" id="disposal_accountdis" name="accountdis" disabled>
                                        <option value=""></option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('account')"></button>
                                    </div>
                                </div>
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
                     id="btnCloseModalDisposalInsert">Cancel</button>
             </div>
         </form>
     </div>
 </div>
</div>
<!-- Modal End Insert Data Disposal -->
 
<!-- Modal Starts Insert Data Relocation -->
 <div class="modal fade" id="showModalInsertRelocation" tabindex="-1" role="dialog"
 aria-labelledby="RelocationModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content" style="border-radius: 30px;">
         <div class="modal-header">
             <h5 class="modal-title" id="RelocationModalLabel">Relocation</h5>
             
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <form class="forms-sample" method="POST" action="#" id="formInputRelocation">
             <input type="hidden" value="{{ csrf_token() }}" name="_token" />
             <div class="modal-body">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                             <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Transaction Date</label>
                             <div class="col-sm-9">
                                 <div class="text-left" id="error_transactions_date" style="padding: 2px; color:red;"></div>
                                 <input type="hidden" id="reqasset_id" name="reqasset_id">
                                 <input type="hidden" id="tangnumber_reqloc" name="tangnumber_reqloc">
                                 <input style="border-radius: 15px;" type="date"
                                     class="form-control form-control-sm" name="transactions_date"
                                     id="transactions_date" placeholder="Relocation Name"
                                     aria-label="Relocation Desc" required />
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label style="padding-top: 5px;"
                           class="col-sm-3 col-form-label">Custodian</label>
                           <div class="col-sm-9">
                               <div class="input-group">
                                <select class="form-control custodian" id="Updateregobjcustodian" name="custodian_reqloc" >
                                    <option value=""></option>
                                </select>
                                   <div class="input-group-append">
                                       <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('custodian')"></button>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>
                 </div>
            
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group row">
                            <label style="padding-top: 5px;"
                            class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select class="form-control smlocation" id="Updateregsmobjlocation" name="smlocation_reqloc" >
                                        <option value=""></option>
                                    </select>
                                
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_viewlocation('smlocation')"></button>
                                    </div>
                                </div>
                            </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group row">
                            <label style="padding-top: 5px;"
                            class="col-sm-3 col-form-label">Cost Center</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select class="form-control costcenter" id="Updateregobjcostcenter" name="costcenter_reqloc" >
                                        <option value=""></option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('costcenter')"></button>
                                    </div>
                                </div>
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
                     id="btnCloseModalRelocationInsert">Cancel</button>
             </div>
         </form>
     </div>
 </div>
</div>
<!-- Modal End Insert Data Relocation -->

<!-- Modal Starts Insert Data WriteOff -->
<div class="modal fade" id="showModalInsertWriteoff" tabindex="-1" role="dialog"
aria-labelledby="WriteoffModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 30px;">
        <div class="modal-header">
            <h5 class="modal-title" id="WriteoffModalLabel">Write Off</h5>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="forms-sample" method="POST" action="#" id="formInputWriteoff">
            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Transaction Date</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_transactions_date" style="padding: 2px; color:red;"></div>
                                <input type="hidden" id="writeasset_id" name="reqasset_id">
                                <input type="hidden" id="tangnumber_writeoff" name="tangnumber_writeoff">
                                <input style="border-radius: 15px;" type="date"
                                    class="form-control form-control-sm" name="transactions_date"
                                    id="transactions_date_writeoff" placeholder="Writeoff Name"
                                    aria-label="Writeoff Desc" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group row">
                          <label style="padding-top: 5px;"
                          class="col-sm-3 col-form-label">WDV at time of write off</label>
                          <div class="col-sm-9">
                              <div class="input-group">
                                <input class="form-control" type="number" min="0" id="wdv_writeoff" name="wd_value" disabled>
                              </div>
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
                    id="btnCloseModalWriteoffInsert">Cancel</button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- Modal End Insert Data WriteOff -->

<!-- Modal Starts Insert Data Revalue -->
<div class="modal fade" id="showModalInsertRevalue" tabindex="-1" role="dialog"
aria-labelledby="RevalueModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 30px;">
        <div class="modal-header">
            <h5 class="modal-title" id="RevalueModalLabel">Revalue</h5>
            {{-- <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalImport"><i class="ti-upload menu-icon"></i> IMPORT</button> --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="forms-sample" method="POST" action="#" id="formInputRevalue">
            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
            <input type="hidden" id="revalue_asset_id" name="revalue_asset_id" />
            <input type="hidden" id="tangnumber_revalue" name="revalue_tangnumber" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Transaction Date</label>
                            <div class="col-sm-9">
                                <input style="border-radius: 15px;" type="date"
                                    class="form-control form-control-sm" name="transactions_date"
                                    id="revalue_transactions_date" placeholder="Revalue Name"
                                    aria-label="Revalue Desc" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Purchase Cost</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_purchasecost" style="padding: 2px; color:red;"></div>
                                <input style=" border-radius: 15px;" type="number" 
                                    class="form-control form-control-sm"
                                    name="purchasecost" id="revalue_purchasecost" min="0"
                                    placeholder="Purchase Cost" required disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">WDV at time of sale</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_wdv" style="padding: 2px; color:red;"></div>
                                <input style="border-radius: 15px;" type="number"
                                    class="form-control form-control-sm" name="wd_value"
                                    id="revalue_wd_value" placeholder="WDV value" min="0"
                                    aria-label="revalue desc" required disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Extend Lifetime</label>
                            <div class="col-sm-3">
                                <input style=" border-radius: 15px;" type="number"
                                    class="form-control form-control-sm"
                                    name="year" id="revalue_year" min="0"
                                    placeholder="Year" aria-label="Revalue Year"/>
                            </div>
                            <div class="col-sm-3">
                                <input style=" border-radius: 15px;" type="number"
                                    class="form-control form-control-sm"
                                    name="month" id="revalue_month" min="0"
                                    placeholder="Month" aria-label="Revalue Month"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">New Tagnumber</label>
                            <div class="col-sm-9">
                                <input style="border-radius: 15px;" type="text"
                                    class="form-control form-control-sm" name="new_tagnumber"
                                    id="revalue_new_tagnumber" placeholder="Tagnumber" min="0"
                                    aria-label="revalue desc"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Book value after revaluation</label>
                            <div class="col-sm-9">
                                <input style="border-radius: 15px;" type="number"
                                    class="form-control form-control-sm" name="revalue_after"
                                    id="revalue_after" placeholder="Revalue after" min="0"
                                    aria-label="revalue desc"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Salvage value after revaluation</label>
                            <div class="col-sm-9">
                                <input style="border-radius: 15px;" type="number"
                                    class="form-control form-control-sm" name="revalue_salvage"
                                    id="revalue_salvage" placeholder="Revalue salvage" min="0"
                                    aria-label="revalue desc"/>
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
                    id="btnCloseModalRevalueInsert">Cancel</button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- Modal End Insert Data Revalue -->

<!-- Modal Starts Insert Data StockTake -->
<div class="modal fade" id="showModalInsertStockTake" tabindex="-1" role="dialog"
aria-labelledby="StockTakeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 30px;">
        <div class="modal-header">
            <h5 class="modal-title" id="StockTakeModalLabel">Stock Take</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="forms-sample" method="POST" action="#" id="formInputStockTake">
            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
            <input type="hidden" id="stock_asset_id" name="stock_asset_id" />
            <input type="hidden" id="tangnumber_stock" name="stock_tangnumber" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Transaction Date</label>
                            <div class="col-sm-9">
                                <input style="border-radius: 15px;" type="date"
                                    class="form-control form-control-sm" name="transactions_date"
                                    id="stock_transactions_date" placeholder="Stock Name"
                                    aria-label="Stock Desc" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                           <label style="padding-top: 5px;"
                           class="col-sm-3 col-form-label">Asset Class</label>
                           <div class="col-sm-9">
                               <div class="input-group">
                                   <select class="form-control assetclass" id="stock_assetclass" name="assetclass" disabled>
                                    <option value="" selected></option>   
                                    <option value=""></option>
                                   </select>
                                   <div class="input-group-append">
                                       <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('assetclass')"></button>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                           <label style="padding-top: 5px;"
                           class="col-sm-3 col-form-label">SO Status</label>
                           <div class="col-sm-9">
                               <div class="input-group">
                                   <select class="form-control" id="stock_status" name="stock_status">
                                       <option value="" selected></option>
                                       <option value="Asset not found/Not Checked">Asset not found/Not Checked</option>
                                       <option value="Asset found">Asset found</option>
                                       <option value="Asset not booked/New">Asset not booked/New</option>
                                   </select>
                               </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                           <label style="padding-top: 5px;"
                           class="col-sm-3 col-form-label">Asset Condition</label>
                           <div class="col-sm-9">
                               <div class="input-group">
                                   <select class="form-control condition" id="stock_condition" name="condition" disabled>
                                        <option value="" selected></option>
                                        <option value=""></option>
                                   </select>
                                   <div class="input-group-append">
                                       <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('condition')"></button>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label style="padding-top: 5px;"
                            class="col-sm-3 col-form-label">Tagging Status:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="stock_tagging" name="stock_tagging">
                                    <option value="" selected></option>
                                    <option value="Tagged">Tagged</option>
                                    <option value="No Tag">No Tag</option>
                                </select>
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
                    id="btnCloseModalStockTakeInsert">Cancel</button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- Modal End Insert Data StockTake -->