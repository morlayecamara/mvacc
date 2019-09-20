<?php

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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/percent', 'PercentController@index')->name('percent')->middleware('auth');

Route::get('/getChildren', 'PercentController@get')->name('get')->middleware('auth');

Route::get('/addBady.php', 'AddChildrenController@index')->name('addBady');

Route::get('/update_age_children', 'AgeUpdateController@updateChildren')->name('update_age_children')->middleware('auth');
Route::get('/update_age_children_one', 'AgeUpdateController@updateChildrenOne')->name('update_age_children_one')->middleware('auth');
Route::get('/update_age_children_two', 'AgeUpdateController@updateChildrenTwo')->name('update_age_children_two')->middleware('auth');
Route::get('/update_age_children_three', 'AgeUpdateController@updateChildrenThree')->name('update_age_children_three')->middleware('auth');

Route::get('/update_age_percent', 'AgeUpdateController@updatePercent')->name('update_age_percent')->middleware('auth');
Route::get('/update_age_percent_one', 'AgeUpdateController@updatePercentOne')->name('update_age_percent_one')->middleware('auth');
Route::get('/update_age_percent_two', 'AgeUpdateController@updatePercentTwo')->name('update_age_percent_two')->middleware('auth');
Route::get('/update_age_percent_three', 'AgeUpdateController@updatePercentThree')->name('update_age_percent_three')->middleware('auth');

//children
Route::get('/communities', 'Children\CommunityRegisterController@index')->name('communities')->middleware('auth');
Route::get('/children_community_json', 'Children\CommunityRegisterController@getData')->name('children_community_json')->middleware('auth');

//provinces
Route::get('/provinces', 'Provinces\ProvincesController@index')->name('provinces')->middleware('auth');
Route::get('/province', 'Provinces\ProvincesController@province')->name('province')->middleware('auth');
Route::get('/province_blog_one', 'Provinces\BlogController@blogOne')->name('province_blog_one')->middleware('auth');
Route::get('/province_blog_two', 'Provinces\BlogController@blogTwo')->name('province_blog_two')->middleware('auth');
Route::get('/province_blog_three', 'Provinces\BlogController@blogThree')->name('province_blog_three')->middleware('auth');
Route::get('/province_blog_four', 'Provinces\BlogController@blogFour')->name('province_blog_four')->middleware('auth');
Route::get('/pie_province_json', 'Json\Chart\Pie\Provinces\ProvinceController@getData')->name('pie_province_json')->middleware('auth');
Route::get('/carte_province_json', 'Json\Carte\Provinces\ProvinceController@getData')->name('carte_province_json')->middleware('auth');
Route::get('/dropout_province_json', 'Json\Dropout\Provinces\ProvinceController@getData')->name('dropout_province_json')->middleware('auth');
Route::get('/bar_province_json', 'Json\Chart\Bar\Provinces\ProvinceController@getData')->name('bar_province_json')->middleware('auth');
Route::get('/communities_province', 'Children\Province\CommunityRegisterController@index')->name('communities_province')->middleware('auth');
Route::get('/children_community_province_json', 'Children\Province\CommunityRegisterController@getData')->name('children_community_province_json')->middleware('auth');
//districts
Route::get('/carte_district_json', 'Json\Carte\Districts\DistrictController@getData')->name('carte_district_json')->middleware('auth');
Route::get('/districts', 'Districts\DistrictsController@index')->name('districts')->middleware('auth');
Route::get('/district', 'Districts\DistrictsController@pagedistrict')->name('district')->middleware('auth');
Route::get('/communities_district', 'Children\District\CommunityRegisterController@index')->name('communities_district')->middleware('auth');
Route::get('/children_community_district_json', 'Children\District\CommunityRegisterController@getData')->name('children_community_district_json')->middleware('auth');

//facility
Route::get('/facilities', 'Facilitys\FacilitysController@index')->name('facilities')->middleware('auth');
Route::get('/carte_facility_json', 'Json\Carte\Facility\FacilityController@getData')->name('carte_facility_json')->middleware('auth');
Route::get('/facility', 'Facilitys\FacilitysController@pagefacility')->name('facility')->middleware('auth');
Route::get('/communities_facility', 'Children\Facility\CommunityRegisterController@index')->name('communities_facility')->middleware('auth');
Route::get('/children_community_facility_json', 'Children\Facility\CommunityRegisterController@getData')->name('children_community_facility_json')->middleware('auth');

//zones
Route::get('/zones', 'Zones\ZonesController@index')->name('zones')->middleware('auth');
Route::get('/carte_zone_json', 'Json\Carte\Zone\ZoneController@getData')->name('carte_zone_json')->middleware('auth');
Route::get('/zone', 'Zones\ZonesController@pagezone')->name('zone')->middleware('auth');
Route::get('/communities_zone', 'Children\Zone\CommunityRegisterController@index')->name('communities_zone')->middleware('auth');
Route::get('/children_community_zone_json', 'Children\Zone\CommunityRegisterController@getData')->name('children_community_zone_json')->middleware('auth');

//vaccine
Route::get('/bcg', 'Vaccine\BcgController@index')->name('bcg')->middleware('auth');
Route::get('/opv', 'Vaccine\OpvController@index')->name('opv')->middleware('auth');
Route::get('/dtp', 'Vaccine\DtpController@index')->name('dtp')->middleware('auth');
Route::get('/pcv', 'Vaccine\PcvController@index')->name('pcv')->middleware('auth');
Route::get('/rota', 'Vaccine\RotaController@index')->name('rota')->middleware('auth');
Route::get('/measles', 'Vaccine\MeaslesController@index')->name('measles')->middleware('auth');

//users
Route::get('/lister', 'AddUserController@lister')->name('lister')->middleware('auth');
Route::get('/lister-json', 'AddUserController@listerJson')->name('lister-json')->middleware('auth');
Route::get('/add', 'AddUserController@add')->name('add')->middleware('auth');
Route::post('/add-user', 'AddUserController@register')->name('add-user')->middleware('auth');

//metrics
Route::get('/metrics', 'Metrics\MetricsController@index')->name('metrics')->middleware('auth');
Route::get('/metrics_province', 'Metrics\MetricsController@province')->name('metrics_province')->middleware('auth');
Route::get('/metrics_district', 'Metrics\MetricsController@district')->name('metrics_district')->middleware('auth');
Route::get('/metrics_facility', 'Metrics\MetricsController@facility')->name('metrics_facility')->middleware('auth');
Route::get('/metrics_zone', 'Metrics\MetricsController@zone')->name('metrics_zone')->middleware('auth');

Route::get('/age', 'AgeController@getAge')->name('age')->middleware('auth');
//blog 
Route::get('/blog_one', 'BlogController@blogOne')->name('blog_one')->middleware('auth');
Route::get('/blog_two', 'BlogController@blogTwo')->name('blog_two')->middleware('auth');
Route::get('/blog_three', 'BlogController@blogThree')->name('blog_three')->middleware('auth');
Route::get('/blog_four', 'BlogController@blogFour')->name('blog_four')->middleware('auth');
Route::get('/blog_metrics_four', 'Metrics\BlogController@blogMetricsFour')->name('blog_metrics_four')->middleware('auth');

//carte
Route::get('/carte_overview_json', 'Json\Carte\OverviewController@getData')->name('carte_overview_json')->middleware('auth');
Route::get('/carte_bcg_json', 'Json\Carte\BcgController@getData')->name('carte_bcg_json')->middleware('auth');
Route::get('/carte_opv_json', 'Json\Carte\OpvController@getData')->name('carte_opv_json')->middleware('auth');
Route::get('/carte_dtp_json', 'Json\Carte\DtpController@getData')->name('carte_dtp_json')->middleware('auth');
Route::get('/carte_pcv_json', 'Json\Carte\PcvController@getData')->name('carte_pcv_json')->middleware('auth');
Route::get('/carte_rota_json', 'Json\Carte\RotaController@getData')->name('carte_rota_json')->middleware('auth');
Route::get('/carte_measles_json', 'Json\Carte\MeaslesController@getData')->name('carte_measles_json')->middleware('auth');

//pie
Route::get('/pie_overview_json', 'Json\Chart\Pie\OverviewController@getData')->name('pie_overview_json')->middleware('auth');
Route::get('/pie_metrics_json', 'Json\Chart\Pie\MetricsController@getData')->name('pie_metrics_json')->middleware('auth');
Route::get('/pie_bcg_json', 'Json\Chart\Pie\BcgController@getData')->name('pie_bcg_json')->middleware('auth');
Route::get('/pie_opv_json', 'Json\Chart\Pie\OpvController@getData')->name('pie_opv_json')->middleware('auth');
Route::get('/pie_dtp_json', 'Json\Chart\Pie\DtpController@getData')->name('pie_dtp_json')->middleware('auth');
Route::get('/pie_pcv_json', 'Json\Chart\Pie\PcvController@getData')->name('pie_pcv_json')->middleware('auth');
Route::get('/pie_rota_json', 'Json\Chart\Pie\RotaController@getData')->name('pie_rota_json')->middleware('auth');
Route::get('/pie_measles_json', 'Json\Chart\Pie\MeaslesController@getData')->name('pie_measles_json')->middleware('auth');

//dropout
Route::get('/dropout_overview_json', 'Json\Dropout\OverviewController@getData')->name('dropout_overview_json')->middleware('auth');

//bar
Route::get('/bar_overview_json', 'Json\Chart\Bar\OverviewController@getData')->name('bar_overview_json')->middleware('auth');

//line
Route::get('/line_metrics_json', 'Json\Chart\Line\MetricsController@getData')->name('line_metrics_json')->middleware('auth');
Route::get('/line_metrics_chw_json', 'Json\Chart\Line\MetricsController@getDataChw')->name('line_metrics_chw_json')->middleware('auth');

//tab
Route::get('/tab_overview_json', 'Json\Tab\OverviewController@getData')->name('tab_overview_json')->middleware('auth');
Route::get('/tab_district_json', 'Json\Tab\DistrictController@getData')->name('tab_district_json')->middleware('auth');
Route::get('/tab_facility_json', 'Json\Tab\FacilityController@getData')->name('tab_facility_json')->middleware('auth');
Route::get('/tab_zone_json', 'Json\Tab\ZoneController@getData')->name('tab_zone_json')->middleware('auth');

//ajax
Route::get('/ajax-district', 'Districts\DistrictsController@district')->name('ajax-district')->middleware('auth'); 
Route::get('/ajax-facility', 'Facilitys\FacilitysController@facility')->name('ajax-facility')->middleware('auth');
Route::get('/ajax-zone', 'Zones\ZonesController@zone')->name('ajax-zone')->middleware('auth');


//chw
Route::get('/chw', 'Chw\ChwController@index')->name('chw')->middleware('auth');
Route::get('/all_chw_json', 'Chw\ChwController@getDataChwAll')->name('all_chw_json')->middleware('auth');
Route::get('/chw_percent_json', 'Chw\ChwController@getDataChwPercent')->name('chw_percent_json')->middleware('auth');

Route::get('/chw_metrics_json', 'Chw\ChwController@getDataChwMetrics')->name('chw_metrics_json')->middleware('auth');