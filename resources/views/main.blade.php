@extends('layouts.dashboard')
@section('content')
    <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-5 mb-4 mb-xl-0">
                <h4 class="font-weight-bold">Hi, Welcomeback {{ Auth::user()->name }}</h4>
                <h4 class="font-weight-normal mb-0">FASTrack Asset Management Dashboard,</h4>
                </div>
                <div class="col-12 col-xl-7">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                    <p class="text-muted">Total Asset</p>
                    <h3 class="mb-0 font-weight-bold">{{ (isset($asset_amount->total_asset) ? $asset_amount->total_asset : null ) }}</h3>
                    </div>
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                    <p class="text-muted">Total Asset Value</p>
                    <h3 class="mb-0 font-weight-bold">Rp.{{ (isset($asset_value->FA) ? number_format($asset_value->FA) : null ) }}</h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Number of Asset</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ (isset($asset_amount->total_asset) ? $asset_amount->total_asset : null ) }}</h3>
                    <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>
                <p class="mb-0 mt-2 text-warning">{{ NOW()->format('D') }}<span class="text-body ml-1"><small>{{ NOW()->format('d-M-Y') }}</small></span></p>
                </div>
            </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Number of Users</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ (isset($users_amount->amount) ? $users_amount->amount : null ) }}</h3>
                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>
                <p class="mb-0 mt-2 text-danger">{{ NOW()->format('D') }}<span class="text-body ml-1"><small>{{ NOW()->format('d-M-Y') }}</small></span></p>
                </div>
            </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Total Asset Value</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h4 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">Rp.{{ (isset($asset_value->FA) ? number_format($asset_value->FA) : null ) }}</h4>
                    <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>
                <p class="mb-0 mt-2 text-success">{{ NOW()->format('D') }}<span class="text-body ml-1"><small>{{ NOW()->format('d-M-Y') }}</small></span></p>
                </div>
            </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Number Of Cost Group</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ (isset($costgroup_amount->amount) ? $costgroup_amount->amount : null ) }}</h3>
                    <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>
                <p class="mb-0 mt-2 text-success">{{ NOW()->format('D') }}<span class="text-body ml-1"><small>{{ NOW()->format('d-M-Y') }}</small></span></p>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="card bg-primary border-0 position-relative">
                <div class="card-body">
                <p class="card-title text-white">Overview</p>
                <div id="performanceOverview" class="carousel slide performance-overview-carousel position-static pt-2" data-ride="carousel">
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                        <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-4 mt-md-0">
                            <div class="icon icon-a text-white mr-3">
                                <i class="ti-harddrives icon-lg ml-3"></i>
                            </div>
                            <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                <h3 class="font-weight-light mr-2 mb-1">Asset Ammount</h3>
                                <h3 class="mb-0">{{ (isset($users_amount->amount) ? $users_amount->amount : null ) }}</h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                <h5 class="mb-0"></h5>
                                <div class="d-flex align-items-center">
                                    {{-- <i class="ti-angle-up mr-2"></i> --}}
                                    <h5 class="mb-0"></h5>
                                </div>
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The total number of asset which have been registered within the date range.</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                            <div class="icon icon-b text-white mr-3">
                                <i class="ti-bar-chart icon-lg ml-3"></i>
                            </div>
                            <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                <h3 class="font-weight-light mr-2 mb-1">Asset Value</h3>
                                <h3 class="mb-0">Rp.{{ (isset($asset_value->FA) ? number_format($asset_value->FA) : null ) }}</h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                <h5 class="mb-0"></h5>
                                <div class="d-flex align-items-center">
                                    {{-- <i class="ti-angle-down mr-2"></i> --}}
                                    <h5 class="mb-0"></h5>
                                </div>
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The total value of asset which have registered in range several years.</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                            <div class="icon icon-c text-white mr-3">
                                <i class="ti-clipboard icon-lg ml-3"></i>
                            </div>
                            <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                <h3 class="font-weight-light mr-2 mb-1">Cost Group</h3>
                                <h3 class="mb-0">{{ (isset($costgroup_amount->amount) ? $costgroup_amount->amount : null ) }}</h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                <h5 class="mb-0"></h5>
                                <div class="d-flex align-items-center">
                                    {{-- <i class="ti-angle-down mr-2"></i> --}}
                                    <h5 class="mb-0"></h5>
                                </div>
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The total number of group of asset that we have registered to the systems</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- <div class="carousel-item">
                        <div class="row">
                        <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-4 mt-md-0">
                            <div class="icon icon-a text-white mr-3">
                                <i class="ti-cup icon-lg ml-3"></i>
                            </div>
                            <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                <h3 class="font-weight-light mr-2 mb-1">Clients</h3>
                                <h3 class="mb-0">86096</h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                <h5 class="mb-0">+20394</h5>
                                <div class="d-flex align-items-center">
                                    <i class="ti-angle-down mr-2"></i>
                                    <h5 class="mb-0">0.048%</h5>
                                </div>
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                            <div class="icon icon-b text-white mr-3">
                                <i class="ti-bar-chart icon-lg ml-3"></i>
                            </div>
                            <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                <h3 class="font-weight-light mr-2 mb-1">Order</h3>
                                <h3 class="mb-0">$8597420</h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                <h5 class="mb-0">-2.49650</h5>
                                <div class="d-flex align-items-center">
                                    <i class="ti-angle-down mr-2"></i>
                                    <h5 class="mb-0">5.962%</h5>
                                </div>
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                            <div class="icon icon-c text-white mr-3">
                                <i class="ti-shopping-cart-full icon-lg ml-3"></i>
                            </div>
                            <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                <h3 class="font-weight-light mr-2 mb-1">Bookings</h3>
                                <h3 class="mb-0">8064</h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                <h5 class="mb-0">+2079</h5>
                                <div class="d-flex align-items-center">
                                    <i class="ti-angle-down mr-2"></i>
                                    <h5 class="mb-0">78.02%</h5>
                                </div>
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div> --}}
                    </div>
                    <a class="carousel-control-prev" href="#performanceOverview" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#performanceOverview" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
                </div>
            </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title">Order and Downloads</p>
                <p class="text-muted font-weight-light">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                    <p class="text-muted">Order value</p>
                    <h3>12.3k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                    <p class="text-muted">Orders</p>
                    <h3>14k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                    <p class="text-muted">Users</p>
                    <h3>71.56%</h3>
                    </div>
                    <div class="mt-3">
                    <p class="text-muted">Downloads</p>
                    <h3>34040</h3>
                    </div>
                </div>
                <canvas id="order-chart"></canvas>
                </div>
            </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title">Sales Report</p>
                <p class="text-muted font-weight-light">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                <canvas id="sales-chart"></canvas>
                </div>
                <div class="card border-right-0 border-left-0 border-bottom-0 shadow-none border-top">
                <div class="d-flex justify-content-center justify-content-md-end">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-lg btn-outline-dark bg-transparent text-body dropdown-toggle rounded-0 border-top-0 border-bottom-0" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Today
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                        <a class="dropdown-item" href="#">January - March</a>
                        <a class="dropdown-item" href="#">March - June</a>
                        <a class="dropdown-item" href="#">June - August</a>
                        <a class="dropdown-item" href="#">August - November</a>
                    </div>
                    </div>
                    <button class="btn btn-lg btn-outline-light text-primary rounded-0 border-0 d-none d-md-block bg-transparent" type="button"> View all </button>
                </div>
                </div>
            </div>
            </div>
        </div> --}}

        </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('jscustom')

@endsection
