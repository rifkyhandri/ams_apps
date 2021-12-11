<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('dashboard') }}">
          <i class="ti-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
          <i class="ti-view-list menu-icon"></i>
          <span class="menu-title">Master</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-advanced">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('account.index') }}">Account Chart</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('account_group.index')}}">Account Group</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('assetclass.index')}}">Asset Class</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('assetstatus.index')}}">Asset Status</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('assettype.index')}}">Asset Type</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('condition.index')}}">Condition</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('costcenter.index')}}">Cost Center</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('costgroup.index')}}">Cost Group</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('custodian.index')}}">Custodian</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('departement.index')}}">Departement</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('location.index')}}">Location</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('owner.index')}}">Ownership</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('provider.index')}}">Service Providers</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('vendor.index')}}">Vendor</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="ti-clipboard menu-icon"></i>
          <span class="menu-title">Asset Register</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('asset_register.index') }}">Asset Register</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
          <i class="ti-eraser menu-icon"></i>
          <span class="menu-title">Asset Data</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="editors">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{route('asset_data')}}">Asset List</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('depreciation.index')}}">Depreciation</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('transactions.index')}}">Asset Transactions</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('approvaltransaction.index')}}">Asset Approval</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('service.index')}}">Service Tools</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="ti-bar-chart-alt menu-icon"></i>
          <span class="menu-title">Report</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('report.t') }}">Transaction</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('report.j') }}">Journal</a></li> --}}
            <li class="nav-item"> <a class="nav-link" href="{{ route('report.sl') }}">Service Log</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('report.sa') }}">Summary Asset</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('report.h') }}">Asset History</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('report.st') }}">Stock Take</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('auditrail.index') }}">Auditrail</a></li>
          </ul>
        </div>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="ti-layout menu-icon"></i>
          <span class="menu-title">Inventory</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#">Basic table</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Data table</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Js-grid</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Sortable table</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="ti-layers-alt menu-icon"></i>
          <span class="menu-title">Transactions</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="#"> Login 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="#"> Register </a></li>
            <li class="nav-item"> <a class="nav-link" href="#"> Register 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="#"> Lockscreen </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
          <i class="ti-map menu-icon"></i>
          <span class="menu-title">Barcode</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="maps">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#">Mapael</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Vector Map</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Google Map</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
          <i class="ti-help-alt menu-icon"></i>
          <span class="menu-title">Maintenance</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#"> 404 </a></li>
            <li class="nav-item"> <a class="nav-link" href="#"> 500 </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="ti-check-box menu-icon"></i>
          <span class="menu-title">Integration</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#">Flag icons</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Mdi icons</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Font Awesome</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Simple line icons</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Themify icons</a></li>
          </ul>
        </div>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
            <i class="ti-settings menu-icon"></i>
            <span class="menu-title">Settings</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="settings">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('user') }}">User</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('settings') }}">Settings</a></li>
            </ul>
        </div>
      </li>
    </ul>
  </nav>
