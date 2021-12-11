{{-- ALL MODALS HERE --}}

    <!-- Modal Starts Insert Data User -->
    <div class="modal fade" id="showModalInsertUser" tabindex="-1" role="dialog"
        aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formInputUser">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_name" style="padding: 2px; color:red;"></div>
                                        <input type="text"
                                            class="form-control form-control-sm" name="name" id="name" placeholder="Username" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_email" style="padding: 2px; color:red;"></div>
                                        <input type="email" class="form-control form-control-sm" placeholder="Email" name="email" id="email" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_password" style="padding: 2px; color:red;"></div>
                                        <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Password" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_role" style="padding: 2px; color:red;"></div>
                                        <div class="input-group">
                                            <select class="form-control" id="role" name="role">
                                                <option value="admin">Admin</option>
                                                <option value="Staff GA">Staff GA</option>
                                                <option value="Manager GA">Manager GA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Re-Password</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_repassword" style="padding: 2px; color:red;"></div>
                                        <input type="password" class="form-control form-control-sm" name="repassword" id="repassword" placeholder="Retype-Password" required />
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
                            id="btnCloseModalInsert">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Insert Data  User-->

    <!-- Modal Start Update Data User -->
    <div class="modal fade" id="showModalUpdateUser" tabindex="-1" role="dialog"
        aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formUpdateUser">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" class="form-control" id="id" name="id" required>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_name" style="padding: 2px; color:red;"></div>
                                        <input type="text"
                                            class="form-control form-control-sm" name="name" id="UpdateName" placeholder="Username" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_email" style="padding: 2px; color:red;"></div>
                                        <input type="email" class="form-control form-control-sm" placeholder="Email" name="email" id="UpdateEmail" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_password" style="padding: 2px; color:red;"></div>
                                        <input type="password" class="form-control form-control-sm" name="password" id="UpdatePassword" placeholder="Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_role" style="padding: 2px; color:red;"></div>
                                        <div class="input-group">
                                            <select class="form-control" id="UpdateRole" name="role">
                                                <option value="admin">Admin</option>
                                                <option value="Staff GA">Staff GA</option>
                                                <option value="Manager GA">Manager GA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Re-Password</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_repassword" style="padding: 2px; color:red;"></div>
                                        <input type="password" class="form-control form-control-sm" name="repassword" id="UpdateRepassword" placeholder="Retype-Password" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw" style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"  style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalUpdate">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Update Data User-->

    <!-- Modal Starts Insert Location -->
    <div class="modal fade" id="showModalInsertLocation" tabindex="-1" role="dialog"
        aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formInputLocation">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" name="location_user_id" value="@yield('location_user_id')">
                    <div class="modal-body">
                        <div class="row">
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_locationname" style="padding: 2px; color:red;"></div>
                                        <input type="locationname" class="form-control form-control-sm" name="locationname" id="locationname" placeholder="City " required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Country</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_country" style="padding: 2px; color:red;"></div>
                                        <input type="text" class="form-control form-control-sm" name="country" id="country" placeholder="Country" required />
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
                            id="btnCloseModalLocationInsert">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Insert Location-->
   
    {{-- Modal Insert Location_Sub --}}

    <div class="modal fade" id="showModalInsertLocationSub" tabindex="-1" role="dialog"
    aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 30px;">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" method="POST" action="#" id="formInputLocationSub">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" >
                            <div class="form-group row"  style="display: none" >
                                <label class="col-sm-3 col-form-label">Location Code</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_locationcode" style="padding: 2px; color:red;"></div>
                                    <input type="text"
                                        class="form-control form-control-sm" name="locationcode_big" id="locationcode_big" placeholder="Location Code BIG" required value="@yield('location_big_to_sub')"/>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Location Name</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_locationname" style="padding: 2px; color:red;"></div>
                                    <input type="text" class="form-control form-control-sm" name="locationname_sub" id="locationname_sub" placeholder="Location Name" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Opening Date</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_opening" style="padding: 2px; color:red;"></div>
                                    <input type="date" class="form-control form-control-sm" name="OpeningDate" id="OpeningDate" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Fax</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_fax" style="padding: 2px; color:red;"></div>
                                    <input type="text" class="form-control form-control-sm" name="fax_sub" id="fax_sub" placeholder="Fax" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_city" style="padding: 2px; color:red;"></div>
                                    <input type="text" class="form-control form-control-sm" name="city" id="city" placeholder="City" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mobile Phone</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_phone" style="padding: 2px; color:red;"></div>
                                    <input type="text" class="form-control form-control-sm" name="phone" id="phone" placeholder="Mobile Phone" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Postal Code</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_postal" style="padding: 2px; color:red;"></div>
                                    <input type="text" class="form-control form-control-sm" name="postal" id="postal" placeholder="Postal Code" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Contact</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_contact" style="padding: 2px; color:red;"></div>
                                    <input type="text" class="form-control form-control-sm" placeholder="Contact" name="contact" id="contact" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_address" style="padding: 2px; color:red;"></div>
                                    <textarea class="form-control form-control-sm" id="address" name="address"></textarea>
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
                        id="btnCloseModalLocationSubInsert">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    {{-- Modal End Insert Locatin_Sub --}}
  
    {{-- Modal Start Insert Location SMALL --}}
    <div class="modal fade" id="showModalInsertLocationSM" tabindex="-1" role="dialog"
aria-labelledby="locationModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 30px;">
        <div class="modal-header">
            <h5 class="modal-title" id="locationModalLabel">Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="forms-sample" method="POST" action="#" id="formInputLocationSm">
            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6" >
                        <div class="form-group row"  style="display: none" >
                            <label class="col-sm-3 col-form-label">Location Code</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_locationcode" style="padding: 2px; color:red;"></div>
                                <input type="text"
                                    class="form-control form-control-sm" name="locationcode_big" id="locationcode_big" placeholder="Location Code BIG" required value="@yield('location_code_big_to_sm')"/>
                                <input type="text"
                                    class="form-control form-control-sm" name="locationcode_sub" id="locationcode_sub" placeholder="Location Code sub" required value="@yield('location_code_sub_to_sm')"/>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Location Name</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_locationname" style="padding: 2px; color:red;"></div>
                                <input type="text" class="form-control form-control-sm" name="locationname_sm" id="locationname_sm" placeholder="Location Name" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Opening Date</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_opening" style="padding: 2px; color:red;"></div>
                                <input type="date" class="form-control form-control-sm" name="OpeningDate" id="OpeningDate" required />
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Phone</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_phone" style="padding: 2px; color:red;"></div>
                                <input type="text" class="form-control form-control-sm" name="phone" id="phone" placeholder="Mobile Phone" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_contact" style="padding: 2px; color:red;"></div>
                                <input type="text" class="form-control form-control-sm" placeholder="Contact" name="contact" id="contact" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <div class="text-left" id="error_address" style="padding: 2px; color:red;"></div>
                                <textarea class="form-control form-control-sm" id="address" name="address"></textarea>
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
                    id="btnCloseModalLocationSmInsert">Cancel</button>
            </div>
        </form>
    </div>
</div>
</div>
    {{-- Modal End Insert Location SMALL --}}
    <!-- Modal Start Update Location-->
    <div class="modal fade" id="showModalUpdateLocation" tabindex="-1" role="dialog"
        aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formUpdateLocation">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" class="form-control" id="idLocation" name="id" required>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_locationname" style="padding: 2px; color:red;"></div>
                                        <input type="locationname" class="form-control form-control-sm" name="locationname" id="Updatelocationname" placeholder="Location Name" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Country</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_city" style="padding: 2px; color:red;"></div>
                                        <input type="text" class="form-control form-control-sm" name="country" id="Updatecountry" placeholder="City" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6" style="display: none">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Location Code</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_locationcode" style="padding: 2px; color:red;"></div>
                                        <input type="text"
                                            class="form-control form-control-sm" name="locationcode" id="Updatelocationcode" placeholder="Location Code" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw" style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"  style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalLocationUpdate">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Update Data Location-->
    <div class="modal fade" id="showModalUpdateLocationSm" tabindex="-1" role="dialog"
    aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" method="POST" action="#" id="formUpdateLocationSm">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                <input type="hidden" class="form-control" id="idLocationSm" name="id" required>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" >
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Location Code</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_u_locationcode" style="padding: 2px; color:red;"></div>
                                <input type="hidden"
                                    class="form-control form-control-sm" name="locationcode_big" id="Updatelocationcode_big" placeholder="Location Code Big" required />
                                <input type="hidden"
                                    class="form-control form-control-sm" name="locationcode_sub" id="Updatelocationcode_sub" placeholder="Location Code Sub" required />
                                <input type="text"
                                    class="form-control form-control-sm" name="locationcode_sm" id="Updatelocationcode_sm" placeholder="Location Code Small" required readonly/>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Contact</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_u_contact" style="padding: 2px; color:red;"></div>
                                    <input type="text" class="form-control form-control-sm" placeholder="Contact" name="contact" id="Updatecontact_sm" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Location Name</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_u_locationname" style="padding: 2px; color:red;"></div>
                                    <input type="locationname" class="form-control form-control-sm" name="locationname_sm" id="Updatelocationname_sm" placeholder="Location Name" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Opening Date</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_u_opening" style="padding: 2px; color:red;"></div>
                                    <input type="date" class="form-control form-control-sm" name="OpeningDate" id="Updateopening_sm" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mobile Phone</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_u_phone" style="padding: 2px; color:red;"></div>
                                    <input type="text" class="form-control form-control-sm" name="phone" id="Updatephone_sm" placeholder="Mobile Phone" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <div class="text-left" id="error_u_address" style="padding: 2px; color:red;"></div>
                                    <textarea class="form-control form-control-sm" id="Updateaddress_sm" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success btn-fw" style="border-radius: 21px;">Update</button>
                    <button type="button" class="btn btn-outline-danger btn-fw"  style="border-radius: 21px;" data-dismiss="modal"
                        id="btnCloseModalLocationSmUpdate">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Modal Starts Insert Departement -->
    <div class="modal fade" id="showModalInsertDepartement" tabindex="-1" role="dialog"
        aria-labelledby="departementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="departementModalLabel">Departement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formInputDepartement">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" name="departement_user_id" value="@yield('departement_user_id')">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Class Code</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_departementcode" style="padding: 2px; color:red;"></div>
                                        <input type="text"
                                            class="form-control form-control-sm" name="departementcode" id="departementcode" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_departementdesc" style="padding: 2px; color:red;"></div>
                                        <textarea class="form-control form-control-sm" id="departementdesc" name="departementdesc"></textarea>
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
                            id="btnCloseModalDepartementInsert">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Insert Departement -->

    <!-- Modal Start Update Departement -->
    <div class="modal fade" id="showModalUpdateDepartement" tabindex="-1" role="dialog"
        aria-labelledby="departementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="departementModalLabel">Departement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formUpdateDepartement">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" name="departement_user_id" value="@yield('departement_user_id')">
                    <input type="hidden" class="form-control" id="idDepartement" name="id" required>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Class Code</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_departementcode" style="padding: 2px; color:red;"></div>
                                        <input type="text"
                                            class="form-control form-control-sm" id="Updatedepartementcode" name="departementcode" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_departementdesc" style="padding: 2px; color:red;"></div>
                                        <textarea class="form-control form-control-sm" id="Updatedepartementdesc" name="departementdesc"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw" style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"  style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalDepartementUpdate">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Update Data Departement -->

      <!-- Modal Starts Insert Data Cost Group -->
            <div class="modal fade" id="showModalInsertCostgroup" tabindex="-1" role="dialog"
                aria-labelledby="CostgroupModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CostgroupModalLabel">COST GROUP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" method="POST" action="#" id="formInputCostgroup">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                            <input type="hidden" name="costgroup_user_id" value="@yield('costgroup_user_id')">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Group
                                                Name</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_groupname" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="groupname" id="groupname"
                                                    placeholder="Asset Group Name" aria-label="Group Name" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px; padding-right: 0px;"
                                                class="col-sm-3 col-form-label">Life</label>
                                            <div class="col-sm-9" style="padding-left: 60px;">
                                                <div class="text-left" id="error_life" style="padding: 2px; color:red;"></div>
                                                <div class="input-group" style="width:140px;">
                                                    <input style="border-radius: 15px; height: 39px" min="0" type="number"
                                                        class="form-control form-control-sm" name="life"
                                                        id="life" placeholder="" aria-label="" required />
                                                    <div class="input-group-append" style="height: 39px">
                                                        <span class="input-group-text"
                                                            style="border-radius: 15px;">year</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;"
                                                class="col-sm-3 col-form-label">Building</label>
                                            <div class="col-sm-3" style="padding-left: 60px; padding-right: 0px;">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="Building"
                                                        id="TBuilding" value="T">
                                                        Include
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" style="padding-left: 30px;">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="Building"
                                                        id="FBuilding" value="F">
                                                        Not Include
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="text-left" id="error_Building" style="padding: 2px; color:red;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Commercial
                                                Depreciation</label>
                                            <div class="col-sm-5" style="padding-right: 0px;">
                                                <select style="border-radius: 15px; height: 39px" class="form-control selectWrapper" name="bookdepreciation"
                                                id="bookdepreciation" required>
                                                <option value="Non depreciable">Non deprecible</option>
                                                <option value="Straight line">Straight line</option>
                                                <option value="Declining">Declining</option>
                                                <option value="Double declining">Double declining</option>
                                                <option value="Sum of years digits">Sum of years digits</option>
                                                </select>
                                            <div class="text-left" id="error_bookdepreciation" style="padding: 2px; color:red;"></div>
                                            </div>
                                            <div class="col-sm-3" style="padding-left: 2px;">
                                                <div class="input-group" style="width:120px;">
                                                    <input style="border-radius: 15px; height: 39px" min='0' type="number"
                                                    class="form-control form-control-sm" name="bookdeptrate"
                                                    id="bookdeptrate" placeholder="" aria-label="" required />
                                                    <div class="input-group-append" style="height: 39px">
                                                        <span class="input-group-text"
                                                        style="border-radius: 15px;">%</span>
                                                    </div>
                                                    <div class="text-left" id="error_bookdeptrate" style="padding: 2px; color:red;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px; padding-right: 0px; margin-right: 29px;"
                                                class="col-sm-3 col-form-label">Fiscal Depreciation</label>
                                            <div class="col-sm-5" style="padding-left: 30px; padding-right: 0px;">
                                                <select style="border-radius: 15px; height: 39px" class="form-control selectWrapper" name="taxdepreciation"
                                                id="taxdepreciation" required>
                                                <option value="Non depreciable">Non deprecible</option>
                                                <option value="Straight line">Straight line</option>
                                                <option value="Declining">Declining</option>
                                                <option value="Double declining">Double declining</option>
                                                <option value="Sum of year digit">Sum of years digits</option>
                                                </select>
                                            <div class="text-left" id="error_taxdepreciation" style="padding: 2px; color:red;"></div>
                                            </div>
                                            <div class="col-sm-3" style="padding-left: 2px;">
                                                <div class="input-group" style="width:120px;">
                                                    <input style="border-radius: 15px; height: 39px" min="0" type="number"
                                                    class="form-control form-control-sm" name="taxdeprate"
                                                    id="taxdeprate" placeholder="" aria-label="" required />
                                                    <div class="input-group-append" style="height: 39px">
                                                        <span class="input-group-text"
                                                        style="border-radius: 15px;">%</span>
                                                    </div>
                                                    <div class="text-left" id="error_taxdeprate" style="padding: 2px; color:red;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Property plan and Equipment account</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_Ledger1" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger1" id="Ledger1"
                                                    placeholder="Property plan and Equipment account" aria-label="Property plan and Equipment account" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Loss on revaluation / Disposal</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_Ledger5" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger5" id="Ledger5"
                                                    placeholder="Loss on revaluation / Disposal" aria-label="Loss on revaluation / Disposal"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Accumulated depreciation account</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_Ledger2" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger2" id="Ledger2"
                                                    placeholder="Accumulated depreciation account" aria-label="Accumulated depreciation account"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Gain on revaluation / Disposal</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_Ledger6" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger6" id="Ledger6"
                                                    placeholder="Gain on revaluation / Disposal" aria-label="Gain on revaluation / Disposal"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Depreciation expenses</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_Ledger3" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger3" id="Ledger3"
                                                    placeholder="Depreciation expenses" aria-label="Depreciation expenses"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Revaluation reserved</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_Ledger7" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger7" id="Ledger7"
                                                    placeholder="Revaluation reserved" aria-label="Revaluation reserved"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Dammage or impairment of PPE</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_Ledger4" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger4" id="Ledger4"
                                                    placeholder="Dammage or impairment of PPE" aria-label="Dammage or impairment of PPE"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px; padding-right: 0px;"
                                                class="col-sm-3 col-form-label">Book Valuation Rate</label>
                                            <div class="col-sm-9" style="padding-left: 60px;">
                                                <div class="text-left" id="error_bookvalrate" style="padding: 2px; color:red;"></div>
                                                <div class="input-group" style="width:120px;">
                                                    <input style="border-radius: 15px; height: 39px" min="0" type="number"
                                                        class="form-control form-control-sm" name="bookvalrate"
                                                        id="bookvalrate" placeholder="" aria-label=""
                                                        required />
                                                    <div class="input-group-append" style="height: 39px">
                                                        <span class="input-group-text"
                                                            style="border-radius: 15px;">%</span>
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
                                <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                                    data-dismiss="modal" id="btnCloseModalCostgroupInsert">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End Insert Data Cost Group -->

            <!-- Modal Start Update Data Cost Group -->
            <div class="modal fade" id="showModalUpdateCostgroup" tabindex="-1" role="dialog"
                aria-labelledby="CostgroupModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CostgroupModalLabel">ASSET GROUP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" method="POST" action="#" id="formUpdateCostgroup">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                            <input type="hidden" name="costgroup_user_id" value="@yield('costgroup_user_id')">
                            <input type="hidden" class="form-control" id="idCostgroup" name="id" required>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Group
                                                Code</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_groupcode" style="padding: 2px; color:red;"></div>
                                                <input style="width:170px; border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="groupcode" id="Updategroupcode"
                                                    placeholder="Asset Group Code" aria-label="Asset Group Code"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px; padding-right: 0px;"
                                                class="col-sm-3 col-form-label">Book Valuation Rate</label>
                                            <div class="col-sm-9" style="padding-left: 60px;">
                                                <div class="text-left" id="error_u_bookvalrate" style="padding: 2px; color:red;"></div>
                                                <div class="input-group" style="width:120px;">
                                                    <input style="border-radius: 15px; height: 39px" min="0" type="number"
                                                        class="form-control form-control-sm" name="bookvalrate"
                                                        id="Updatebookvalrate" placeholder="" aria-label=""
                                                        required />
                                                    <div class="input-group-append" style="height: 39px">
                                                        <span class="input-group-text"
                                                            style="border-radius: 15px;">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Group
                                                Name</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_groupname" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="groupname" id="Updategroupname"
                                                    placeholder="Asset Group Name" aria-label="Group Name" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px; padding-right: 0px;"
                                                class="col-sm-3 col-form-label">Life</label>
                                            <div class="col-sm-9" style="padding-left: 60px;">
                                                <div class="text-left" id="error_u_life" style="padding: 2px; color:red;"></div>
                                                <div class="input-group" style="width:140px;">
                                                    <input style="border-radius: 15px; height: 39px" min="0" type="number"
                                                        class="form-control form-control-sm" name="life"
                                                        id="Updatelife" placeholder="" aria-label="" required />
                                                    <div class="input-group-append" style="height: 39px">
                                                        <span class="input-group-text"
                                                            style="border-radius: 15px;">year</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;"
                                                class="col-sm-3 col-form-label">Building</label>
                                            <div class="col-sm-3" style="padding-left: 60px; padding-right: 0px;">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="Building"
                                                        id="UpdateTBuilding" value="T">
                                                        Include
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" style="padding-left: 30px;">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="Building"
                                                        id="UpdateFBuilding" value="F">
                                                        Not Include
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="text-left" id="error_u_Building" style="padding: 2px; color:red;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Commercial
                                                Depreciation</label>
                                            <div class="col-sm-5" style="padding-right: 0px;">
                                                <select style="border-radius: 15px; height: 39px" class="form-control selectWrapper" name="bookdepreciation"
                                                id="Updatebookdepreciation" required>
                                                <option value="Non depreciable">Non deprecible</option>
                                                <option value="Straight line">Straight line</option>
                                                <option value="Declining">Declining</option>
                                                <option value="Double declining">Double declining</option>
                                                <option value="Sum of years digits">Sum of years digits</option>
                                                </select>
                                            <div class="text-left" id="error_u_bookdepreciation" style="padding: 2px; color:red;"></div>
                                            </div>
                                            <div class="col-sm-3" style="padding-left: 2px;">
                                                <div class="input-group" style="width:120px;">
                                                    <input style="border-radius: 15px; height: 39px" min="0" type="number"
                                                    class="form-control form-control-sm" name="bookdeptrate"
                                                    id="Updatebookdeptrate" placeholder="" aria-label="" required />
                                                    <div class="input-group-append" style="height: 39px">
                                                        <span class="input-group-text"
                                                        style="border-radius: 15px;">%</span>
                                                    </div>
                                                    <div class="text-left" id="error_u_bookdeptrate" style="padding: 2px; color:red;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px; padding-right: 0px; margin-right: 29px;"
                                                class="col-sm-3 col-form-label">Fiscal Depreciation</label>
                                            <div class="col-sm-5" style="padding-left: 30px; padding-right: 0px;">
                                                <select style="border-radius: 15px; height: 39px" class="form-control selectWrapper" name="taxdepreciation"
                                                id="Updatetaxdepreciation" required>
                                                <option value="Non depreciable">Non deprecible</option>
                                                <option value="Straight line">Straight line</option>
                                                <option value="Declining">Declining</option>
                                                <option value="Double declining">Double declining</option>
                                                <option value="Sum of year digit">Sum of years digits</option>
                                                </select>
                                            <div class="text-left" id="error_u_taxdepreciation" style="padding: 2px; color:red;"></div>
                                            </div>
                                            <div class="col-sm-3" style="padding-left: 2px;">
                                                <div class="input-group" style="width:120px;">
                                                    <input style="border-radius: 15px; height: 39px" min="0" type="number"
                                                    class="form-control form-control-sm" name="taxdeprate"
                                                    id="Updatetaxdeprate" placeholder="" aria-label="" required />
                                                    <div class="input-group-append" style="height: 39px">
                                                        <span class="input-group-text"
                                                        style="border-radius: 15px;">%</span>
                                                    </div>
                                                    <div class="text-left" id="error_u_taxdeprate" style="padding: 2px; color:red;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Property plan and Equipment account</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_Ledger1" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger1" id="UpdateLedger1"
                                                    placeholder="Property plan and Equipment account" aria-label="Property plan and Equipment account" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Loss on revaluation / Disposal</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_Ledger5" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger5" id="UpdateLedger5"
                                                    placeholder="Loss on revaluation / Disposal" aria-label="Loss on revaluation / Disposal"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Accumulated depreciation account</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_Ledger2" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger2" id="UpdateLedger2"
                                                    placeholder="Accumulated depreciation account" aria-label="Accumulated depreciation account"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Gain on revaluation / Disposal</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_Ledger6" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger6" id="UpdateLedger6"
                                                    placeholder="Gain on revaluation / Disposal" aria-label="Gain on revaluation / Disposal"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Depreciation expenses</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_Ledger3" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger3" id="UpdateLedger3"
                                                    placeholder="Depreciation expenses" aria-label="Depreciation expenses"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Revaluation reserved</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_Ledger7" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger7" id="UpdateLedger7"
                                                    placeholder="Revaluation reserved" aria-label="Revaluation reserved"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Dammage or impairment of PPE</label>
                                            <div class="col-sm-9">
                                                <div class="text-left" id="error_u_Ledger4" style="padding: 2px; color:red;"></div>
                                                <input style="border-radius: 15px;" type="text"
                                                    class="form-control form-control-sm"
                                                    name="Ledger4" id="UpdateLedger4"
                                                    placeholder="Dammage or impairment of PPE" aria-label="Dammage or impairment of PPE"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-fw"
                                    style="border-radius: 21px;">Update</button>
                                <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                                    data-dismiss="modal" id="btnCloseModalCostgroupUpdate">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End Update Data Cost Group -->

            <!-- Modal Starts Insert Data Custodian -->
                <div class="modal fade" id="showModalInsertCustodian" tabindex="-1" role="dialog"
                    aria-labelledby="custodianModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="border-radius: 30px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="custodianModalLabel">CUSTODIAN</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample" method="POST" action="#" id="formInputCustodian">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Employee Desc <span
                                                        class="required" style="color:red;">*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_custodianname" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="custodianname"
                                                        id="custodianname" placeholder="Custodian Name"
                                                        aria-label="Custodian Desc"
                                                        oninput="this.value = this.value.toUpperCase()" required />
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">User
                                                    Type</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_usertype" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="usertype"
                                                        id="usertype" placeholder="User Type"
                                                        aria-label="User Type" value="" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Company</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_company" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="company"
                                                        id="company" placeholder="company" aria-label="company"
                                                        value="" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_phone" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="phone"
                                                        id="custodianphone" placeholder="Phone" aria-label="Phone" value=""
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Opening
                                                    Date</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_OpeningDate" style="padding: 2px; color:red;"></div>
                                                    <div id="datepicker-popup" class="date datepicker">
                                                        <input style="border-radius: 15px;" type="text"
                                                            class="form-control form-control-sm" name="OpeningDate"
                                                            id="OpeningDate" placeholder="Opening Date"
                                                            aria-label="Opening Date" value="" required />
                                                        <span class="input-group-addon input-group-append border-left">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Fax</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_cfax" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="cfax" id="custodianfax"
                                                        placeholder="Fax" aria-label="Fax" value="" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="status" id="custodianstatusA" value="Actived">
                                                            Actived
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="status" id="custodianstatusS" value="Suspended">
                                                            Suspended
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="text-left" id="error_status" style="padding: 2px; color:red;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Telex</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_telex" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="telex"
                                                        id="custodiantelex" placeholder="Telex" aria-label="Telex" value=""
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_contact" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="contact"
                                                        id="custodiancontact" placeholder="Contact" aria-label="Contact"
                                                        value="" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">City</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_city" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="city"
                                                        id="custodiancity" placeholder="City" aria-label="City" value=""
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_email" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="email"
                                                        id="custodianemail" placeholder="Email" aria-label="Email" value=""
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_address" style="padding: 2px; color:red;"></div>
                                                    <textarea style="border-radius: 15px;"
                                                        class="form-control form-control-sm" name="address"
                                                        id="address" placeholder="Address" aria-label="Address"
                                                        required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Postal
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_cpostal" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="cpostal"
                                                        id="custodianpostal" placeholder="Postal Code"
                                                        aria-label="PostalCode" value="" required />
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
                                        id="btnCloseModalCustodianInsert">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal End Insert Data Custodian -->

                <!-- Modal Start Update Data Custodian -->
                <div class="modal fade" id="showModalUpdateCustodian" tabindex="-1" role="dialog"
                    aria-labelledby="custodianModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="custodianModalLabel">CUSTODIAN</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample" method="POST" action="#" id="formUpdateCustodian">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <input type="hidden" name="custodian_user_id" value="@yield('custodian_user_id')">
                                <input type="hidden" class="form-control" id="idCustodian" name="id" required>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Employee id<span class="required"
                                                        style="color:red;"> *</span></label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_custodiancode" style="padding: 2px; color:red;"></div>
                                                    <input style="width:170px; border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm"
                                                        name="custodiancode" id="Updatecustodiancode"
                                                        placeholder="Custodian Code" aria-label="Custodian Code"
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">User
                                                    Type</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_usertype" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="usertype"
                                                        id="Updateusertype" placeholder="User Type"
                                                        aria-label="User Type" value="" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Employee Desc <span
                                                        class="required" style="color:red;">*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_custodianname" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="custodianname"
                                                        id="Updatecustodianname" placeholder="Custodian Name"
                                                        aria-label="Custodian Desc"
                                                        oninput="this.value = this.value.toUpperCase()" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Company</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_company" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="company"
                                                        id="Updatecompany" placeholder="company" aria-label="company"
                                                        value="" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_phone" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="phone"
                                                        id="Updatecustodianphone" placeholder="Phone" aria-label="Phone" value=""
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Opening
                                                    Date</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_OpeningDate" style="padding: 2px; color:red;"></div>
                                                    <div id="datepicker-popup" class="date datepicker">
                                                        <input style="border-radius: 15px;" type="text"
                                                            class="form-control form-control-sm" name="OpeningDate"
                                                            id="UpdateOpeningDate" placeholder="Opening Date"
                                                            aria-label="Opening Date" value="" required />
                                                        <span class="input-group-addon input-group-append border-left">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Fax</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_cfax" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="cfax" id="Updatecustodianfax"
                                                        placeholder="Fax" aria-label="Fax" value="" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="status" id="UpdatecustodianstatusA" value="Actived">
                                                            Actived
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="status" id="UpdatecustodianstatusS" value="Suspended">
                                                            Suspended
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="text-left" id="error_u_status" style="padding: 2px; color:red;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Telex</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_telex" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="telex"
                                                        id="Updatecustodiantelex" placeholder="Telex" aria-label="Telex" value=""
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_contact" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="contact"
                                                        id="Updatecustodiancontact" placeholder="Contact" aria-label="Contact"
                                                        value="" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">City</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_city" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="city"
                                                        id="Updatecustodiancity" placeholder="City" aria-label="City" value=""
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_email" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="email"
                                                        id="Updatecustodianemail" placeholder="Email" aria-label="Email" value=""
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_address" style="padding: 2px; color:red;"></div>
                                                    <textarea style="border-radius: 15px;"
                                                        class="form-control form-control-sm" name="address"
                                                        id="Updatecustodianaddress" placeholder="Address" aria-label="Address"
                                                        required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Postal
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_cpostal" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="cpostal"
                                                        id="Updatecustodianpostal" placeholder="Postal Code"
                                                        aria-label="PostalCode" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success btn-fw"
                                        style="border-radius: 21px;">Update</button>
                                    <button type="button" class="btn btn-outline-danger btn-fw"
                                        style="border-radius: 21px;" data-dismiss="modal"
                                        id="btnCloseModalCustodianUpdate">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal End Update Data Custodian -->

                <!-- Modal Starts Insert Cost Center -->
                <div class="modal fade" id="showModalInsertCostcenter" tabindex="-1" role="dialog"
                aria-labelledby="costCenterModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="costCenterModalLabel">COST CENTER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" method="POST" action="#" id="formInputCostcenter">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                            
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label style="padding-top: 18px; padding-bottom: 5px;"
                                        class="col-sm-4 col-form-label">Description</label>
                                    <div class="col-sm-8">
                                        <div class="text-left" id="error_costcenterdesc" style="padding: 2px; color:red;"></div>
                                        <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                            name="costcenterdesc" id="costcenterdesc" placeholder="Description"
                                            aria-label="Description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding-top: 18px; padding-bottom: 5px;"
                                        class="col-sm-4 col-form-label">COA</label>
                                    <div class="col-sm-8">
                                        <div class="text-left" id="error_coa" style="padding: 2px; color:red;"></div>
                                        <input style="width:170px; border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="coa"
                                            id="coa" placeholder="COA"
                                            aria-label="Cost Center Code" required />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-fw"
                                    style="border-radius: 21px;">Submit</button>
                                <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                                    data-dismiss="modal" id="btnCloseModalCostcenterInsert">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End Insert Data Cost Center-->

            <!-- Modal Start Update Data Cost Center -->
            <div class="modal fade" id="showModalUpdateCostcenter" tabindex="-1" role="dialog"
                aria-labelledby="costCenterModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="costCenterModalLabel">COST CENTER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" method="POST" action="#" id="formUpdateCostcenter">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                            <input type="hidden" class="form-control" id="idCostcenter" name="id" required>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;" class="col-sm-4 col-form-label">Cost Center Code</label>
                                    <div class="col-sm-8">
                                        <div class="text-left" id="error_u_costcentercode" style="padding: 2px; color:red;"></div>
                                        <input style="width:170px; border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="costcentercode"
                                            id="Updatecostcentercode" placeholder="Cost Center Code"
                                            aria-label="Cost Center Code" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding-top: 18px; padding-bottom: 5px;"
                                        class="col-sm-4 col-form-label">Description</label>
                                    <div class="col-sm-8">
                                        <div class="text-left" id="error_u_costcenterdesc" style="padding: 2px; color:red;"></div>
                                        <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                            name="costcenterdesc" id="Updatecostcenterdesc" placeholder="Description"
                                            aria-label="Description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding-top: 18px; padding-bottom: 5px;"
                                        class="col-sm-4 col-form-label">COA</label>
                                    <div class="col-sm-8">
                                        <div class="text-left" id="error_u_coa" style="padding: 2px; color:red;"></div>
                                        <input style="width:170px; border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="coa"
                                            id="Updatecoa" placeholder="COA"
                                            aria-label="Cost Center Code" required />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-fw"
                                    style="border-radius: 21px;">Update</button>
                                <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                                    data-dismiss="modal" id="btnCloseModalCostcenterUpdate">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End Update Data Cost Center -->

             <!-- Modal Starts Insert Data Vendor -->
                <div class="modal fade" id="showModalInsertVendor" tabindex="-1" role="dialog"
                    aria-labelledby="vendorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="border-radius: 30px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vendorModalLabel">VENDOR</h5>
                                {{-- <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalImport"><i class="ti-upload menu-icon"></i> IMPORT</button> --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample" method="POST" action="#" id="formInputVendor">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row" style="display: none">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Vendor
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_vendorcode" style="padding: 2px; color:red;"></div>
                                                    <input style="width:170px; border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm"
                                                        name="vendorcode" id="vendorcode"
                                                        placeholder="Vendor Code" aria-label="Vendor Code" value="@yield('vendor_code_auto')" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <input type="hidden" name="vendor_user_id" id="" value="@yield('vendor_user_id')">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Vendor
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_vendorname" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vendorname"
                                                        id="vendorname" placeholder="Vendor Name"
                                                        aria-label="Vendor Desc" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Status</label>
                                                {{-- <div class="col-sm-9">
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="newStatus"
                                                        id="idNewStatus" placeholder="Status" aria-label="Status"
                                                        required />
                                                </div> --}}
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="vstatus" id="vendorstatusA" value="Actived">
                                                            Actived
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="vstatus" id="vendorstatusS" value="Suspended">
                                                            Suspended
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="text-left" id="error_vstatus" style="padding: 2px; color:red;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Fax</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_vfax" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vfax"
                                                        id="vfax" placeholder="Fax" aria-label="Fax"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Bank
                                                    Account</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_account" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="account"
                                                        id="account" placeholder="Bank Account"
                                                        aria-label="Bank Account"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_vphone" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vphone"
                                                        id="vphone" placeholder="Phone" aria-label="Phone"
                                                        />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">PIC</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_pic" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pic" id="pic"
                                                        placeholder="PIC" aria-label="PIC"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">City</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_vcity" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vcity"
                                                        id="vcity" placeholder="City" aria-label="City" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">PIC
                                                    Phone</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_pic_phone" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pic_phone"
                                                        id="pic_phone" placeholder="PIC Phone"
                                                        aria-label="PIC Phone" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Postal
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_vpostal" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vpostal"
                                                        id="vpostal" placeholder="Postal Code"
                                                        aria-label="Postal Code" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">PIC
                                                    Email</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_pic_email" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pic_email"
                                                        id="pic_email" placeholder="PIC Email"
                                                        aria-label="PIC Email" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_vaddress" style="padding: 2px; color:red;"></div>
                                                    <textarea style="border-radius: 15px;"
                                                        class="form-control form-control-sm" name="vaddress"
                                                        id="vaddress" placeholder="Address" aria-label="Address"
                                                        ></textarea>
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
                                        id="btnCloseModalVendorInsert">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal End Insert Data Vendor -->

                <!-- Modal Start Update Data Vendor -->
                <div class="modal fade" id="showModalUpdateVendor" tabindex="-1" role="dialog"
                    aria-labelledby="vendorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vendorModalLabel">VENDOR</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample" method="POST" action="#" id="formUpdateVendor">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <input type="hidden" class="form-control" id="idVendor" name="id" required>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Vendor
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_vendorcode" style="padding: 2px; color:red;"></div>
                                                    <input style="width:170px; border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm"
                                                        name="vendorcode" id="Updatevendorcode"
                                                        placeholder="Vendor Code" aria-label="Vendor Code" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Vendor
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_vendorname" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vendorname"
                                                        id="Updatevendorname" placeholder="Vendor Name"
                                                        aria-label="Vendor Desc" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Status</label>
                                                {{-- <div class="col-sm-9">
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="newStatus"
                                                        id="idNewStatus" placeholder="Status" aria-label="Status"
                                                        required />
                                                </div> --}}
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="vstatus" id="UpdatevendorstatusA" value="Actived">
                                                            Actived
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="vstatus" id="UpdatevendorstatusS" value="Suspended">
                                                            Suspended
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="text-left" id="error_u_vstatus" style="padding: 2px; color:red;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Fax</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_vfax" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vfax"
                                                        id="Updatevfax" placeholder="Fax" aria-label="Fax"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Bank
                                                    Account</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_account" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="account"
                                                        id="Updateaccount" placeholder="Bank Account"
                                                        aria-label="Bank Account"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_vphone" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vphone"
                                                        id="Updatevphone" placeholder="Phone" aria-label="Phone"
                                                        />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">PIC</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_pic" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pic" id="Updatepic"
                                                        placeholder="PIC" aria-label="PIC"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">City</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_vcity" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vcity"
                                                        id="Updatevcity" placeholder="City" aria-label="City" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">PIC
                                                    Phone</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_pic_phone" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pic_phone"
                                                        id="Updatepic_phone" placeholder="PIC Phone"
                                                        aria-label="PIC Phone" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Postal
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_vpostal" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="vpostal"
                                                        id="Updatevpostal" placeholder="Postal Code"
                                                        aria-label="Postal Code" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">PIC
                                                    Email</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_pic_email" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pic_email"
                                                        id="Updatepic_email" placeholder="PIC Email"
                                                        aria-label="PIC Email" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_vaddress" style="padding: 2px; color:red;"></div>
                                                    <textarea style="border-radius: 15px;"
                                                        class="form-control form-control-sm" name="vaddress"
                                                        id="Updatevaddress" placeholder="Address" aria-label="Address"
                                                        ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success btn-fw"
                                        style="border-radius: 21px;">Update</button>
                                    <button type="button" class="btn btn-outline-danger btn-fw"
                                        style="border-radius: 21px;" data-dismiss="modal"
                                        id="btnCloseModalVendorUpdate">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal End Update Data Vendor -->

                <!-- Modal Starts Insert Data Provider -->
                <div class="modal fade" id="showModalInsertProvider" tabindex="-1" role="dialog"
                    aria-labelledby="providerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="border-radius: 30px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="providerModalLabel">Provider</h5>
                                {{-- <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalImport"><i class="ti-upload menu-icon"></i> IMPORT</button> --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample" method="POST" action="#" id="formInputProvider">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Provider Name</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_providername" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="providername"
                                                        id="providername" placeholder="Provider Name"
                                                        aria-label="Provider Desc" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_pcontact" style="padding: 2px; color:red;"></div>
                                                    <input style=" border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm"
                                                        name="pcontact" id="pcontact"
                                                        placeholder="Contact" aria-label="Provider Code" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_paddress" style="padding: 2px; color:red;"></div>
                                                    <textarea style="border-radius: 15px;"
                                                        class="form-control form-control-sm" name="paddress"
                                                        id="paddress" placeholder="Address" aria-label="Address"
                                                        ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Fax</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_pfax" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pfax"
                                                        id="pfax" placeholder="Fax" aria-label="Fax"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">City</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_pcity" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pcity"
                                                        id="pcity" placeholder="City" aria-label="City" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_pphone" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pphone"
                                                        id="pphone" placeholder="Phone" aria-label="Phone"
                                                        />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Postal
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_ppostal" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="ppostal"
                                                        id="ppostal" placeholder="Postal Code"
                                                        aria-label="Postal Code" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">NPWP</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_npwp" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="npwp"
                                                        id="npwp" placeholder="NPWP"
                                                        aria-label="NPWP"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Opening Date</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_pOpeningDate" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="date"
                                                        class="form-control form-control-sm" name="pOpeningDate"
                                                        id="pOpeningDate" placeholder="Opening Date"
                                                        aria-label="Opening Date"  />
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
                                        id="btnCloseModalProviderInsert">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal End Insert Data Provider -->

                <!-- Modal Start Update Data Provider -->
                <div class="modal fade" id="showModalUpdateProvider" tabindex="-1" role="dialog"
                    aria-labelledby="providerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="providerModalLabel">Service Provider</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="forms-sample" method="POST" action="#" id="formUpdateProvider">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <input type="hidden" class="form-control" id="idProvider" name="id" required>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Provider
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_providercode" style="padding: 2px; color:red;"></div>
                                                    <input style="width:170px; border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm"
                                                        id="Updateprovidercode" name="providercode" 
                                                        placeholder="Provider Code" aria-label="Provider Code" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_pcontact" style="padding: 2px; color:red;"></div>
                                                    <input style="width:170px; border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm"
                                                        id="Updatepcontact" name="pcontact" 
                                                        placeholder="Contact" aria-label="Provider Code" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Description</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_providername" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="providername"
                                                        id="Updateprovidername" placeholder="Provider Name"
                                                        aria-label="Provider Desc" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_paddress" style="padding: 2px; color:red;"></div>
                                                    <textarea style="border-radius: 15px;"
                                                        class="form-control form-control-sm" name="paddress"
                                                        id="Updatepaddress" placeholder="Address" aria-label="Address"
                                                        ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Fax</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_pfax" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pfax"
                                                        id="Updatepfax" placeholder="Fax" aria-label="Fax"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">City</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_pcity" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pcity"
                                                        id="Updatepcity" placeholder="City" aria-label="City" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;"
                                                    class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_pphone" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="pphone"
                                                        id="Updatepphone" placeholder="Phone" aria-label="Phone"
                                                        />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Postal
                                                    Code</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_ppostal" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="ppostal"
                                                        id="Updateppostal" placeholder="Postal Code"
                                                        aria-label="Postal Code" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">NPWP</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_npwp" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="text"
                                                        class="form-control form-control-sm" name="npwp"
                                                        id="Updatenpwp" placeholder="NPWP"
                                                        aria-label="NPWP"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Opening Date</label>
                                                <div class="col-sm-9">
                                                    <div class="text-left" id="error_u_pOpeningDate" style="padding: 2px; color:red;"></div>
                                                    <input style="border-radius: 15px;" type="date"
                                                        class="form-control form-control-sm" name="pOpeningDate"
                                                        id="UpdatepOpeningDate" placeholder="Opening Date"
                                                        aria-label="Opening Date"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success btn-fw"
                                        style="border-radius: 21px;">Update</button>
                                    <button type="button" class="btn btn-outline-danger btn-fw"
                                        style="border-radius: 21px;" data-dismiss="modal"
                                        id="btnCloseModalProviderUpdate">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal End Update Data Provider -->


                <!-- Modal Starts Insert Condition -->
                <div class="modal fade" id="showModalInsertCondition" tabindex="-1" role="dialog"
                aria-labelledby="ConditionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ConditionModalLabel">Condition</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" method="POST" action="#" id="formInputCondition">
                            <input type="hidden" name="condition_user_id" value="@yield('condition_user_id')">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label style="padding-top: 18px; padding-bottom: 5px;"
                                        class="col-sm-4 col-form-label">ConditionName</label>
                                    <div class="col-sm-8">
                                        <div class="text-left" id="error_conditiondesc" style="padding: 2px; color:red;"></div>
                                        <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                            name="conditiondesc" id="conditiondesc" placeholder="Description"
                                            aria-label="Description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-fw"
                                    style="border-radius: 21px;">Submit</button>
                                <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                                    data-dismiss="modal" id="btnCloseModalConditionInsert">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End Insert Data Condition -->

            <!-- Modal Start Update Data Condition -->
            <div class="modal fade" id="showModalUpdateCondition" tabindex="-1" role="dialog"
                aria-labelledby="ConditionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ConditionModalLabel">Condition</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="forms-sample" method="POST" action="#" id="formUpdateCondition">
                            <input type="hidden" name="condition_user_id" value="@yield('condition_user_id')">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                            <input type="hidden" class="form-control" id="idCondition" name="id" required>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;" class="col-sm-4 col-form-label">Condition Code</label>
                                    <div class="col-sm-8">
                                        <div class="text-left" id="error_conditioncode" style="padding: 2px; color:red;"></div>
                                        <input style="width:170px; border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="conditioncode"
                                            id="Updateconditioncode" placeholder="Condition Code"
                                            aria-label="Condition Code" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding-top: 18px; padding-bottom: 5px;"
                                        class="col-sm-4 col-form-label">Description</label>
                                    <div class="col-sm-8">
                                        <div class="text-left" id="error_u_conditiondesc" style="padding: 2px; color:red;"></div>
                                        <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                            name="conditiondesc" id="Updateconditiondesc" placeholder="Description"
                                            aria-label="Description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-fw"
                                    style="border-radius: 21px;">Update</button>
                                <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                                    data-dismiss="modal" id="btnCloseModalConditionUpdate">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End Update Data Condition -->

            <!-- Modal Starts Insert AssetClass -->
            <div class="modal fade" id="showModalInsertAssetClass" tabindex="-1" role="dialog"
            aria-labelledby="AssetClassModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AssetClassModalLabel">Asset Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" method="POST" action="#" id="formInputAssetClass">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                        <div class="modal-body">
                            <div class="form-group row">
                                <label style="padding-top: 18px; padding-bottom: 5px;"
                                    class="col-sm-4 col-form-label">Description</label>
                                    <div class="col-sm-8">
                                    <div class="text-left" id="error_classdesc" style="padding: 2px; color:red;"></div>
                                    <input style="border-radius: 15px;" class="form-control form-control-sm input-upper"
                                        name="classdesc" id="classdesc" placeholder="Description"
                                        aria-label="Description" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success btn-fw"
                                style="border-radius: 21px;">Submit</button>
                            <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                                data-dismiss="modal" id="btnCloseModalAssetClassInsert">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal End Insert Data Asset Class -->

        <!-- Modal Start Update Data Asset Class -->
        <div class="modal fade" id="showModalUpdateAssetClass" tabindex="-1" role="dialog"
            aria-labelledby="AssetClassModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AssetClassModalLabel">Asset Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" method="POST" action="#" id="formUpdateAssetClass">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                        <input type="hidden" class="form-control" id="idAssetClass" name="id" required>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label style="padding-top: 5px;" class="col-sm-4 col-form-label">Asset Class</label>
                                <div class="col-sm-8">
                                    <div class="text-left" id="error_u_aclasscode" style="padding: 2px; color:red;"></div>
                                    <input style="width:170px; border-radius: 15px;" type="text"
                                        class="form-control form-control-sm" name="aclasscode"
                                        id="Updateaclasscode" placeholder="Class Code"
                                        aria-label="Class Code" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label style="padding-top: 18px; padding-bottom: 5px;"
                                    class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <div class="text-left" id="error_u_classdesc" style="padding: 2px; color:red;"></div>
                                    <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                        name="classdesc" id="Updateaclassdesc" placeholder="Description"
                                        aria-label="Description" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success btn-fw"
                                style="border-radius: 21px;">Update</button>
                            <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                                data-dismiss="modal" id="btnCloseModalAssetClassUpdate">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal End Update Data Asset Class -->

         <!-- Modal Starts Insert Ownership -->
         <div class="modal fade" id="showModalInsertOwnership" tabindex="-1" role="dialog"
         aria-labelledby="OwnershipModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="OwnershipModalLabel">Ownership</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form class="forms-sample" method="POST" action="#" id="formInputOwnership">
                     <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                     <div class="modal-body">
                         <div class="form-group row">
                             <label style="padding-top: 18px; padding-bottom: 5px;"
                                 class="col-sm-4 col-form-label">Description</label>
                             <div class="col-sm-8">
                                 <div class="text-left" id="error_ownerdesc" style="padding: 2px; color:red;"></div>
                                 <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                     name="ownerdesc" id="ownerdesc" placeholder="Description"
                                     aria-label="Description" required></textarea>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-outline-success btn-fw"
                             style="border-radius: 21px;">Submit</button>
                         <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                             data-dismiss="modal" id="btnCloseModalOwnershipInsert">Cancel</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <!-- Modal End Insert Data Ownership -->

     <!-- Modal Start Update Data Ownership -->
     <div class="modal fade" id="showModalUpdateOwnership" tabindex="-1" role="dialog"
         aria-labelledby="OwnershipModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="OwnershipModalLabel">Ownership</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form class="forms-sample" method="POST" action="#" id="formUpdateOwnership">
                     <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                     <input type="hidden" class="form-control" id="idOwnership" name="id" required>
                     <div class="modal-body">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-4 col-form-label">Ownership Code</label>
                            <div class="col-sm-8">
                                <div class="text-left" id="error_u_ownershipcode" style="padding: 2px; color:red;"></div>
                                <input style="width:170px; border-radius: 15px;" type="text"
                                    class="form-control form-control-sm" name="ownershipcode"
                                    id="Updateownershipcode" placeholder="Ownership Code"
                                    aria-label="Class Code" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label style="padding-top: 18px; padding-bottom: 5px;"
                                class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <div class="text-left" id="error_u_ownerdesc" style="padding: 2px; color:red;"></div>
                                <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                    name="ownerdesc" id="Updateownerdesc" placeholder="Description"
                                    aria-label="Description" required></textarea>
                            </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-outline-success btn-fw"
                             style="border-radius: 21px;">Update</button>
                         <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                             data-dismiss="modal" id="btnCloseModalOwnershipUpdate">Cancel</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <!-- Modal End Update Data Ownership -->

     <!-- Modal Starts Insert Asset Status -->
     <div class="modal fade" id="showModalInsertAssetStatus" tabindex="-1" role="dialog"
         aria-labelledby="AssetStatusModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="AssetStatusModalLabel">Asset Status</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form class="forms-sample" method="POST" action="#" id="formInputAssetStatus">
                     <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                     <div class="modal-body">
                         <div class="form-group row">
                             <label style="padding-top: 5px;" class="col-sm-4 col-form-label">Status Code</label>
                             <div class="col-sm-8">
                                 <div class="text-left" id="error_statuscode" style="padding: 2px; color:red;"></div>
                                 <input type="hidden" name="assetstatus_user_id" value="@yield('assetstatus_user_id')">
                                 <input style="width:170px; border-radius: 15px;" type="text"
                                     class="form-control form-control-sm" name="statuscode"
                                     id="statuscode" placeholder="Status Code"
                                     aria-label="Status Code" required />
                             </div>
                         </div>
                         <div class="form-group row">
                             <label style="padding-top: 18px; padding-bottom: 5px;"
                                 class="col-sm-4 col-form-label">Description</label>
                             <div class="col-sm-8">
                                 <div class="text-left" id="error_statusdesc" style="padding: 2px; color:red;"></div>
                                 <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                     name="statusdesc" id="statusdesc" placeholder="Description"
                                     aria-label="Description" required></textarea>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-outline-success btn-fw"
                             style="border-radius: 21px;">Submit</button>
                         <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                             data-dismiss="modal" id="btnCloseModalAssetStatusInsert">Cancel</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <!-- Modal End Insert Data Asset Status -->

     <!-- Modal Start Update Data Asset Status  -->
     <div class="modal fade" id="showModalUpdateAssetStatus" tabindex="-1" role="dialog"
         aria-labelledby="AssetStatusModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="AssetStatusModalLabel">Asset Status</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form class="forms-sample" method="POST" action="#" id="formUpdateAssetStatus">
                    <input type="hidden" name="assetstatus_user_id" value="@yield('assetstatus_user_id')">
                     <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                     <input type="hidden" class="form-control" id="idAssetStatus" name="id" required>
                     <div class="modal-body">
                        <div class="form-group row">
                            <label style="padding-top: 5px;" class="col-sm-4 col-form-label">Status Code</label>
                            <div class="col-sm-8">
                                <div class="text-left" id="error_u_statuscode" style="padding: 2px; color:red;"></div>
                                <input style="width:170px; border-radius: 15px;" type="text"
                                    class="form-control form-control-sm" name="statuscode"
                                    id="Updatestatuscode" placeholder="Status Code"
                                    aria-label="Status Code" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label style="padding-top: 18px; padding-bottom: 5px;"
                                class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <div class="text-left" id="error_u_statusdesc" style="padding: 2px; color:red;"></div>
                                <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                    name="statusdesc" id="Updatestatusdesc" placeholder="Description"
                                    aria-label="Description" required></textarea>
                            </div>
                        </div>
                    </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-outline-success btn-fw"
                             style="border-radius: 21px;">Update</button>
                         <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                             data-dismiss="modal" id="btnCloseModalAssetStatusUpdate">Cancel</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <!-- Modal End Update Data Asset Status -->

     <!-- Modal Starts Insert Asset Type -->
     <div class="modal fade" id="showModalInsertAssetType" tabindex="-1" role="dialog"
     aria-labelledby="AssetTypeModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="AssetTypeModalLabel">Asset Type</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form class="forms-sample" method="POST" action="#" id="formInputAssetType">
                 <input type="hidden" name="assetstype_user_id" value="@yield('assetstype_user_id')">
                 <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                 <div class="modal-body">
                     <div class="form-group row">
                         <label style="padding-top: 5px;" class="col-sm-4 col-form-label">Asset Type</label>
                         <div class="col-sm-8">
                             <div class="text-left" id="error_typecode" style="padding: 2px; color:red;"></div>
                             <input style="width:170px; border-radius: 15px;" type="text"
                                 class="form-control form-control-sm" name="typecode"
                                 id="typecode" placeholder="Type Code"
                                 aria-label="Type Code" required />
                         </div>
                     </div>
                     <div class="form-group row">
                         <label style="padding-top: 18px; padding-bottom: 5px;"
                             class="col-sm-4 col-form-label">Description</label>
                         <div class="col-sm-8">
                             <div class="text-left" id="error_typedesc" style="padding: 2px; color:red;"></div>
                             <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                 name="typedesc" id="typedesc" placeholder="Description"
                                 aria-label="Description" required></textarea>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-outline-success btn-fw"
                         style="border-radius: 21px;">Submit</button>
                     <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                         data-dismiss="modal" id="btnCloseModalAssetTypeInsert">Cancel</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- Modal End Insert Data Asset Type -->

 <!-- Modal Start Update Data Asset Type  -->
 <div class="modal fade" id="showModalUpdateAssetType" tabindex="-1" role="dialog"
     aria-labelledby="AssetTypeModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="AssetTypeModalLabel">Asset Type</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form class="forms-sample" method="POST" action="#" id="formUpdateAssetType">
                <input type="hidden" name="assetstype_user_id" value="@yield('assetstype_user_id')">
                 <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                 <input type="hidden" class="form-control" id="idAssetType" name="id" required>
                 <div class="modal-body">
                    <div class="form-group row">
                        <label style="padding-top: 5px;" class="col-sm-4 col-form-label">Asset Type</label>
                        <div class="col-sm-8">
                            <div class="text-left" id="error_u_typecode" style="padding: 2px; color:red;"></div>
                            <input style="width:170px; border-radius: 15px;" type="text"
                                class="form-control form-control-sm" name="typecode"
                                id="Updatetypecode" placeholder="Type Code"
                                aria-label="Type Code" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="padding-top: 18px; padding-bottom: 5px;"
                            class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <div class="text-left" id="error_u_typedesc" style="padding: 2px; color:red;"></div>
                            <textarea style="border-radius: 15px;" class="form-control form-control-sm"
                                name="typedesc" id="Updatetypedesc" placeholder="Description"
                                aria-label="Description" required></textarea>
                        </div>
                    </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-outline-success btn-fw"
                         style="border-radius: 21px;">Update</button>
                     <button type="button" class="btn btn-outline-danger btn-fw" style="border-radius: 21px;"
                         data-dismiss="modal" id="btnCloseModalAssetTypeUpdate">Cancel</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- Modal End Update Data Asset Type -->

    <!-- Modal Starts Insert Data Account Chart -->
    <div class="modal fade" id="showModalInsertAccountChart" tabindex="-1" role="dialog"
        aria-labelledby="AccountChartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="AccountChartModalLabel">Account Chart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formInputAccountChart">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Account Group</label>
                                    <div class="col-sm-6" style="padding-right: 0px;">
                                        <div class="row">
                                            <div class="col-sm-10">
                                        <select style="border-radius: 15px; height: 39px" class="form-control selectWrapper" name="accountgroup"
                                        id="AccountGroupAsset" required>
                                        <option value="">Select Account Group</option>  
                                        @yield('account_group_select')
                                                                         
                                        </select>
                                    </div>
                                        
                                         </div>
                                    <div class="text-left" id="error_accountgroup" style="padding: 2px; color:red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Sub Group</label>
                                    <div class="col-sm-5" style="padding-right: 0px;">
                                        <select style="border-radius: 15px; height: 39px" class="form-control selectWrapper" name="subgroup"
                                        id="subgroup" required>
                                        <option value="">Select Sub Account</option>
                                        @yield('account_group_sub')
                                        </select>
                                    <div class="text-left" id="error_accountgroup" style="padding: 2px; color:red;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">LEVEL</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_level" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="number" min="0" max="2"
                                            class="form-control form-control-sm" 
                                            name="level" id="level"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account No</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_accountno" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="accountno"
                                            id="accountno" placeholder="Account Number" aria-label="accountno"
                                            value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_accountname" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="accountname"
                                            id="accountname" placeholder="Account Name" aria-label="accountname" value=""
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account Short Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_accountshortname" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="accountshortname"
                                            id="accountshortname" placeholder="Account Short Name" aria-label="accountshortname" value=""
                                            required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Old Account</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_oldaccount" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="oldaccount" id="oldaccount"
                                            placeholder="Old Account" aria-label="Old Account" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                    name="statusaccount" id="statusAccountA" value="Actived">
                                                Actived
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                    name="statusaccount" id="statusAccountS" value="Suspended">
                                                Suspended
                                            </label>
                                        </div>
                                    </div>
                                    <div class="text-left" id="error_statusaccount" style="padding: 2px; color:red;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw"
                            style="border-radius: 21px;">Submit</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"
                            style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalAccountChartInsert">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Insert Data Account Chart -->
    <!-- Modal Starts Insert Data Account Group -->
    <div class="modal fade" id="showModalInsertAccountGroup" tabindex="-1" role="dialog"
        aria-labelledby="AccountGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="AccountGroupModalLabel">Account Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formInputAccountGroup">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <div class="modal-body">     
                        <div class="form-group">
                            <label>Account Group Name</label>
                            <input type="text" class="form-control" placeholder="Account Group Name" name="account_group_name" id="account_group_name" aria-label="account_group_name" required>
                            <small id="validation" class="form-text text-muted">input data information correctly.</small>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw"
                            style="border-radius: 21px;">Submit</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"
                            style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalAccountGroupInsert">Cancel</button>
                           
                    </div>
                </form>
            </div>
        </div>
        </div>
  
    <!-- Modal End Insert Data Account Group -->
    <!-- Modal Starts Insert Data Account Sub -->
    <div class="modal fade" id="showModalInsertAccountsub" tabindex="-1" role="dialog"
        aria-labelledby="AccountsubModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="AccountsubModalLabel">Account Sub</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formInputAccountsub">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" value="@yield('accoount_group_to_sub')" name="id_db_account_group">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Account Sub</label>
                            <input type="text" class="form-control" placeholder="Account Sub Name" name="account_sub_name" id="account_sub_name" aria-label="account_sub_name" required>
                            <small id="error_accountname_sub" class="form-text text-muted">input data information correctly.</small>
                        </div>
                        </div>   
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw"
                            style="border-radius: 21px;">Submit</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"
                            style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalAccountsubInsert">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
  
    <!-- Modal End Insert Data Account Sub -->
   

    <!-- Modal Start Update Account Chart -->
    <div class="modal fade" id="showModalUpdateAccountChart" tabindex="-1" role="dialog"
        aria-labelledby="AccountChartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AccountChartModalLabel">Account Chart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formUpdateAccountChart">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" class="form-control" id="idAccountChart" name="id" required>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Account Group</label>
                                    <div class="col-sm-5" style="padding-right: 0px;">
                                        <select style="border-radius: 15px; height: 39px" class="form-control selectWrapper" name="accountgroup"
                                        id="Updateaccountgroup" required>
                                        <option value="ASSET">ASSET</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        </select>
                                    <div class="text-left" id="error_u_accountgroup" style="padding: 2px; color:red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;" class="col-sm-3 col-form-label">Sub Group</label>
                                    <div class="col-sm-5" style="padding-right: 0px;">
                                        <select style="border-radius: 15px; height: 39px" class="form-control selectWrapper" name="subgroup"
                                        id="Updatesubgroup" required>
                                        <option value="BANGUNAN">BANGUNAN</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        <option value="COMING SOON">COMING SOON</option>
                                        </select>
                                    <div class="text-left" id="error_u_accountgroup" style="padding: 2px; color:red;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">LEVEL</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_level" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="number" min="0" max="2"
                                            class="form-control form-control-sm" 
                                            name="level" id="Updatelevel"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account No</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_accountno" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="accountno"
                                            id="Updateaccountno" placeholder="Account Number" aria-label="accountno"
                                            value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_accountname" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="accountname"
                                            id="Updateaccountname" placeholder="Account Name" aria-label="accountname" value=""
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account Short Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_accountshortname" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="accountshortname"
                                            id="Updateaccountshortname" placeholder="Account Short Name" aria-label="accountshortname" value=""
                                            required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Old Account</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_oldaccount" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="oldaccount" id="Updateoldaccount"
                                            placeholder="Old Account" aria-label="Old Account" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                    name="statusaccount" id="UpdatestatusAccountA" value="Actived">
                                                Actived
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                    name="statusaccount" id="UpdatestatusAccountS" value="Suspended">
                                                Suspended
                                            </label>
                                        </div>
                                    </div>
                                    <div class="text-left" id="error_u_statusaccount" style="padding: 2px; color:red;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw"
                            style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"
                            style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalAccountChartUpdate">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Update Data Account Chart -->
    <!-- Modal Start Update Data Account Group -->
    <div class="modal fade" id="showModalUpdateAccountGroup" tabindex="-1" role="dialog"
        aria-labelledby="AccountGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AccountGroupModalLabel">Account Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formUpdateAccountGroup">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" class="form-control" id="idAccountGroup" name="id" required>
                    <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account No</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_accountgroup" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="id_account_group"
                                            id="UpdateaccountnoGroup" placeholder="Account Number" aria-label="accountnogroup"
                                            value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_accountnamegroup" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="account_group_name"
                                            id="UpdateaccountnameGroup" placeholder="Account Number" aria-label="accountnamegroup"
                                            value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw"
                            style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"
                            style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalAccountGroupUpdate">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Update Data Account Group -->
    <!-- Modal Start Update Data Account Sub -->
    <div class="modal fade" id="showModalUpdateAccountsub" tabindex="-1" role="dialog"
        aria-labelledby="AccountsubModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AccountsubModalLabel">Account sub</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formUpdateAccountsub">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" class="form-control" id="idAccountsub" name="id" required>
                    <input type="text" class="form-control" id="idAccountgroup" name="id_db_account_group" required>
                    <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-sub row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account No</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_accountsub" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="id_account_sub"
                                            id="Updateaccountnosub" placeholder="Account Number" aria-label="accountnosub"
                                            value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-sub row">
                                    <label style="padding-top: 5px;"
                                        class="col-sm-3 col-form-label">Account Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_accountnamesub" style="padding: 2px; color:red;"></div>
                                        <input style="border-radius: 15px;" type="text"
                                            class="form-control form-control-sm" name="account_sub_name"
                                            id="Updateaccountnamesub" placeholder="Account Number" aria-label="accountnamesub"
                                            value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw"
                            style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"
                            style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalAccountsubUpdate">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End Update Data Account sub -->

    {{-- Modal Action import Excel --}}
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="@yield('modal_import_excel')" id="@yield('importExcel')" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">
    
                        {{ csrf_field() }}
    
                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
{{-- END ALL MODALS --}}
