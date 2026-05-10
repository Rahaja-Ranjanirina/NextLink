<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\MainAuthController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PartnerAuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Student\CvController;
use App\Http\Controllers\Student\ForumController;
use App\Http\Controllers\Student\PrivateMessageController;

// ==================== ROUTES PUBLIQUES ====================
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// ==================== ROUTES D'AUTHENTIFICATION ====================
Route::get('/login', [MainAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [MainAuthController::class, 'login'])->name('login.submit');
Route::get('/password/forgot', [MainAuthController::class, 'showForgotPassword'])->name('forgot.password.request');
Route::post('/password/forgot', [MainAuthController::class, 'sendPasswordReset'])->name('forgot.password.email');
Route::post('/logout', [MainAuthController::class, 'logout'])->name('logout');

// ==================== ROUTES ÉTUDIANT ====================
Route::middleware(['auth', 'role:etudiant'])->prefix('student')->group(function () {
    Route::get('/dashboard', [EtudiantController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/offres', [EtudiantController::class, 'offres'])->name('student.offres');
    Route::get('/offres/{offre}', [EtudiantController::class, 'showOffre'])->name('student.offres.show');
    Route::post('/offres/{offre}/postuler', [EtudiantController::class, 'postuler'])->name('student.offres.postuler');
    Route::get('/profil', [EtudiantController::class, 'profil'])->name('student.profil');
    Route::post('/profil', [EtudiantController::class, 'updateProfil'])->name('student.profil.update');
    Route::get('/candidatures', [EtudiantController::class, 'mesCandidatures'])->name('student.candidatures');
    Route::get('/candidatures/{candidature}/jitsi', [MeetingController::class, 'studentJoinJitsi'])->name('student.candidatures.jitsi');
    Route::get('/notifications', [EtudiantController::class, 'notifications'])->name('student.notifications');
    Route::post('/notifications/{notification}/read', [EtudiantController::class, 'markNotificationRead'])->name('student.notifications.read');

    Route::get('/forum', [ForumController::class, 'index'])->name('student.forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('student.forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('student.forum.store');
    Route::get('/forum/{topic}', [ForumController::class, 'show'])->name('student.forum.show');
    Route::post('/forum/{topic}/messages', [ForumController::class, 'storeMessage'])->name('student.forum.message.store');

    // MESSAGES PRIVÉS - CORRIGÉ
    Route::get('/messages', [PrivateMessageController::class, 'index'])->name('student.messages.index');
    Route::get('/messages/{user}', [PrivateMessageController::class, 'chat'])->name('student.messages.chat'); // Changé {student} à {user}
    Route::post('/messages/store', [PrivateMessageController::class, 'store'])->name('student.messages.store');

    Route::post('/cv/update', [CvController::class, 'update'])->name('student.cv.update');
    Route::get('/cv/download', [CvController::class, 'download'])->name('student.cv.download');
});

// ==================== ROUTES ENSEIGNANT ====================
Route::middleware(['auth', 'role:enseignant'])->prefix('enseignant')->group(function () {
    Route::get('/dashboard', [EnseignantController::class, 'dashboard'])->name('enseignant.dashboard');

    Route::get('/etudiants', [EnseignantController::class, 'etudiants'])->name('enseignant.etudiants');
    Route::get('/etudiants/create', [EnseignantController::class, 'createEtudiant'])->name('enseignant.etudiants.create');
    Route::post('/etudiants', [EnseignantController::class, 'storeEtudiant'])->name('enseignant.etudiants.store');
    Route::get('/etudiants/{etudiant}/edit', [EnseignantController::class, 'editEtudiant'])->name('enseignant.etudiants.edit');
    Route::put('/etudiants/{etudiant}', [EnseignantController::class, 'updateEtudiant'])->name('enseignant.etudiants.update');
    Route::delete('/etudiants/{etudiant}', [EnseignantController::class, 'destroyEtudiant'])->name('enseignant.etudiants.destroy');
    Route::get('/etudiants/{etudiant}', [EnseignantController::class, 'showEtudiant'])->name('enseignant.etudiants.show');

    Route::get('/offres', [EnseignantController::class, 'offres'])->name('enseignant.offres');
    Route::get('/offres/create', [EnseignantController::class, 'createOffre'])->name('enseignant.offres.create');
    Route::post('/offres', [EnseignantController::class, 'storeOffre'])->name('enseignant.offres.store');
    Route::get('/offres/{offre}/edit', [EnseignantController::class, 'editOffre'])->name('enseignant.offres.edit');
    Route::put('/offres/{offre}', [EnseignantController::class, 'updateOffre'])->name('enseignant.offres.update');
    Route::delete('/offres/{offre}', [EnseignantController::class, 'destroyOffre'])->name('enseignant.offres.destroy');

    // Messages privés pour enseignant
    Route::get('/messages/{user}', [PrivateMessageController::class, 'enseignantChat'])->name('enseignant.messages.chat');
    Route::post('/messages/store', [PrivateMessageController::class, 'enseignantStore'])->name('enseignant.messages.store');
    Route::get('/etudiants/{user}/profile', [EnseignantController::class, 'showStudentProfile'])->name('enseignant.etudiants.profile');
});

// ==================== ROUTES ADMIN ====================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['auth', 'role:superadmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/student/store', [AdminDashboardController::class, 'storeStudent'])->name('admin.student.store');
    Route::get('/students/{student}/edit', [AdminDashboardController::class, 'editStudent'])->name('admin.students.edit');
    Route::put('/students/{student}', [AdminDashboardController::class, 'updateStudent'])->name('admin.students.update');
    Route::delete('/students/{student}', [AdminDashboardController::class, 'destroyStudent'])->name('admin.students.destroy');
    Route::post('/partner/store', [AdminDashboardController::class, 'storePartner'])->name('admin.partner.store');
    Route::post('/enseignant/store', [AdminDashboardController::class, 'storeEnseignant'])->name('admin.enseignant.store');
    Route::get('/enseignants/{enseignant}/edit', [AdminDashboardController::class, 'editEnseignant'])->name('admin.enseignants.edit');
    Route::put('/enseignants/{enseignant}', [AdminDashboardController::class, 'updateEnseignant'])->name('admin.enseignants.update');
    Route::delete('/enseignants/{enseignant}', [AdminDashboardController::class, 'destroyEnseignant'])->name('admin.enseignants.destroy');
    
    Route::post('/users/{user}/make-moderator', [AdminDashboardController::class, 'makeModerator'])->name('admin.users.make-moderator');
    Route::post('/users/{user}/remove-moderator', [AdminDashboardController::class, 'removeModerator'])->name('admin.users.remove-moderator');
});

// ==================== ROUTES SUPERADMIN ====================
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/enseignants', [SuperAdminController::class, 'enseignants'])->name('superadmin.enseignants');
    Route::get('/enseignants/create', [SuperAdminController::class, 'createEnseignant'])->name('superadmin.enseignants.create');
    Route::post('/enseignants', [SuperAdminController::class, 'storeEnseignant'])->name('superadmin.enseignants.store');
    Route::get('/enseignants/{enseignant}/edit', [SuperAdminController::class, 'editEnseignant'])->name('superadmin.enseignants.edit');
    Route::put('/enseignants/{enseignant}', [SuperAdminController::class, 'updateEnseignant'])->name('superadmin.enseignants.update');
    Route::delete('/enseignants/{enseignant}', [SuperAdminController::class, 'destroyEnseignant'])->name('superadmin.enseignants.destroy');

    Route::get('/etudiants', [SuperAdminController::class, 'etudiants'])->name('superadmin.etudiants');
    Route::get('/etudiants/{etudiant}/edit', [SuperAdminController::class, 'editEtudiant'])->name('superadmin.etudiants.edit');
    Route::put('/etudiants/{etudiant}', [SuperAdminController::class, 'updateEtudiant'])->name('superadmin.etudiants.update');
    Route::delete('/etudiants/{etudiant}', [SuperAdminController::class, 'destroyEtudiant'])->name('superadmin.etudiants.destroy');

    Route::get('/entreprises', [SuperAdminController::class, 'entreprises'])->name('superadmin.entreprises');
});

// ==================== ROUTES PARTENAIRE ====================
Route::prefix('partner')->group(function () {
    Route::get('/login', [PartnerAuthController::class, 'showLogin'])->name('partner.login');
    Route::post('/login', [PartnerAuthController::class, 'login'])->name('partner.login.submit');
});

Route::middleware(['auth', 'role:entreprise'])->prefix('partner')->group(function () {
    Route::get('/dashboard', [PartnerController::class, 'dashboard'])->name('partner.dashboard');
    Route::get('/offres', [PartnerController::class, 'offres'])->name('partner.offres');
    Route::get('/offres/create', [PartnerController::class, 'createOffre'])->name('partner.offres.create');
    Route::post('/offres', [PartnerController::class, 'storeOffre'])->name('partner.offres.store');
    Route::get('/offres/{offre}/candidatures', [PartnerController::class, 'candidatures'])->name('partner.offres.candidatures');
    Route::get('/offres/{offre}/candidatures/{candidature}', [PartnerController::class, 'showCandidature'])->name('partner.candidatures.show');
    Route::post('/offres/{offre}/candidatures/{candidature}/inviter', [PartnerController::class, 'inviteCandidature'])->name('partner.candidatures.invite');
    Route::get('/offres/{offre}/candidatures/{candidature}/jitsi/start', [MeetingController::class, 'startJitsiMeeting'])->name('partner.candidatures.jitsi.start');
    Route::get('/offres/{offre}/candidatures/{candidature}/jitsi', [MeetingController::class, 'partnerJoinJitsi'])->name('partner.candidatures.jitsi');
    Route::get('/notifications', [PartnerController::class, 'notifications'])->name('partner.notifications');
    Route::post('/notifications/{notification}/read', [PartnerController::class, 'markNotificationRead'])->name('partner.notifications.read');
    Route::get('/candidatures/{candidature}/download/{type}', [PartnerController::class, 'downloadCandidature'])->name('partner.candidatures.download');
    Route::post('/logout', [PartnerAuthController::class, 'logout'])->name('partner.logout');
});

// ==================== REDIRECTION ====================
Route::get('/dashboard', function () {
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'role:etudiant'])->name('dashboard');
