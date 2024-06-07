<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\AdminController;
use App\Models\Chamado;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login_process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('password/forgot', [AuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('password/forgot', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}/{email}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::put('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');




Route::get('/chamados', [ChamadoController::class, 'index'])->name('chamados.index');
Route::get('/chamados/create', [ChamadoController::class, 'create'])->name('chamados.create');
Route::post('/chamados', [ChamadoController::class, 'storeChamado'])->name('chamados.store');
Route::get('/chamados/{id}/edit', [ChamadoController::class, 'editChamado'])->name('chamados.edit');
Route::put('/chamados/{id}', [ChamadoController::class, 'updateChamado'])->name('chamados.update');
Route::delete('/chamados/{id}', [ChamadoController::class, 'deleteChamado'])->name('chamados.delete');
Route::get('/chamados/{chamado_id}/feedback', [ChamadoController::class, 'showFeedbackForm'])->name('chamados.feedback');
Route::put('/chamados/{chamado_id}/feedback', [ChamadoController::class, 'insertFeedback'])->name('chamados.feedback.insert');





Route::get('/admin', [AdminController::class, 'adminIndex'])->name('admin.index');
Route::get('/admin/filter', [AdminController::class, 'filterByStatus'])->name('admin.filterByStatus');
Route::post('/admin/accept/{id}', [AdminController::class, 'acceptChamado'])->name('admin.acceptChamado');
Route::post('/admin/solve/{id}', [AdminController::class, 'solveChamado'])->name('admin.solveChamado');
Route::get('/admin/users',[AdminController::class,'listarUsuarios'])->name('admin.user');
Route::get('/admin/graphics', [AdminController::class, 'returnGraphics'])->name('admin.graphics');
