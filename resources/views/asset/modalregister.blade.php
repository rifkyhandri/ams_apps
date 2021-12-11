<!-- Modal Starts Insert Data Asset Register -->
    <div class="modal fade" id="showModalInsertAssetRegister" tabindex="-1" role="dialog"
        aria-labelledby="AccountChartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AccountChartModalLabel">Asset Register</h5>
                        <button type="button" id="btnCloseModalAssetRegisterInsert" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 grid-margin">
                            <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <form id="formInputAssetRegister" method="post" action="#" enctype="multipart/form-data">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <div>
                                    <h3>Account</h3>
                                    <section>
                                    <div class="row col-12">
                                    <div class="form-group col-4">
                                        <label>Asset Code/Label ID:</label>
                                        <input type="text" class="form-control" id="assetcode" name="assetcode" placeholder="Asset Code/Label ID">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Asset Class:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="regassetclass" name="regasset_class" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('assetclass')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Custodian:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="regcustodian" name="regcustodian" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('custodian')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Departement:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="regdepartement" name="regdepartement" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('departement')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Asset Cost Group:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="regcostgroup" name="regcostgroup" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('costgroup')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Location:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="regsmlocation" name="reglocation" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_viewlocation('smlocation')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Cost Center:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="regcostcenter" name="regcostcenter" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('costcenter')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Vendor:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="regvendor" name="regvendor" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('vendor')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Model:</label>
                                        <input type="text" class="form-control" id="regmodel" name="regmodel" placeholder="Model">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Condition:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="regcondition" name="regcondition" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('condition')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Description</label>
                                        <textarea class="form-control" id="regdesc" name="regdesc"></textarea>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Notes:</label>
                                        <textarea class="form-control" id="regnotes" name="regnotes"></textarea>
                                    </div>
                                    </div>
                                    </section>

                                    <h3>Finance</h3>
                                    <section class="overflow-y">
                                    <div class="row">
                                        {{-- <div class="form-group col-4">
                                            <label>Invoice Number:</label>
                                            <input type="text" class="form-control" id="reginvoice" name="reginvoice" placeholder="Invoice Number">
                                        </div> --}}
                                        <div class="form-group col-4">
                                            <label>PO Number:</label>
                                            <input type="text" class="form-control" id="regpo_number" name="regpo_number" placeholder="PO Number">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>SN/License Plate:</label>
                                            <input type="text" class="form-control" id="reglicense" name="reglicense" placeholder="SN/License Plate">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Account Number:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="regaccount" name="regaccount" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('account')"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Purchase Date:</label>
                                            <input type="date" class="form-control" id="regprc_date" name="regprc_date" placeholder="Purchase Date">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Acq Date:</label>
                                            <input type="date" class="form-control" id="regacq_date" name="regacq_date" placeholder="Acq Date">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Purchase Cost:</label>
                                            <input type="number" min="0" class="form-control" id="regprc_cost" name="regprc_cost" placeholder="Purchase Cost">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Acq Cost:</label>
                                            <input type="number" min="0" class="form-control" id="regacq_cost" name="regacq_cost" placeholder="Acq Cost">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Lifetime:</label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="number" min="0" id="regyear" name="regyear" class="form-control">
                                                </div>
                                                <label>Year</label>
                                                <div class="col-4">
                                                    <input type="number" min="0" id="regmonth" name="regmonth" class="form-control">
                                                </div>
                                                <label>Month</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Depreciation Method:</label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <select class="js-example-basic-single w-100" id="regdepreciation" name="regdepreciation" oncha onchange=""nge="">
                                                    <option value="" selected></option>
                                                    <option value="Non depreciable">Non depreciable</option>
                                                    <option value="Straight Line">Straight Line</option>
                                                    <option value="Decline">Decline</option>
                                                    <option value="Double Decline">Double Decline</option>
                                                    <option value="Sum of year digits">Sum of year digits</option>
                                                    </select>
                                                </div>
                                                <label>Salvage:</label>
                                                <div class="col-3">
                                                    <input type="number" min="0" id="regsalvage" name="regsalvage" class="form-control">
                                                </div>
                                                <label>Depr rate:</label>
                                                <div class="col-3">
                                                    <input type="number" min="0" id="regdepr" name="regdepr" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </section>

                                    <h3>Warranty</h3>
                                    <section>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Service Provider:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="regprovider" name="regprovider" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('provider')"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Next Service:</label>
                                            <input type="date" class="form-control" id="regnext_service" name="regnext_service">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Warranty/End of Rent:</label>
                                            <input type="date" class="form-control" id="regwarranty" name="regwarranty">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Contract No:</label>
                                            <input type="text" class="form-control" id="regcontract" name="regcontract" placeholder="Contract No">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Tagging Status:</label>
                                            <select class="js-example-basic-single w-100" id="regtagging" name="regtagging">
                                                <option value="" selected></option>
                                                <option value="Tagged">Tagged</option>
                                                <option value="No Tag">No Tag</option>
                                            </select>
                                            {{-- <input type="text" class="form-control" id="regtagging" name="regtagging" placeholder="Tagging Status"> --}}
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Brand:</label>
                                            <input type="text" class="form-control" id="regbrand" name="regbrand" placeholder="Brand">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Manufacture:</label>
                                            <input type="text" class="form-control" id="regmanufacture" name="regmanufacture" placeholder="Manufacture">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Software ESN:</label>
                                            <input type="text" class="form-control" id="regsoftware" name="regsoftware" placeholder="Software ESN">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Part Number:</label>
                                            <input type="text" class="form-control" id="regpart" name="regpart" placeholder="Part Number">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Ownership:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="regowner" name="regowner" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('owner')"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Type:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="regassettype" name="regassettype" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('assettype')"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>IP Address:</label>
                                            <input type="text" class="form-control" id="regip_address" name="regip_address" placeholder="IP Address">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Active Status:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="regassetstatus" name="regassetstatus" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('assetstatus')"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </section>
                                    <h3>Attachment</h3>
                                    <section>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>GPS Lat:</label>
                                            <input type="text" class="form-control" id="reglat" name="reglat" placeholder="GPS Lat">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>GPS Long:</label>
                                            <input type="text" class="form-control" id="reglong" name="reglong" placeholder="GPS Long">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Images:</label>
                                            <input type="file" class="form-control" onchange="thumbnail_asset(this.id)" id="regimg" name="regimg" placeholder="Images">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Attachment 1:</label>
                                            <input type="file" class="form-control"  onchange="att_change(this.id)" id="regatt1" name="regatt1">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Attachment 2:</label>
                                            <input type="file" class="form-control"  onchange="att_change(this.id)" id="regatt2" name="regatt2">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Attachment 3:</label>
                                            <input type="file" class="form-control"  onchange="att_change(this.id)" id="regatt3" name="regatt3">
                                        </div>
                                        <div class="form-group col-4">
                                            <div id="thumb-regimg" class="image-tile"></div>
                                        </div>
                                    </div>
                                    </section>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-outline-success btn-fw"
                            style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"
                            style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalAccountChartUpdate">Cancel</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Insert Data Asset Register -->

    <!-- Modal Start Update Data Asset Register -->
     <div class="modal fade" id="showModalUpdateAssetRegister" tabindex="-1" role="dialog"
        aria-labelledby="AccountChartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AccountChartModalLabel">Asset Register</h5>
                        <button type="button" id="btnCloseModalAssetRegisterUpdate" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 grid-margin">
                            <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <form id="formUpdateAssetRegister" method="post" action="#" enctype="multipart/form-data">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                @method('patch')
                                <input type="hidden" class="form-control" id="idAssetRegister" name="id" required>
                                <div>
                                    <h3>Account</h3>
                                    <section>
                                    <div class="row col-12">
                                    <div class="form-group col-4">
                                        <label>Asset Code/Label ID:</label>
                                        <input type="text" class="form-control" id="Updateassetcode" name="assetcode" placeholder="Asset Code/Label ID">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Asset Class:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Updateregobjassetclass" name="regasset_class" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('assetclass')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Custodian:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Updateregobjcustodian" name="regcustodian" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('custodian')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Departement:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Updateregobjdepartement" name="regdepartement" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('departement')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Asset Cost Group:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Updateregobjcostgroup" name="regcostgroup" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('costgroup')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Location:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Updateregobjsmlocation" name="reglocation" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_viewlocation('smlocation')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Cost Center:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Updateregobjcostcenter" name="regcostcenter" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('costcenter')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Vendor:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Updateregobjvendor" name="regvendor" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('vendor')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Model:</label>
                                        <input type="text" class="form-control" id="Updateregmodel" name="regmodel" placeholder="Model">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Condition:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="Updateregobjcondition" name="regcondition" disabled>
                                                <option value=""></option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('condition')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Description</label>
                                        <textarea class="form-control" id="Updateregdesc" name="regdesc"></textarea>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Notes:</label>
                                        <textarea class="form-control" id="Updateregnotes" name="regnotes"></textarea>
                                    </div>
                                    </div>
                                    </section>

                                    <h3>Finance</h3>
                                    <section class="overflow-y">
                                    <div class="row">
                                        {{-- <div class="form-group col-4">
                                            <label>Invoice Number:</label>
                                            <input type="text" class="form-control" id="reginvoice" name="reginvoice" placeholder="Invoice Number">
                                        </div> --}}
                                        <div class="form-group col-4">
                                            <label>PO Number:</label>
                                            <input type="text" class="form-control" id="Updateregpo_number" name="regpo_number" placeholder="PO Number">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>SN/License Plate:</label>
                                            <input type="text" class="form-control" id="Updatereglicense" name="reglicense" placeholder="SN/License Plate">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Account Number:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="Updateregobjaccount" name="regaccount" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('account')"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Purchase Date:</label>
                                            <input type="date" class="form-control" id="Updateregprc_date" name="regprc_date" placeholder="Purchase Date">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Acq Date:</label>
                                            <input type="date" class="form-control" id="Updateregacq_date" name="regacq_date" placeholder="Acq Date">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Purchase Cost:</label>
                                            <input type="number" min="0" class="form-control" id="Updateregprc_cost" name="regprc_cost" placeholder="Purchase Cost">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Acq Cost:</label>
                                            <input type="number" min="0" class="form-control" id="Updateregacq_cost" name="regacq_cost" placeholder="Acq Cost">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Lifetime:</label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="number" min="0" id="Updateregyear" name="regyear" class="form-control">
                                                </div>
                                                <label>Year</label>
                                                <div class="col-4">
                                                    <input type="number" min="0" id="Updateregmonth" name="regmonth" class="form-control">
                                                </div>
                                                <label>Month</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Depreciation Method:</label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <select class="js-example-basic-single w-100" id="Updateregdepreciation" name="regdepreciation" onchange="">
                                                    <option value="" selected></option>
                                                    <option value="Non depreciable">Non depreciable</option>
                                                    <option value="Straight Line">Straight Line</option>
                                                    <option value="Decline">Decline</option>
                                                    <option value="Double Decline">Double Decline</option>
                                                    <option value="Sum of year digits">Sum of year digits</option>
                                                    </select>
                                                </div>
                                                <label>Salvage:</label>
                                                <div class="col-3">
                                                    <input type="number" min="0" id="Updateregsalvage" name="regsalvage" class="form-control">
                                                </div>
                                                <label>Depr rate:</label>
                                                <div class="col-3">
                                                    <input type="number" min="0" id="Updateregdepr" name="regdepr" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </section>

                                    <h3>Warranty</h3>
                                    <section>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Service Provider:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="Updateregobjprovider" name="regprovider" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('provider')"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Next Service:</label>
                                            <input type="date" class="form-control" id="Updateregnext_service" name="regnext_service">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Warranty/End of Rent:</label>
                                            <input type="date" class="form-control" id="Updateregwarranty" name="regwarranty">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Contract No:</label>
                                            <input type="text" class="form-control" id="Updateregcontract" name="regcontract" placeholder="Contract No">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Tagging Status:</label>
                                            <select class="js-example-basic-single w-100" id="Updateregtagging" name="regtagging">
                                                <option value="" selected></option>
                                                <option value="Tagged">Tagged</option>
                                                <option value="No Tag">No Tag</option>
                                            </select>
                                            {{-- <input type="text" class="form-control" id="regtagging" name="regtagging" placeholder="Tagging Status"> --}}
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Brand:</label>
                                            <input type="text" class="form-control" id="Updateregbrand" name="regbrand" placeholder="Brand">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Manufacture:</label>
                                            <input type="text" class="form-control" id="Updateregmanufacture" name="regmanufacture" placeholder="Manufacture">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Software ESN:</label>
                                            <input type="text" class="form-control" id="Updateregsoftware" name="regsoftware" placeholder="Software ESN">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Part Number:</label>
                                            <input type="text" class="form-control" id="Updateregpart" name="regpart" placeholder="Part Number">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Ownership:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="Updateregobjowner" name="regowner" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('owner')"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Type:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="Updateregobjassettype" name="regassettype" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('assettype')"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>IP Address:</label>
                                            <input type="text" class="form-control" id="Updateregip_address" name="regip_address" placeholder="IP Address">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Active Status:</label>
                                            <div class="input-group">
                                                <select class="form-control" id="Updateregobjassetstatus" name="regassetstatus" disabled>
                                                    <option value=""></option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ti-search" type="button" onclick="detail_value('assetstatus')"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </section>
                                    <h3>Attachment</h3>
                                    <section>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>GPS Lat:</label>
                                            <input type="text" class="form-control" id="Updatereglat" name="reglat" placeholder="GPS Lat">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>GPS Long:</label>
                                            <input type="text" class="form-control" id="Updatereglong" name="reglong" placeholder="GPS Long">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Images:</label>
                                            <input type="file" class="form-control" onchange="thumbnail_asset(this.id)" id="Updateregimg" name="regimg" placeholder="Images">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Attachment 1:</label>
                                            <br>
                                            <input type="file" class="form-control" onchange="att_change(this.id)" id="Updateregatt1" name="regatt1">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Attachment 2:</label>
                                            <br>
                                            <input type="file" class="form-control"  onchange="att_change(this.id)" id="Updateregatt2" name="regatt2">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Attachment 3:</label>
                                            <br>
                                            <input type="file" class="form-control"  onchange="att_change(this.id)" id="Updateregatt3" name="regatt3">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Current Image:</label>
                                            {{-- <div class="form-control"  width="400px" heigt="400px"> --}}
                                                <img id="current-img" class="form-control" src="#" alt="Image not found">
                                            {{-- </div> --}}
                                        </div>
                                        <div class="form-group col-4">
                                            <div id="thumb-Updateregimg" class="image-tile"></div>
                                        </div>
                                    </div>
                                    </section>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-outline-success btn-fw"
                            style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"
                            style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalAccountChartUpdate">Cancel</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Update Data Asset Register -->

    <!-- Modal Detail View -->
    <div class="modal fade" id="showModalDetailValue" tabindex="-1" role="dialog"
     aria-labelledby="detail_value" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detail_value">Data Available</h5>
                    <button type="button" class="close" id="closeModalDetailValue" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                 <div class="modal-body">
                    <!-- Table -->
                    <div class="row">
                        <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
                            <div class="card" style="border-radius: 15px;">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="detailValue" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Table End -->
                 </div>
                 <div class="modal-footer">
                     
                </div>
             </form>
         </div>
      </div>
    </div>
    <!-- End Modal Detail View -->

     <!-- Modal Detail Location -->
     <div class="modal fade" id="showModalDetailLocation" tabindex="-1" role="dialog"
     aria-labelledby="detail_value" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detail_location">Data Available</h5>
                    <button type="button" class="close" id="closeModalDetailLocation" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                 <div class="modal-body">
                    <!-- Table -->
                    <div class="row">
                        <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
                            <div class="card" style="border-radius: 15px;">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="detailLocation" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Location</th>
                                                    <th>Sublocation</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Table End -->
                 </div>
                 <div class="modal-footer">
                     
                </div>
             </form>
         </div>
      </div>
    </div>
    <!-- End Modal Detail Location -->

     <!-- Modal Detail QR -->
     <div class="modal fade" id="showModalQR" tabindex="-1" role="dialog"
     aria-labelledby="detail_value" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detail_location">Scan QR Code</h5>
                    <button type="button" class="close" id="closeModalQR" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                 <div class="modal-body">
                    <!-- Table -->
                    <div class="row">
                        <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
                            <div class="card" style="border-radius: 15px;">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="table-responsive d-flex justify-content-center" id="showQR">
                                            {{-- {!! QrCode::size(250)->generate('testing'); !!} --}}
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Table End -->
                 </div>
                 <div class="modal-footer">
                     
                </div>
             </form>
         </div>
      </div>
    </div>
    <!-- End Modal Detail QR -->