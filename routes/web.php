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

Route::get('/bodaboda-member/{memberId}/loans', [BodabodaController::class, 'getAllMemberLoans']);

Route::get('/bodaboda-member/{memberId}/fines', [BodabodaController::class, 'getAllMemberFines']);

Route::post('/bodaboda-member/{memberId}/update-personal', [BodabodaController::class, 'updateMemberPersonalInfo']);

Route::post('/bodaboda-member/{memberId}/update-identification', [BodabodaController::class, 'updateIdentificationDocuments']);

Route::post('/bodaboda-member/{memberId}/kin/add', [BodabodaController::class, 'addMemberKin']);

Route::post('/bodaboda-member/{memberId}/kin/{kinId}/update', [BodabodaController::class, 'updateMemberKin']);

Route::post('/bodaboda-member/{memberId}/kin/{kinId}/delete', [BodabodaController::class, 'deleteMemberKin']);

Route::post('/bodaboda-member/{memberId}/vehicle/add', [BodabodaController::class, 'addMemberVehicle']);

Route::post('/bodaboda-member/{memberId}/vehicle/{vehicleId}/update', [BodabodaController::class, 'updateMemberVehicle']);

Route::post('/bodaboda-member/{memberId}/vehicle/{vehicleId}/delete', [BodabodaController::class, 'deleteMemberVehicle']);

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
// Loans
Route::get('/loans/summary', [BodabodaController::class, 'getAllLoansSummary']);

Route::get('/member-bonus-types/all', [BodabodaController::class, 'getAllMemberBonusTypes']);

Route::get('/member-fine-types/all', [BodabodaController::class, 'getAllMemberFineTypes']);

Route::post('/loans/create', [BodabodaController::class, 'createNewLoanType']);

// Loan Types
Route::post('/treasurer/bodaboda/loan-types/update', [BodabodaController::class, 'updateLoanType'])->name('treasurer.bodaboda.loan-types.update');

Route::post('/treasurer/bodaboda/loan-types/delete', [BodabodaController::class, 'deleteLoanType'])->name('treasurer.bodaboda.loan-types.delete');

// Bonus Types
Route::post('/treasurer/bodaboda/bonus-types/update', [BodabodaController::class, 'updateBonusType'])->name('treasurer.bodaboda.bonus-types.update');

Route::post('/treasurer/bodaboda/bonus-types/delete', [BodabodaController::class, 'deleteBonusType'])->name('treasurer.bodaboda.bonus-types.delete');

// Fine Types
Route::post('/treasurer/bodaboda/fine-types/update', [BodabodaController::class, 'updateFineType'])->name('treasurer.bodaboda.fine-types.update');

Route::post('/treasurer/bodaboda/fine-types/delete', [BodabodaController::class, 'deleteFineType'])->name('treasurer.bodaboda.fine-types.delete');

// Vehicles
Route::get('/bodaboda-member/{memberId}/vehicles/member/all', [BodabodaController::class, 'getAllMemberVehicleData']);

Route::get('/bodaboda-member/{memberId}/vehicles/member/count', [BodabodaController::class, 'getCountMemberVehicles']);

Route::get('/bodaboda-member/{memberId}/vehicles/nonmember/all', [BodabodaController::class, 'getAllNonMemberVehicleData']);

Route::get('/bodaboda-member/{memberId}/vehicles/nonmember/count', [BodabodaController::class, 'getCountNonMemberVehicles']);

// Count all types
Route::get('/member-loan-types/count', [BodabodaController::class, 'countAllMemberLoanTypes']);

Route::get('/member-bonus-types/count', [BodabodaController::class, 'countAllMemberBonusTypes']);

Route::get('/member-fine-types/count', [BodabodaController::class, 'countAllMemberFineTypes']);

// Count active loan transactions
Route::get('/member-transactions/count-active-loans', [BodabodaController::class, 'countActiveLoanTransactions']);

Route::get('/bodaboda/vehicles/count/all', [BodabodaController::class, 'getCountVehicles']);

// Your existing routes
Route::get('/bodaboda-member/{memberId}/vehicles/available', [BodabodaController::class, 'getAvailableMemberVehicles']);

// Route::get('/bodaboda-member/{memberId}/vehicles/assigned/current', [BodabodaController::class, 'getMemberAssignedVehicles']);

// Contributions
Route::get('/contributions/all', [BodabodaController::class, 'getAllContributions']);

// Bonuses
Route::get('/bonus-types/summary', [BodabodaController::class, 'getAllBonusTypesSummary']);

Route::post('/bonuses/create', [BodabodaController::class, 'createNewBonusType']);

// Fines
Route::get('/fine-types/summary', [BodabodaController::class, 'getAllFineTypesSummary']);

Route::post('/fines/create', [BodabodaController::class, 'createNewFineType']);

// End bodaboda module manage ----------------------------------------------------------------------------------------------------------

Route::get('/forgotPassword', function () {

    return view('auth.forgotPassword');

})->name('forgotPassword');



// Route for the reset password page.

Route::get('/resetPassword', function () {

    return view('auth.resetPassword');

})->name('resetPassword');



// Dashboard routes (protected by auth middleware)

Route::middleware('auth')->group(function () {

    Route::post('/signout', [SigninController::class, 'signout'])->name('signout');



    // Dashboard routes based on your directory structure

    Route::get('/treasurer/dashboard', function () {

        return view('dashboards.Treasurer.dashboard');

    })->name('treasurer.dashboard');



    Route::get('/supervisor/dashboard', function () {

        return view('dashboards.Supervisor.dashboard');

    })->name('supervisor.dashboard');



    Route::get('/chairman/dashboard', function () {

        return view('dashboards.Chairman.dashboard');

    })->name('chairman.dashboard');



    Route::get('/it/dashboard', function () {

        return view('dashboards.IT.dashboard');

    })->name('it.dashboard');



    Route::get('/secretary/dashboard', function () {

        return view('dashboards.secretaryGeneral.dashboard');

    })->name('secretary.dashboard');



    Route::get('/receptionist/dashboard', function () {

        return view('dashboards.Receptionist.dashboard');

    })->name('receptionist.dashboard');



   // Default dashboard route (shows dashboard for chairman, secretary, IT, receptionist)

    Route::get('/dashboard', function () {

        $user = Auth::user();

        $cleanRole = strtolower(preg_replace('/\s+/', '', $user->role));



        // Return appropriate view based on role

        return match($cleanRole) {

            'treasurer' => view('dashboards.Treasurer.dashboard'),      // Redirect to treasurer's special dashboard

            'supervisor' => view('dashboards.Supervisor.dashboard'),    // Redirect to supervisor's special dashboard

            'chairman' => view('dashboards.Chairman.dashboard'),          // Show chairman dashboard

            'it' => view('dashboards.IT.dashboard'),                      // Show IT dashboard

            'secretarygeneral' => view('dashboards.secretaryGeneral.dashboard'), // Show secretary dashboard

            'receptionist' => view('dashboards.receptionist.dashboard'),  // Show receptionist dashboard

            default => view('dashboards.receptionist.dashboard'),         // Fallback to receptionist

        };

    })->name('dashboard');



    // Resource routes for each role

    Route::prefix('treasurer')->group(function () {

        Route::get('/appointments', function () {

            return view('dashboards.Treasurer.appointments');

        })->name('treasurer.appointments');



        Route::get('/bodaboda', function () {

            return view('dashboards.Treasurer.bodaboda');

        })->name('treasurer.bodaboda');



        Route::get('/bodaboda-member/{memberId}', function ($memberId) {

            return view('dashboards.Treasurer.bodabodaMember', ['memberId' => $memberId]);

        })->name('treasurer.bodaboda.member');



        Route::get('/loans', function () {

            return view('dashboards.Treasurer.loans');

        })->name('treasurer.loans');



        Route::get('/loans-client', function () {

            return view('dashboards.Treasurer.loansClient');

        })->name('treasurer.loans.client');



        Route::get('/real-estate', function () {

            return view('dashboards.Treasurer.realEstate');

        })->name('treasurer.real.estate');



        Route::get('/land-owner', function () {

            return view('dashboards.Treasurer.landOwner');

        })->name('treasurer.land.owner');



        Route::get('/users', function () {

            return view('dashboards.Treasurer.users');

        })->name('treasurer.users');

    });



    Route::prefix('supervisor')->group(function () {

        Route::get('/appointments', function () {

            return view('dashboards.supervisor.appointments');

        })->name('supervisor.appointments');



        Route::get('/bodaboda', function () {

            return view('dashboards.supervisor.bodaboda');

        })->name('supervisor.bodaboda');

    });



    // Chairman routes

    Route::prefix('chairman')->group(function () {

        Route::get('/appointments', function () {

            return view('dashboards.chairman.appointments');

        })->name('chairman.appointments');



        Route::get('/bodaboda', function () {

            return view('dashboards.chairman.bodaboda');

        })->name('chairman.bodaboda');



        Route::get('/loans', function () {

            return view('dashboards.chairman.loans');

        })->name('chairman.loans');



        Route::get('/real-estate', function () {

            return view('dashboards.chairman.realEstate');

        })->name('chairman.real.estate');



        Route::get('/users', function () {

            return view('dashboards.chairman.users');

        })->name('chairman.users');

    });



    // IT routes

    Route::prefix('it')->group(function () {

        Route::get('/appointments', function () {

            return view('dashboards.IT.appointments');

        })->name('it.appointments');



        Route::get('/bodaboda', function () {

            return view('dashboards.IT.bodaboda');

        })->name('it.bodaboda');



        Route::get('/loans', function () {

            return view('dashboards.IT.loans');

        })->name('it.loans');



        Route::get('/real-estate', function () {

            return view('dashboards.IT.realEstate');

        })->name('it.real.estate');



        Route::get('/users', function () {

            return view('dashboards.IT.users');

        })->name('it.users');

    });



    // Secretary routes

    Route::prefix('secretary')->group(function () {

        Route::get('/appointments', function () {

            return view('dashboards.secretaryGeneral.appointments');

        })->name('secretary.appointments');



        Route::get('/bodaboda', function () {

            return view('dashboards.secretaryGeneral.bodaboda');

        })->name('secretary.bodaboda');



        Route::get('/loans', function () {

            return view('dashboards.secretaryGeneral.loans');

        })->name('secretary.loans');



        Route::get('/real-estate', function () {

            return view('dashboards.secretaryGeneral.realEstate');

        })->name('secretary.real.estate');



        Route::get('/users', function () {

            return view('dashboards.secretaryGeneral.users');

        })->name('secretary.users');

    });



    // Receptionist routes

    Route::prefix('receptionist')->group(function () {

        Route::get('/appointments', function () {

            return view('dashboards.receptionist.appointments');

        })->name('receptionist.appointments');



        Route::get('/bodaboda', function () {

            return view('dashboards.receptionist.bodaboda');

        })->name('receptionist.bodaboda');



        Route::get('/loans', function () {

            return view('dashboards.receptionist.loans');

        })->name('receptionist.loans');



        Route::get('/real-estate', function () {

            return view('dashboards.receptionist.realEstate');

        })->name('receptionist.real.estate');



        Route::get('/users', function () {

            return view('dashboards.receptionist.users');

        })->name('receptionist.users');

    });



    // Shared routes (accessible to all roles)

    Route::get('/profile', function () {

        return view('dashboards.shared.profile');

    })->name('profile');

});
