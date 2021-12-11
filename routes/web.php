<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* =========== MIDDLEWARE AUTH =========== */
Route::middleware(['web'])->group(function () {
    
        /* ===== LOGIN PAGE ===== */
    Route::get('/', function () {
        return view('auth.login');
    })->name('login_view')->middleware('guest');
    
    Route::post('login','Auth\UserController@login_post')->name('login');

    Route::middleware(['auth'])->group(function () {
        /* =========== DASHBOARD =========== */
        Route::get('dashboard','DashboardController@index')->name('dashboard');

        /* =========== AUTH =========== */
        Route::get('logout','Auth\UserController@logout')->name('logout');
        Route::get('settings','Auth\UserController@settings')->name('settings');
        Route::patch('setting_update','Auth\UserController@setting_update')->name('setting_update');

        Route::middleware(['role:admin'])->group(function () {
                Route::get('user','Auth\UserController@index')->name('user');
                Route::get('user_list','Auth\UserController@user_list')->name('user_list');
                Route::get('user_edit','Auth\UserController@user_edit')->name('user_edit');
                Route::post('user_input','Auth\UserController@user_input')->name('user_input');
                Route::patch('user_update','Auth\UserController@user_update')->name('user_update');
                Route::delete('user_delete/{id}','Auth\UserController@user_delete')->name('user_delete');
        });
        /* =========== END AUTH =========== */

        /* =========== MASTER =========== */
        Route::resources([
            'location'     => 'Master\LocationController',
            'departement'  => 'Master\DepartementController',
            'costgroup'    => 'Master\CostGroupController',
            'custodian'    => 'Master\CustodianController',
            'costcenter'   => 'Master\CostCenterController',
            'vendor'       => 'Master\VendorController',
            'provider'     => 'Master\ProviderController',
            'condition'    => 'Master\ConditionController',
            'assetclass'   => 'Master\AssetClassController',
            'owner'        => 'Master\OwnershipController',
            'assetstatus'  => 'Master\AssetStatusController',
            'assettype'    => 'Master\AssetTypeController',
            'account'      => 'Master\AccountChartController',
            'account_group'=> 'Master\AccountChart_Group',
            'account_sub'  => 'Master\AccountSubController',
            'sublocation'  => 'Master\SubLocationController',
            'smlocation'   => 'Master\SmLocationController',
            'location_assets'  => 'Master\LocationAssetController',
            'transactions' => 'AssetData\AssetTransactionController',
            'relocation'   => 'AssetData\RelocationController',
            'approvaltransaction'   => 'AssetData\ApprovalTransactionController',
            'approvaltransactionrelocation'   => 'AssetData\ApprovalTransactionRelocationController',
            'auditrail'    => 'Report\AuditController'
        ]);
 
        // Master Print - Export - Import
        // A
                /* =========== AssetClass Print= */
                Route::get('assetclass_export_excel','Master\AssetClassController@export')->name('assetclass_export');
                Route::get('assetclass_print','Master\AssetClassController@print')->name('assetclass_print');
                Route::post('/assetclass/import_excel', 'Master\AssetClassController@import_excel')->name('assetclass.import');
                /* =========== Accountchart Print= */
                Route::get('accountchart_export_excel','Master\AccountChartController@export')->name('accountchart_export');
                Route::get('accountchart_print','Master\AccountChartController@print')->name('accountchart_print');
                Route::post('/accountchart/import_excel', 'Master\AccountChartController@import_excel')->name('accountchart.import');
                 /* =========== Asset Type Print= */
                Route::get('assetstype_export_excel','Master\AssetTypeController@export')->name('assettype_export');
                Route::get('assettype_print','Master\AssetTypeController@print')->name('assettype_print');
                Route::post('/assettype/import_excel', 'Master\AssettypeController@import_excel')->name('assettype.import');
                 /* =========== Asset Status Print= */
                Route::get('assetstatus_export_excel','Master\AssetStatusController@export')->name('assetstatus_export');
                Route::get('assetsstatus_print','Master\AssetStatusController@print')->name('assetstatus_print');
                Route::post('/assetstatus/import_excel', 'Master\AssetStatusController@import_excel')->name('assetstatus.import');
        // C
                /* =========== Condition Print= */
                Route::get('condition_export_excel','Master\ConditionController@export')->name('condition_export');
                Route::get('condition_print','Master\ConditionController@print')->name('condition_print');
                Route::post('/condition/import_excel', 'Master\ConditionController@import_excel')->name('condition.import');
                /* =========== CostCenter Print= */
                Route::get('costcenter_export_excel','Master\CostCenterController@export')->name('costcenter_export');
                Route::get('costcenter_print','Master\CostCenterController@print')->name('costcenter_print');
                Route::post('/costcenter/import_excel', 'Master\CostCenterController@import_excel')->name('costcenter.import');
                /* =========== CostGroup Print= */
                Route::get('costgroup_export_excel','Master\CostGroupController@export')->name('costgroup_export');
                Route::get('costgroup_print','Master\CostGroupController@print')->name('costgroup_print');
                Route::post('/costgroup/import_excel', 'Master\CostGroupController@import_excel')->name('costgroup.import');
                /* =========== Custodian Print= */ 
                Route::get('custodian_export_excel','Master\CustodianController@export')->name('custodian_export');
                Route::get('custodian_print','Master\CustodianController@print')->name('custodian_print');
                Route::post('/custodian/import_excel', 'Master\CustodianController@import_excel')->name('custodian.import');
        // D
                /* =========== Departement Print= */
                Route::get('departement_export_excel','Master\DepartementController@export')->name('departement_export');
                Route::get('departement_print','Master\DepartementController@print')->name('departement_print');
                Route::post('/departeement/import_excel', 'Master\DepartementController@import_excel')->name('departement.import');
        // L
                /* =========== Location Print= */
                Route::get('location_export_excel','Master\LocationController@export')->name('location_export');
                Route::get('location_print','Master\LocationController@print')->name('location_print');
                Route::get('location_print_list','Master\LocationController@printlist')->name('location_print_list');
                Route::post('/location/import_excel', 'Master\LocationController@import_excel')->name('location.import');
        // O
                /* =========== Ownership Print= */
                Route::get('ownership_export_excel','Master\OwnershipController@export')->name('ownership_export');
                Route::get('ownership_print','Master\OwnershipController@print')->name('ownership_print');
                Route::post('/ownership/import_excel', 'Master\OwnershipController@import_excel')->name('ownership.import');
        // P
                /* =========== Provider Print= */
                Route::get('provider_export_excel','Master\ProviderController@export')->name('provider_export');
                Route::get('provider_print','Master\ProviderController@print')->name('provider_print');
                Route::post('/provider/import_excel', 'Master\ProviderController@import_excel')->name('provider.import');
        // V
                /* =========== Vendor Print= */
                Route::get('vendor_export_excel','Master\VendorController@export')->name('vendor_export');
                Route::get('vendor_print','Master\VendorController@print')->name('vendor_print');
                Route::post('/vendor/import_excel', 'Master\VendorController@import_excel')->name('vendor.import');
         
        /* =========== END MASTER PRINT =========== */
        // location wilayah
        Route::get('location_wilayah_json','Master\LocationAssetController@location_full')->name('location.full');
        // account group
        Route::get('accountGroup_json','Master\AccountChartController@accountGroup_json')->name('accountGroup_json');
        
        /* =========== END MASTER =========== */

        /* =========== ASSET REGISTER =========== */
        Route::resource('asset_register', 'Asset\RegisterAssetController');
        Route::delete('delete_file/{id}','Asset\RegisterAssetController@delete_file');
        Route::get('asset_qr','Asset\RegisterAssetController@asset_qr')->name('asset_qr');
        Route::post('import_asset','Asset\RegisterAssetController@import')->name('import_asset');
        // Route::get('asset_register','Asset\RegisterAssetController@index')->name('asset_register');
        /* =========== END ASSET REGISTER =========== */

        /* =========== ASSET DATA =========== */
        Route::get('asset_data','AssetData\AssetDataList@index')->name('asset_data');
        Route::get('asset_list','AssetData\AssetDataList@create')->name('asset_list');
        Route::get('asset_filter','AssetData\AssetDataList@show')->name('asset_filter');
        Route::get('print_qr','AssetData\AssetDataList@print_qr')->name('print_qr');
        Route::get('export_asset','AssetData\AssetDataList@export')->name('export_asset');

        /* =========== FILTER DATA LOCATION =========== */
        Route::get('get_sublocation','Master\SubLocationController@sublocation_filtered')->name('get_sublocation');
        Route::get('get_smlocation','Master\SmLocationController@smlocation_filtered')->name('get_smlocation');
        /* =========== END FILTER DATA LOCATION =========== */

        /* =========== END ASSET DATA =========== */

        /* =========== DEPRECIATION ============ */
        Route::get('depreciation','Depreciation\DepreciationController@index')->name('depreciation.index');
        Route::get('depreciation/{tag}','Depreciation\DepreciationController@show')->name('depreciation.show');
        Route::get('get_depreciation/{tag}','Depreciation\DepreciationController@get_asset')->name('get_depreciation');
        /* =========== END DEPRECIATION ============ */

        /* =========== ASSET TRANSACTIONS ============ */
        // Route::get('transactions','AssetData\AssetTransactionsController@index')->name('transactions.index');
        // Route::get('transactions/create','AssetData\AssetTransactionsController@create')->name('transactions.create');
        Route::post('disposal','AssetData\AssetTransactionController@disposal');
        Route::post('writeoff','AssetData\AssetTransactionController@writeoff');
        Route::post('revalue','AssetData\AssetTransactionController@revalue');
        Route::post('stocktake','AssetData\AssetTransactionController@stocktake');
        /* =========== END ASSET TRANSACTIONS ============ */

        /* APPROVAL */
        Route::patch('disposal/{id}','AssetData\ApprovalTransactionController@update_disposal');
        Route::patch('writeoff/{id}','AssetData\ApprovalTransactionController@update_writeoff');
        Route::patch('revalue/{id}','AssetData\ApprovalTransactionController@update_revalue');
        Route::patch('stocktake/{id}','AssetData\ApprovalTransactionController@update_stocktake');


        /* =========== SERVICE TOOLS ============ */
        Route::get('service','AssetData\ServiceToolsController@index')->name('service.index');
        Route::post('service','AssetData\ServiceToolsController@store')->name('service.store');
        /* =========== END SERVICE TOOLS ============ */

        /* =========== REPORT ============ */
        
        /* TRANSACTIONS */
        Route::get('report_t','Report\TransactionController@index')->name('report.t');
        Route::get('get_purchase','Report\TransactionController@get_purchase')->name('get.purchase');
        Route::get('get_disposal','Report\TransactionController@get_data')->name('get.disposal');
        Route::get('get_writeoff','Report\TransactionController@get_data')->name('get.writeoff');
        Route::get('get_revaluation','Report\TransactionController@get_data')->name('get.revaluation');
        Route::get('get_transfer','Report\TransactionController@get_data')->name('get.transfer');


        /* Report Transaction */
        Route::get('report_relocation','Report\TransactionController@reporttransfer_Excel')->name('report.transfer');
        Route::get('report_purchase','Report\TransactionController@purchase_Excel')->name('report.purchase');
        Route::get('report_service','Report\ServiceController@reportservice_Excel')->name('report.servicelog');
        Route::get('report_disposal','Report\TransactionController@reportdisposal_Excel')->name('report.disposal');
        Route::get('report_writeoff','Report\TransactionController@reportwriteoff_Excel')->name('report.writeoff');
        Route::get('report_revaluation','Report\TransactionController@revaluation_Excel')->name('revaluation_Excel');
        Route::get('report_stocktake','Report\StocktakeController@stocktake_Excel')->name('report.stocktake');
        

        /* Print Report */
        Route::get('print_stocktake','Report\StocktakeController@printStockTake')->name('print.stocktake');
        Route::get('print_servicelog','Report\ServiceController@printServiceLog')->name('print.servicelog');
        Route::get('print_purchase','Report\TransactionController@printPurchase')->name('print.purchase');
        Route::get('print_disposal','Report\TransactionController@printDisposal')->name('print.disposal');
        Route::get('print_writeoff','Report\TransactionController@printWriteoff')->name('print.writeoff');
        Route::get('print_revaluation','Report\TransactionController@printRevaluation')->name('print.revaluation');
        Route::get('print_relocation','Report\TransactionController@printRelocation')->name('print.relocation');


        /* JOURNAL */
        Route::get('report_j','Report\JournalController@index')->name('report.j');
        Route::get('get_journal','Report\JournalController@get_data')->name('get.journal');
        
        /* SERVICE */
        Route::get('report_sl','Report\ServiceController@index')->name('report.sl');
        Route::get('get_service','Report\ServiceController@get_data')->name('get.service');
     
        /* STOCK TAKE */
        Route::get('report_st','Report\StockTakeController@index')->name('report.st');
        Route::get('get_stocktake','Report\StockTakeController@get_data')->name('get.stocktake');

        /* SUMARRY ASSET */
        Route::get('report_sa','Report\SumarryController@index')->name('report.sa');
        Route::get('get_sumarry','Report\SumarryController@get_data')->name('get.sumarry');
        Route::get('get_fa','Report\SumarryController@get_data_fa')->name('get.fa');
        Route::get('export_summary','Report\SumarryController@export_summary')->name('export.summary');
        Route::get('export_fa','Report\SumarryController@export_fa')->name('export.fa');
        
        /* ASSET HISTORY */ 
        Route::get('report_h','Report\AssetHistoryController@index')->name('report.h');
        Route::get('get_history','Report\AssetHistoryController@get_data')->name('get.history');
        
        /* =========== END REPORT ============ */
    });

});

/* =========== END MIDDLEWARE AUTH =========== */
