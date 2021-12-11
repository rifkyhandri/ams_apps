@extends('layouts.dashboard')
@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Settings</h4>
        {{-- <p class="card-description">
          Horizontal form layout
        </p> --}}
        <form class="forms-sample" action="{{ url('setting_update') }}" method="post">
          @method('PATCH')
          @csrf
          @foreach ($user as $usr)
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                @if($errors->has('name'))
                    <div class="text-left" style="padding: 2px; color:red;">{{ $errors->first('name') }}</div>
                @endif
              <input type="text" name="name" class="form-control" id="exampleInputUsername2" placeholder="Username" value="{{ $usr->name }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                @if($errors->has('email'))
                    <div class="text-left" style="padding: 2px; color:red;">{{ $errors->first('email') }}</div>
                @endif
              <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="Email" value="{{ $usr->email }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Role</label>
            <div class="col-sm-9">
                @if($errors->has('role'))
                    <div class="text-left" style="padding: 2px; color:red;">{{ $errors->first('role') }}</div>
                @endif
                <div class="input-group">
                  <select class="form-control" id="role" name="role">
                      <option value="{{ $usr->role }}" selected>{{ $usr->role }}</option>
                      @if (auth()->user()->role == 'admin')
                        <option value="admin">admin</option>
                        <option value="Manager GA">Manager GA</option>
                      @endif
                      <option value="Staff GA">Staff GA</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                @if($errors->has('password'))
                    <div class="text-left" style="padding: 2px; color:red;">{{ $errors->first('password') }}</div>
                @endif
              <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
              <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re-Password</label>
              <div class="col-sm-9">
                @if($errors->has('repassword'))
                    <div class="text-left" style="padding: 2px; color:red;">{{ $errors->first('repassword') }}</div>
                @endif
              <input type="password" name="repassword" class="form-control" id="exampleInputConfirmPassword2" placeholder="Retype-Password">
            </div>
          </div>
          <button type="submit" class="btn btn-primary float-right">Save</button>
          @endforeach
        </form>
      </div>
    </div>
  </div>
@endsection

@section('jscustom')

@endsection
