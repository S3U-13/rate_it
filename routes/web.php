<?php

use App\Http\Controllers\AboveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\EvaluationComponentsController;
use App\Http\Controllers\FurtherController;
use App\Http\Controllers\HeadShip01Controller;
use App\Http\Controllers\HeadShip02Controller;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RateItController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SelfController;
use App\Http\Controllers\SetIndicatorController;
use App\Http\Controllers\SetMainQuestionController;
use App\Http\Controllers\SetOtherQuestionController;
use App\Http\Controllers\SummarizeController;
use App\Http\Controllers\WitnessController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/page/capacity_rate_it/indicators/index', [IndicatorController::class, 'index'])->name('page.capacity_rate_it.indicators.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('page/user/index', [ChartController::class, 'index'])->name('page.user.index');

    Route::get('/page/rate_it/index', [RateItController::class, 'index'])->name('page.rate_it.index');
    Route::get('/page/rate_it/create/{id}', [RateItController::class, 'create'])->name('page.rate_it.create');
    Route::post('/page/rate_it/store', [RateItController::class, 'store'])->name('page.rate_it.store');

    Route::get('/page/capacity_rate_it/assessment_01/index', [HeadShip01Controller::class, 'index'])->name('page.capacity_rate_it.assessment_01.index');
    Route::get('/page/capacity_rate_it/assessment_01/create/{id}', [HeadShip01Controller::class, 'create'])->name('page.capacity_rate_it.assessment_01.create');
    Route::post('/page/capacity_rate_it/assessment_01/store', [HeadShip01Controller::class, 'store'])->name('page.capacity_rate_it.assessment_01.store');

    Route::get('/page/capacity_rate_it/assessment_02/index', [HeadShip02Controller::class, 'index'])->name('page.capacity_rate_it.assessment_02.index');
    Route::get('/page/capacity_rate_it/assessment_02/create/{id}', [HeadShip02Controller::class, 'create'])->name('page.capacity_rate_it.assessment_02.create');
    Route::post('/page/capacity_rate_it/assessment_02/store', [HeadShip02Controller::class, 'store'])->name('page.capacity_rate_it.assessment_02.store');

    Route::get('/page/capacity_rate_it/summarize/index', [SummarizeController::class, 'index'])->name('page.capacity_rate_it.summarize.index');
    Route::get('/page/capacity_rate_it/summarize/create/{id}', [SummarizeController::class, 'create'])->name('page.capacity_rate_it.summarize.create');
    Route::post('/page/capacity_rate_it/summarize/store', [SummarizeController::class, 'store'])->name('page.capacity_rate_it.summarize.store');

    Route::get('/page/capacity_rate_it/summarize/create_full_time_employee/{id}', [SummarizeController::class, 'create_full_time'])->name('page.capacity_rate_it.summarize.create_full_time_employee');

    Route::get('/page/capacity_rate_it/summarize/create_general_government_employee/{id}', [SummarizeController::class, 'create_general_government'])->name('page.capacity_rate_it.summarize.create_general_government_employee');

    Route::get('/page/capacity_rate_it/summarize/create_ministry_of_public_health_employee/{id}', [SummarizeController::class, 'create_ministry_of_public_health'])->name('page.capacity_rate_it.summarize.create_ministry_of_public_health_employee');

    Route::get('/page/capacity_rate_it/summarize/create_temporary_employee/{id}', [SummarizeController::class, 'create_temporary'])->name('page.capacity_rate_it.summarize.create_temporary_employee');

    Route::get('/page/capacity_rate_it/above/index', [AboveController::class, 'index'])->name('page.capacity_rate_it.above.index');
    Route::get('/page/capacity_rate_it/above/create/{id}', [AboveController::class, 'create'])->name('page.capacity_rate_it.above.create');
    Route::get('/page/capacity_rate_it/above/create_full_time_employee/{id}', [AboveController::class, 'create_full_time'])->name('page.capacity_rate_it.above.create_full_time_employee');
    Route::get('/page/capacity_rate_it/above/create_general_government__employee/{id}', [AboveController::class, 'create_general_government'])->name('page.capacity_rate_it.above.create_general_government_employee');
    Route::get('/page/capacity_rate_it/above/create_ministry_of_public_health_employee/{id}', [AboveController::class, 'create_ministry_of_public_health'])->name('page.capacity_rate_it.above.create_ministry_of_public_health_employee');
    Route::get('/page/capacity_rate_it/above/create_temporary_employee/{id}', [AboveController::class, 'create_temporary'])->name('page.capacity_rate_it.above.create_temporary_employee');
    Route::post('/page/capacity_rate_it/above/store', [AboveController::class, 'store'])->name('page.capacity_rate_it.above.store');

    Route::get('/page/capacity_rate_it/further/index', [FurtherController::class, 'index'])->name('page.capacity_rate_it.further.index');
    Route::get('/page/capacity_rate_it/further/create/{id}', [FurtherController::class, 'create'])->name('page.capacity_rate_it.further.create');
    Route::get('/page/capacity_rate_it/further/create_full_time_employee/{id}', [FurtherController::class, 'create_full_time'])->name('page.capacity_rate_it.further.create_full_time_employee');
    Route::get('/page/capacity_rate_it/further/create_general_government_employee/{id}', [FurtherController::class, 'create_general_government'])->name('page.capacity_rate_it.further.create_general_government_employee');
    Route::get('/page/capacity_rate_it/further/create_ministry_of_public_health_employee/{id}', [FurtherController::class, 'create_ministry_of_public_health'])->name('page.capacity_rate_it.further.create_ministry_of_public_health_employee');
    Route::get('/page/capacity_rate_it/further/create_temporary_employee/{id}', [FurtherController::class, 'create_temporary'])->name('page.capacity_rate_it.further.create_temporary_employee');
    Route::post('/page/capacity_rate_it/further/store', [FurtherController::class, 'store'])->name('page.capacity_rate_it.further.store');

    Route::get('/page/capacity_rate_it/self_rate_it/index', [SelfController::class, 'index'])->name('page.capacity_rate_it.self_rate_it.index');
    Route::get('/page/capacity_rate_it/self_rate_it/create/{id}', [SelfController::class, 'create'])->name('page.capacity_rate_it.self_rate_it.create');
    Route::post('/page/capacity_rate_it/self_rate_it/store', [SelfController::class, 'store'])->name('page.capacity_rate_it.self_rate_it.store');

    Route::get('/page/witness/index', [WitnessController::class, 'index'])->name('page.witness.index');
    Route::get('/page/witness/create/{id}', [WitnessController::class, 'create'])->name('page.witness.create');
    Route::get('/page/witness/create_full_time_employee/{id}', [WitnessController::class, 'create_full_time'])->name('page.witness.create_full_time_employee');
    Route::get('/page/witness/create_general_government_employee/{id}', [WitnessController::class, 'create_general_government'])->name('page.witness.create_general_government_employee');
    Route::get('/page/witness/create_ministry_of_public_health_employee/{id}', [WitnessController::class, 'create_ministry_of_public_health'])->name('page.witness.create_ministry_of_public_health_employee');
    Route::get('/page/witness/create_temporary_employee/{id}', [WitnessController::class, 'create_temporary'])->name('page.witness.create_temporary_employee');
    Route::post('/page/witness/store', [WitnessController::class, 'store'])->name('page.witness.store');


    Route::get('/page/result/index', [ResultController::class, 'index'])->name('page.result.index');

    Route::get('/page/result/show/{id}', [ResultController::class, 'show'])->name('page.result.show');
    Route::get('/page/result/show_full_time_employee/{id}', [ResultController::class, 'show_full_time'])->name('page.result.show_full_time_employee');
    Route::get('/page/result/show_general_government_employee/{id}', [ResultController::class, 'show_general_government'])->name('page.result.show_general_government_employee');
    Route::get('/page/result/show_ministry_of_public_health_employee/{id}', [ResultController::class, 'show_ministry_of_public_health'])->name('page.result.show_ministry_of_public_health_employee');
    Route::get('/page/result/show_temporary_employee/{id}', [ResultController::class, 'show_temporary'])->name('page.result.show_temporary_employee');

    Route::get('/page/result/create/{id}', [ResultController::class, 'create'])->name('page.result.create');
    Route::get('/page/result/create_full_time_employee/{id}', [ResultController::class, 'create_full_time'])->name('page.result.create_full_time_employee');
    Route::get('/page/result/create_general_government_employee/{id}', [ResultController::class, 'create_general_government'])->name('page.result.create_general_government_employee');
    Route::get('/page/result/create_ministry_of_public_health_employee/{id}', [ResultController::class, 'create_ministry_of_public_health'])->name('page.result.create_ministry_of_public_health_employee');
    Route::get('/page/result/create_temporary_employee/{id}', [ResultController::class, 'create_temporary'])->name('page.result.create_temporary_employee');

    Route::post('/page/result/store', [ResultController::class, 'store'])->name('page.result.store');

    Route::get('/page/profile/index', [ProfileController::class, 'index'])->name('page.profile.index');
    Route::get('/page/profile/create', [ProfileController::class, 'create'])->name('page.profile.create');
    Route::post('/page/profile/store', [ProfileController::class, 'store'])->name('page.profile.store');
    Route::get('/page/profile/edit', [ProfileController::class, 'edit'])->name('page.profile.edit');
    Route::put('/page/profile/update', [ProfileController::class, 'update'])->name('page.profile.update');
});


Route::middleware('admin')->group(function () {
    Route::get('/admin/index', [ChartController::class, 'index'])->name('admin.index');

    Route::get('/admin/personal/index', [PersonalController::class, 'index'])->name('admin.personal.index');
    Route::get('/admin/personal/create', [PersonalController::class, 'create_user'])->name('admin.personal.create');
    Route::post('/admin/personal/store', [PersonalController::class, 'store'])->name('admin.personal.store');
    Route::get('/admin/personal/edit/{id}', [PersonalController::class, 'edit_user'])->name('admin.personal.edit');
    Route::put('/admin/personal/update_user/{id}', [PersonalController::class, 'update_user'])->name('admin.personal.update_user');
    Route::post('/admin/personal/index', [PersonalController::class, 'updateRound'])->name('update.round');

    Route::get('/admin/evaluation_components/index', [EvaluationComponentsController::class, 'index'])->name('admin.evaluation_components.index');
    Route::get('/admin/evaluation_components/create_general', [EvaluationComponentsController::class, 'create_general'])->name('admin.evaluation_components.create_general');
    Route::get('/admin/evaluation_components/create_full_time', action: [EvaluationComponentsController::class, 'create_full_time'])->name('admin.evaluation_components.create_full_time');
    Route::post('/admin/evaluation_components/store_general', [EvaluationComponentsController::class, 'store_general'])->name('admin.evaluation_components.store_general');
    Route::post('/admin/evaluation_components/store_full_time', action: [EvaluationComponentsController::class, 'store_full_time'])->name('admin.evaluation_components.store_full_time');
    Route::get('/admin/evaluation_components/edit_general/{id}', [EvaluationComponentsController::class, 'edit_general'])->name('admin.evaluation_components.edit_general');
    Route::get('/admin/evaluation_components/edit_full_time/{id}', action: [EvaluationComponentsController::class, 'edit_full_time'])->name('admin.evaluation_components.edit_full_time');
    Route::put('/admin/evaluation_components/update_general/{id}', [EvaluationComponentsController::class, 'update_general'])->name('admin.evaluation_components.update_general');
    Route::put('/admin/evaluation_components/update_full_time/{id}', action: [EvaluationComponentsController::class, 'update_full_time'])->name('admin.evaluation_components.update_full_time');

    Route::get('/admin/set_main_question/index', [SetMainQuestionController::class, 'index'])->name('admin.set_main_question.index');
    Route::get('/admin/set_main_question/create', [SetMainQuestionController::class, 'create'])->name('admin.set_main_question.create');
    Route::post('/admin/set_main_question/store', [SetMainQuestionController::class, 'store'])->name('admin.set_main_question.store');
    Route::get('/admin/set_main_question/edit/{id}', [SetMainQuestionController::class, 'edit'])->name('admin.set_main_question.edit');
    Route::put('/admin/set_main_question/update/{id}', [SetMainQuestionController::class, 'update'])->name('admin.set_main_question.update');

    Route::get('/admin/set_other_question/index', [SetOtherQuestionController::class, 'index'])->name('admin.set_other_question.index');
    Route::get('/admin/set_other_question/create', [SetOtherQuestionController::class, 'create'])->name('admin.set_other_question.create');
    Route::post('/admin/set_other_question/store', [SetOtherQuestionController::class, 'store'])->name('admin.set_other_question.store');
    Route::get('/admin/set_other_question/edit/{id}', [SetOtherQuestionController::class, 'edit'])->name('admin.set_other_question.edit');
    Route::put('/admin/set_other_question/update/{id}', [SetOtherQuestionController::class, 'update'])->name('admin.set_other_question.update');

    Route::get('/admin/set_indicator/index', [SetIndicatorController::class, 'index'])->name('admin.set_indicator.index');
    Route::get('/admin/set_indicator/create', [SetIndicatorController::class, 'create'])->name('admin.set_indicator.create');
    Route::post('/admin/set_indicator/store', [SetIndicatorController::class, 'store'])->name('admin.set_indicator.store');
    Route::get('/admin/set_indicator/edit/{id}', [SetIndicatorController::class, 'edit'])->name('admin.set_indicator.edit');
    Route::put('/admin/set_indicator/update/{id}', [SetIndicatorController::class, 'update'])->name('admin.set_indicator.update');

    Route::get('/admin/profile/index', [ProfileController::class, 'index_admin'])->name('admin.profile.index');
    Route::get('/admin/profile/create', [ProfileController::class, 'create_admin'])->name('admin.profile.create');
    Route::post('admin/profile/store', [ProfileController::class, 'store_admin'])->name('admin.profile.store');
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit_admin'])->name('admin.profile.edit');
    Route::put('/admin/profile/update', [ProfileController::class, 'update_admin'])->name('admin.profile.update');
});
