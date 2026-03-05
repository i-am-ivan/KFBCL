<?php



use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Auth\SigninController;

use App\Http\Controllers\AppointmentController;

use App\Http\Controllers\UserRolesController;

use App\Http\Controllers\UsersController;

use App\Http\Controllers\BodabodaController;

use Illuminate\Support\Facades\DB;

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider and all of them will

| be assigned to the "web" middleware group. Make something great!

|

*/

// Redirect Laravel's default 'login' route to your 'signin' route

Route::get('/login', function () {

    return redirect()->route('signin');

})->name('login');

// Route for the root URL, which displays the sign-in page. ---------------

Route::get('/', function () {

    return view('auth.signin');

})->name('signin');



// Route for the signup page.

Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('signup');


// Registration routes

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/check-email', [RegisterController::class, 'checkEmail']);

Route::post('/check-phone', [RegisterController::class, 'checkPhone']);

// Appointments route -------------------------------------------------------------------------------------------------------------------------------------

Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/appointments/get-all', [AppointmentController::class, 'getAllAppointments']);

Route::get('/appointments/dashboard-stats', [AppointmentController::class, 'getDashboardStats']);

Route::get('/appointments/my-today-confirmed', [AppointmentController::class, 'getMyTodayConfirmedAppointments']);

Route::get('/appointments/my-today-confirmed-top10', [AppointmentController::class, 'getMyTodayConfirmedTop10']);

Route::post('/appointments/update', [AppointmentController::class, 'update'])->name('appointments.update');

Route::delete('/appointments/delete', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

// User Roles routes --------------------------------------------------------------------------------------------------------------------------------------

Route::get('/user-roles/count', [UserRolesController::class, 'getAllCountUserRoles'])->name('user-roles.count');

Route::get('/user-roles/active-count', [UserRolesController::class, 'getAllCountActiveUserRoles'])->name('user-roles.active-count');

Route::post('/user-roles/create', [UserRolesController::class, 'createNewUserRole'])->name('user-roles.create');

Route::post('/user-roles/{id}/update', [UserRolesController::class, 'updateUserRole'])->name('user-roles.update');

Route::delete('/user-roles/{id}/delete', [UserRolesController::class, 'deleteUserRole'])->name('user-roles.delete');

// Create new system user Routes
Route::post('/users/create', [UsersController::class, 'store']);

Route::post('/check-email', [UsersController::class, 'checkEmail']);

Route::post('/check-phone', [UsersController::class, 'checkPhone']);

// Main route for getting all roles
Route::get('/user-roles/all', [UserRolesController::class, 'getAllUserRoles'])->name('user-roles.all');

// User routes
Route::get('/users/dashboard-stats', [UsersController::class, 'getDashboardStats']);

Route::get('/users/all', [UsersController::class, 'getAllUsers']);

Route::get('/user-roles/all', [UsersController::class, 'getAllUserRoles']);

// Signin routes - ADD THESE
Route::get('/signin', [SigninController::class, 'showSigninForm'])->name('signin.form');

Route::post('/signin', [SigninController::class, 'signin'])->name('signin');

// User Management forgot password
Route::post('/users/reset-password', [UsersController::class, 'resetPassword'])->name('users.reset-password');

// Update system users data
Route::post('/users/update-user', [UsersController::class, 'updateSystemUser'])->name('users.update-user');

// Delete system user from system
Route::post('/users/delete-user', [UsersController::class, 'deleteSystemUser'])->name('users.delete-user');

// Bodaboda module management ----------------------------------------------------------------------------------------------------------
// Members
Route::get('/members/all', [BodabodaController::class, 'listAllMembers']);

Route::get('/treasurer/bodaboda-member/{memberId}/data', [BodabodaController::class, 'getAllMemberData']);

Route::get('/bodaboda-member/{memberId}/kins', [BodabodaController::class, 'getMemberKins']);

Route::get('/bodaboda-member/{memberId}/contributions', [BodabodaController::class, 'getAllMemberContributions']);

Route::get('/bodaboda-member/{memberId}/savings', [BodabodaController::class, 'getAllMemberSavings']);

Route::get('/bodaboda-member/{memberId}/fines', [BodabodaController::class, 'getAllMemberFines']);

Route::post('/bodaboda-member/{memberId}/update-personal', [BodabodaController::class, 'updateMemberPersonalInfo']);

Route::post('/bodaboda-member/{memberId}/update-identification', [BodabodaController::class, 'updateIdentificationDocuments']);

Route::post('/bodaboda-member/{memberId}/kin/add', [BodabodaController::class, 'addMemberKin']);

Route::post('/bodaboda-member/{memberId}/kin/{kinId}/update', [BodabodaController::class, 'updateMemberKin']);

Route::post('/bodaboda-member/{memberId}/kin/{kinId}/delete', [BodabodaController::class, 'deleteMemberKin']);

Route::post('/bodaboda-member/{memberId}/vehicle/add', [BodabodaController::class, 'addMemberVehicle']);

Route::post('/bodaboda-member/{memberId}/vehicle/{vehicleId}/update', [BodabodaController::class, 'updateMemberVehicle']);

Route::post('/bodaboda-member/{memberId}/vehicle/{vehicleId}/delete', [BodabodaController::class, 'deleteMemberVehicle']);

Route::get('/stats/members/member', [BodabodaController::class, 'countMembers']);

Route::get('/stats/members/non-member', [BodabodaController::class, 'countNonMembers']);

// Vehicle assignment routes
Route::get('/bodaboda-member/{memberId}/vehicles/available', [BodabodaController::class, 'getAvailableMemberVehicles']);

Route::post('/bodaboda-member/{memberId}/vehicle/assign', [BodabodaController::class, 'assignMemberVehicle']);

Route::post('/bodaboda-member/{memberId}/vehicle/reassign', [BodabodaController::class, 'reassignMemberVehicle']);

Route::get('/bodaboda-member/{memberId}/vehicles/assigned', [BodabodaController::class, 'getMemberAssignedVehicles']);

Route::get('/members/count', [BodabodaController::class, 'countAllMembers']);

Route::post('/treasurer/bodaboda/add-member', [BodabodaController::class, 'addMember'])->name('treasurer.bodaboda.addMember');

// Stages
Route::post('/treasurer/bodaboda/stages', [BodabodaController::class, 'storeStage'])->name('treasurer.bodaboda.store');

Route::get('/stages/all', [BodabodaController::class, 'listAllStages']);

Route::get('/stages/count', [BodabodaController::class, 'countAllStages']);

Route::get('/stages/all', [BodabodaController::class, 'getAllStagesData'])->name('get.all.stages');

Route::post('/treasurer/bodaboda/stages/update', [BodabodaController::class, 'updateStageDetails'])->name('treasurer.bodaboda.update');

Route::post('/treasurer/bodaboda/stages/delete', [BodabodaController::class, 'deleteStageLocation'])->name('treasurer.bodaboda.delete');

// Members transactions
// Bonus Types
Route::post('/treasurer/bodaboda/bonus-types/update', [BodabodaController::class, 'updateBonusType'])->name('treasurer.bodaboda.bonus-types.update');

Route::post('/treasurer/bodaboda/bonus-types/delete', [BodabodaController::class, 'deleteBonusType'])->name('treasurer.bodaboda.bonus-types.delete');

// Fine Types
Route::post('/treasurer/bodaboda/fine-types/update', [BodabodaController::class, 'updateFineType'])->name('treasurer.bodaboda.fine-types.update');

Route::post('/treasurer/bodaboda/fine-types/delete', [BodabodaController::class, 'deleteFineType'])->name('treasurer.bodaboda.fine-types.delete');

// Vehicles ------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/bodaboda-member/{memberId}/vehicles/member/all', [BodabodaController::class, 'getAllMemberVehicleData']);

Route::get('/bodaboda-member/{memberId}/vehicles/member/count', [BodabodaController::class, 'getCountMemberVehicles']);

Route::get('/bodaboda-member/{memberId}/vehicles/nonmember/all', [BodabodaController::class, 'getAllNonMemberVehicleData']);

Route::get('/bodaboda-member/{memberId}/vehicles/nonmember/count', [BodabodaController::class, 'getCountNonMemberVehicles']);

// Vehicle Stats Routes
Route::get('/stats/vehicles/all', [BodabodaController::class, 'countAllVehicles']);

Route::get('/stats/vehicles/motorcycles', [BodabodaController::class, 'countAllMotorcycles']);

Route::get('/stats/vehicles/tuktuk', [BodabodaController::class, 'countAllTukTuks']);

Route::get('/member-bonus-types/count', [BodabodaController::class, 'countAllMemberBonusTypes']);

Route::get('/member-fine-types/count', [BodabodaController::class, 'countAllMemberFineTypes']);

// Loans --------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/member-transactions/count-active-loans', [BodabodaController::class, 'countActiveLoanTransactions']);

Route::get('/bodaboda/vehicles/count/all', [BodabodaController::class, 'getCountVehicles']);

// Your existing routes
Route::get('/bodaboda-member/{memberId}/vehicles/available', [BodabodaController::class, 'getAvailableMemberVehicles']);

Route::get('/member-loan-types/count', [BodabodaController::class, 'countAllMemberLoanTypes']);

Route::get('/bodaboda-member/{memberId}/loans/active/count', [BodabodaController::class, 'countAllMemberLoans']);

// Loans
Route::get('/loans/summary', [BodabodaController::class, 'getAllLoansSummary']);

Route::get('/member-bonus-types/all', [BodabodaController::class, 'getAllMemberBonusTypes']);

Route::get('/member-fine-types/all', [BodabodaController::class, 'getAllMemberFineTypes']);

Route::post('/loans/create', [BodabodaController::class, 'createNewLoanType']);

// Loan Types
Route::post('/treasurer/bodaboda/loan-types/update', [BodabodaController::class, 'updateLoanType'])->name('treasurer.bodaboda.loan-types.update');

Route::post('/treasurer/bodaboda/loan-types/delete', [BodabodaController::class, 'deleteLoanType'])->name('treasurer.bodaboda.loan-types.delete');

Route::get('/bodaboda-member/{memberId}/loans', [BodabodaController::class, 'getAllMemberLoans']);

// Loan Stats Routes
Route::get('/stats/loans/all', [BodabodaController::class, 'countAllLoansAwarded']);

Route::get('/stats/loans/active', [BodabodaController::class, 'countAllActiveLoans']);

Route::get('/stats/loans/bad', [BodabodaController::class, 'countAllBadLoans']);

Route::get('/stats/loans/monthly', [BodabodaController::class, 'getMonthlyLoans']);

Route::get('/stats/loans/status', [BodabodaController::class, 'getLoanStatusDistribution']);

// Loan routes
Route::get('/loans/all-data', [BodabodaController::class, 'getAllLoanData']);

Route::post('/bodaboda-member/{memberId}/loan/assign', [BodabodaController::class, 'assignMemberLoan']);

Route::post('/bodaboda-member/{memberId}/loan/repay', [BodabodaController::class, 'repayMemberLoan']);

Route::post('/bodaboda-member/{memberId}/loan/transaction/{transactionId}/update', [BodabodaController::class, 'updateMemberLoanTransaction']);

Route::get('/bodaboda-member/{memberId}/loans/current', [BodabodaController::class, 'getCurrentMemberLoans']);

// Contributions ------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/contributions/all', [BodabodaController::class, 'getAllContributions']);

Route::post('/bodaboda-member/{memberId}/contribute', [BodabodaController::class, 'makeMemberContribution']);

Route::post('/bodaboda-member/{memberId}/withdraw', [BodabodaController::class, 'withdrawMemberContribution']);

Route::post('/bodaboda-member/{memberId}/contribution/{transactionId}/update', [BodabodaController::class, 'updateMemberContribution']);
// Contribution balance routes
Route::get('/contributions/balance/total', [BodabodaController::class, 'getTotalContributionBalance']);

Route::get('/contributions/balance/member/{memberId}', [BodabodaController::class, 'getMemberContributionBalance']);

Route::get('/stats/contributions/monthly', [BodabodaController::class, 'getMonthlyContributions']);

// Savings ------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Member Savings Routes
Route::get('/bodaboda-member/{memberId}/savings', [BodabodaController::class, 'getMemberSavings']);

Route::get('/bodaboda-member/{memberId}/savings-balance', [BodabodaController::class, 'getMemberSavingsBalance']);

Route::post('/bodaboda-member/{memberId}/savings/add', [BodabodaController::class, 'makeMemberSavings']);

Route::post('/bodaboda-member/{memberId}/savings/withdraw', [BodabodaController::class, 'withdrawMemberSavings']);

Route::put('/bodaboda-member/{memberId}/savings/{transactionId}/edit', [BodabodaController::class, 'editMemberSavings']);

Route::get('/savings/all-balance', [BodabodaController::class, 'getAllMembersSavingsBalance']);

// Bonuses ------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/bonus-types/summary', [BodabodaController::class, 'getAllBonusTypesSummary']);

Route::post('/bonuses/create', [BodabodaController::class, 'createNewBonusType']);

// Fines --------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/fine-types/summary', [BodabodaController::class, 'getAllFineTypesSummary']);

Route::post('/fines/create', [BodabodaController::class, 'createNewFineType']);

// End bodaboda module manage ------------------------------------------------------------------------------------------------------------------------------------------------

Route::get('/forgotPassword', function () {

    return view('auth.forgotPassword');

})->name('forgotPassword');



// Route for the reset password page.

Route::get('/resetPassword', function () {

    return view('auth.resetPassword');

})->name('resetPassword');



// Dashboard routes (protected by auth middleware) ------------------------------------------------------------------------------------------------------------------------------
// Dashboard routes (protected by auth middleware)
Route::middleware('auth')->group(function () {

    Route::post('/signout', [SigninController::class, 'signout'])->name('signout');

    // ============================================
    // TREASURER ROUTES
    // ============================================
    Route::prefix('treasurer')->name('treasurer.')->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            return view('dashboards.Treasurer.dashboard');
        })->name('dashboard');

        // Appointments
        Route::get('/appointments', function () {
            return view('dashboards.Treasurer.appointments');
        })->name('appointments');

        // Users
        Route::get('/users', function () {
            return view('dashboards.Treasurer.users');
        })->name('users');

        // ============================================
        // BODABODA GROUP ROUTES
        // ============================================

        // Bodaboda Overview (bodaboda.blade.php)
        Route::get('/bodaboda/overview', function () {
            return view('dashboards.Treasurer.bodaboda');
        })->name('bodaboda.overview');

        // Members
        Route::get('/members', function () {
            return view('dashboards.Treasurer.members');
        })->name('members');

        // Vehicles
        Route::get('/vehicles', function () {
            return view('dashboards.Treasurer.vehicles');
        })->name('vehicles');

        // Stages
        Route::get('/stages', function () {
            return view('dashboards.Treasurer.stages');
        })->name('stages');

        // Bodaboda Loans (bodabodaloans.blade.php)
        Route::get('/bodaboda/loans', function () {
            return view('dashboards.Treasurer.bodabodaloans');
        })->name('bodaboda.loans');

        // Bodaboda Bonuses & Fines (bodabodabf.blade.php)
        Route::get('/bodaboda/bf', function () {
            return view('dashboards.Treasurer.bodabodabf');
        })->name('bodaboda.bf');

        // Bodaboda Contributions & Savings (contributions.blade.php)
        Route::get('/bodaboda/cs', function () {
            return view('dashboards.Treasurer.contributions');
        })->name('bodaboda.cs');

        // Bodaboda Member Detail (with parameter)
        Route::get('/bodaboda-member/{memberId}', function ($memberId) {
            return view('dashboards.Treasurer.bodabodaMember', ['memberId' => $memberId]);
        })->name('bodaboda.member');

        // ============================================
        // MICROFINANCE GROUP
        // ============================================
        Route::get('/microfinance/overview', function () {
            return view('dashboards.Treasurer.bodaboda'); // Using bodaboda as overview
        })->name('microfinance.overview');

        Route::get('/loan-types', function () {
            return view('dashboards.Treasurer.loantype');
        })->name('loan.types');

        Route::get('/microfinance/clients', function () {
            return view('dashboards.Treasurer.loansClient');
        })->name('microfinance.clients');

        Route::get('/microfinance/fines', function () {
            return view('dashboards.Treasurer.loansfines');
        })->name('microfinance.fines');

        // ============================================
        // REAL ESTATE GROUP
        // ============================================
        Route::get('/realestate/overview', function () {
            return view('dashboards.Treasurer.realEstate');
        })->name('realestate.overview');

        Route::get('/realestate/listings', function () {
            return view('dashboards.Treasurer.landclients');
        })->name('realestate.listings');

        Route::get('/realestate/clients', function () {
            return view('dashboards.Treasurer.landclients'); // Using landclients for clients
        })->name('realestate.clients');

        // Land Owner (if separate)
        Route::get('/land-owner', function () {
            return view('dashboards.Treasurer.landOwner');
        })->name('land.owner');
    });

    // ============================================
    // SUPERVISOR ROUTES
    // ============================================
    Route::prefix('supervisor')->name('supervisor.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboards.Supervisor.dashboard');
        })->name('dashboard');

        Route::get('/appointments', function () {
            return view('dashboards.Supervisor.appointments');
        })->name('appointments');

        Route::get('/bodaboda', function () {
            return view('dashboards.Supervisor.bodaboda');
        })->name('bodaboda');

        Route::get('/members', function () {
            return view('dashboards.Supervisor.members');
        })->name('members');

        Route::get('/contributions', function () {
            return view('dashboards.Supervisor.contributions');
        })->name('contributions');

        Route::get('/stages', function () {
            return view('dashboards.Supervisor.stages');
        })->name('stages');

        Route::get('/vehicles', function () {
            return view('dashboards.Supervisor.vehicles');
        })->name('vehicles');

        Route::get('/bodaboda-member/{memberId}', function ($memberId) {
            return view('dashboards.Supervisor.bodabodaMember', ['memberId' => $memberId]);
        })->name('bodaboda.member');
    });

    // ============================================
    // CHAIRMAN ROUTES
    // ============================================
    Route::prefix('chairman')->name('chairman.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboards.Chairman.dashboard');
        })->name('dashboard');

        Route::get('/appointments', function () {
            return view('dashboards.Chairman.appointments');
        })->name('appointments');

        Route::get('/bodaboda', function () {
            return view('dashboards.Chairman.bodaboda');
        })->name('bodaboda');

        Route::get('/loans', function () {
            return view('dashboards.Chairman.loans');
        })->name('loans');

        Route::get('/real-estate', function () {
            return view('dashboards.Chairman.realEstate');
        })->name('real.estate');

        Route::get('/users', function () {
            return view('dashboards.Chairman.users');
        })->name('users');
    });

    // ============================================
    // IT ROUTES
    // ============================================
    Route::prefix('it')->name('it.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboards.IT.dashboard');
        })->name('dashboard');

        Route::get('/appointments', function () {
            return view('dashboards.IT.appointments');
        })->name('appointments');

        Route::get('/bodaboda', function () {
            return view('dashboards.IT.bodaboda');
        })->name('bodaboda');

        Route::get('/members', function () {
            return view('dashboards.IT.members');
        })->name('members');

        Route::get('/vehicles', function () {
            return view('dashboards.IT.vehicles');
        })->name('vehicles');

        Route::get('/stages', function () {
            return view('dashboards.IT.stages');
        })->name('stages');

        Route::get('/contributions', function () {
            return view('dashboards.IT.contributions');
        })->name('contributions');

        Route::get('/savings', function () {
            return view('dashboards.IT.savings');
        })->name('savings');

        Route::get('/bonuses', function () {
            return view('dashboards.IT.bonuses');
        })->name('bonuses');

        Route::get('/loans', function () {
            return view('dashboards.IT.loans');
        })->name('loans');

        Route::get('/loans-client', function () {
            return view('dashboards.IT.loansClient');
        })->name('loans.client');

        Route::get('/fines', function () {
            return view('dashboards.IT.loansfines');
        })->name('fines');

        Route::get('/loan-types', function () {
            return view('dashboards.IT.loantype');
        })->name('loan.types');

        Route::get('/real-estate', function () {
            return view('dashboards.IT.realEstate');
        })->name('real.estate');

        Route::get('/land-clients', function () {
            return view('dashboards.IT.landclients');
        })->name('land.clients');

        Route::get('/users', function () {
            return view('dashboards.IT.users');
        })->name('users');

        Route::get('/profile', function () {
            return view('dashboards.IT.profile');
        })->name('profile');

        Route::get('/bodaboda-member/{memberId}', function ($memberId) {
            return view('dashboards.IT.bodabodaMember', ['memberId' => $memberId]);
        })->name('bodaboda.member');
    });

    // ============================================
    // SECRETARY ROUTES (using SecretaryGeneral folder)
    // ============================================
    Route::prefix('secretary')->name('secretary.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboards.SecretaryGeneral.dashboard');
        })->name('dashboard');

        Route::get('/appointments', function () {
            return view('dashboards.SecretaryGeneral.appointments');
        })->name('appointments');

        Route::get('/bodaboda', function () {
            return view('dashboards.SecretaryGeneral.bodaboda');
        })->name('bodaboda');

        Route::get('/loans', function () {
            return view('dashboards.SecretaryGeneral.loans');
        })->name('loans');

        Route::get('/real-estate', function () {
            return view('dashboards.SecretaryGeneral.realEstate');
        })->name('real.estate');

        Route::get('/users', function () {
            return view('dashboards.SecretaryGeneral.users');
        })->name('users');

        Route::get('/members', function () {
            return view('dashboards.SecretaryGeneral.members');
        })->name('members');

        Route::get('/vehicles', function () {
            return view('dashboards.SecretaryGeneral.vehicles');
        })->name('vehicles');

        Route::get('/land-clients', function () {
            return view('dashboards.SecretaryGeneral.landclients');
        })->name('land.clients');

        Route::get('/loans-client', function () {
            return view('dashboards.SecretaryGeneral.loansClient');
        })->name('loans.client');

        Route::get('/profile', function () {
            return view('dashboards.SecretaryGeneral.profile');
        })->name('profile');

        Route::get('/bodaboda-member/{memberId}', function ($memberId) {
            return view('dashboards.SecretaryGeneral.bodabodaMember', ['memberId' => $memberId]);
        })->name('bodaboda.member');
    });

    // ============================================
    // RECEPTIONIST ROUTES
    // ============================================
    Route::prefix('receptionist')->name('receptionist.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboards.Receptionist.dashboard');
        })->name('dashboard');

        Route::get('/appointments', function () {
            return view('dashboards.Receptionist.appointments');
        })->name('appointments');

        Route::get('/bodaboda', function () {
            return view('dashboards.Receptionist.bodaboda');
        })->name('bodaboda');

        Route::get('/members', function () {
            return view('dashboards.Receptionist.members');
        })->name('members');

        Route::get('/vehicles', function () {
            return view('dashboards.Receptionist.vehicles');
        })->name('vehicles');

        Route::get('/loans', function () {
            return view('dashboards.Receptionist.loans');
        })->name('loans');

        Route::get('/real-estate', function () {
            return view('dashboards.Receptionist.realEstate');
        })->name('real.estate');

        Route::get('/land-clients', function () {
            return view('dashboards.Receptionist.landclients');
        })->name('land.clients');

        Route::get('/loans-client', function () {
            return view('dashboards.Receptionist.loansClient');
        })->name('loans.client');

        Route::get('/users', function () {
            return view('dashboards.Receptionist.users');
        })->name('users');

        Route::get('/profile', function () {
            return view('dashboards.Receptionist.profile');
        })->name('profile');

        Route::get('/bodaboda-member/{memberId}', function ($memberId) {
            return view('dashboards.Receptionist.bodabodaMember', ['memberId' => $memberId]);
        })->name('bodaboda.member');
    });

    // ============================================
    // SUPERADMIN ROUTES
    // ============================================
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboards.SuperAdmin.dashboard');
        })->name('dashboard');

        // Add all SuperAdmin routes based on your files
        Route::get('/appointments', function () {
            return view('dashboards.SuperAdmin.appointments');
        })->name('appointments');

        Route::get('/bodaboda', function () {
            return view('dashboards.SuperAdmin.bodaboda');
        })->name('bodaboda');

        Route::get('/members', function () {
            return view('dashboards.SuperAdmin.members');
        })->name('members');

        Route::get('/vehicles', function () {
            return view('dashboards.SuperAdmin.vehicles');
        })->name('vehicles');

        Route::get('/stages', function () {
            return view('dashboards.SuperAdmin.stages');
        })->name('stages');

        Route::get('/contributions', function () {
            return view('dashboards.SuperAdmin.contributions');
        })->name('contributions');

        Route::get('/savings', function () {
            return view('dashboards.SuperAdmin.savings');
        })->name('savings');

        Route::get('/bonuses', function () {
            return view('dashboards.SuperAdmin.bonuses');
        })->name('bonuses');

        Route::get('/loans', function () {
            return view('dashboards.SuperAdmin.loans');
        })->name('loans');

        Route::get('/fines', function () {
            return view('dashboards.SuperAdmin.loansfines');
        })->name('fines');

        Route::get('/loan-types', function () {
            return view('dashboards.SuperAdmin.loantype');
        })->name('loan.types');

        Route::get('/loans-client', function () {
            return view('dashboards.SuperAdmin.loansClient');
        })->name('loans.client');

        Route::get('/real-estate', function () {
            return view('dashboards.SuperAdmin.realEstate');
        })->name('real.estate');

        Route::get('/land-clients', function () {
            return view('dashboards.SuperAdmin.landclients');
        })->name('land.clients');

        Route::get('/users', function () {
            return view('dashboards.SuperAdmin.users');
        })->name('users');

        Route::get('/profile', function () {
            return view('dashboards.SuperAdmin.profile');
        })->name('profile');

        Route::get('/bodaboda-member/{memberId}', function ($memberId) {
            return view('dashboards.SuperAdmin.bodabodaMember', ['memberId' => $memberId]);
        })->name('bodaboda.member');
    });

    // ============================================
    // DEFAULT DASHBOARD ROUTE (Role-based redirect)
    // ============================================
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // Clean the role name (remove spaces)
        $cleanRole = strtolower(preg_replace('/\s+/', '', $user->role));

        // Map roles to their view paths
        $roleViews = [
            'treasurer' => 'dashboards.Treasurer.dashboard',
            'supervisor' => 'dashboards.Supervisor.dashboard',
            'chairman' => 'dashboards.Chairman.dashboard',
            'it' => 'dashboards.IT.dashboard',
            'secretarygeneral' => 'dashboards.SecretaryGeneral.dashboard',
            'receptionist' => 'dashboards.Receptionist.dashboard',
            'superadmin' => 'dashboards.SuperAdmin.dashboard',
        ];

        $viewPath = $roleViews[$cleanRole] ?? 'dashboards.Receptionist.dashboard';

        return view($viewPath);
    })->name('dashboard');

    // ============================================
    // SHARED ROUTES (Accessible to all roles)
    // ============================================
    Route::get('/profile', function () {
        return view('dashboards.Shared.profile');
    })->name('profile');

});

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
