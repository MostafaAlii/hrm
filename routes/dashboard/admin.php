<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::get('dashboard', Dashboard\DashboardController::class)->name('dashboard');
            Route::controller(Dashboard\MainSettingsController::class)->prefix('mainSettings')->as('mainSettings.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('store', 'store')->name('store');
            });
            Route::resource('financialYears', Dashboard\FinancialYearController::class);
            Route::resource('branchs', Dashboard\BranchController::class);
            Route::get('financialYears/{financialYear}/months', [Dashboard\FinancialYearController::class, 'months'])->name('financialYears.months');
            Route::resource('branchs', Dashboard\BranchController::class);
            Route::resource('shift-types', Dashboard\ShiftTypeController::class);
            Route::resource('departments', Dashboard\DepartmentController::class);
            Route::resource('section', Dashboard\SectionController::class);
            Route::get('departments/{id}/sections', [Dashboard\SectionController::class, 'getByDepartment'])->name('departments.sections');
            Route::resource('jobCategories', Dashboard\JobCategoryController::class);
            Route::resource('qualifications', Dashboard\QualificationController::class);
            Route::resource('occasions', Dashboard\OccasionController::class);
            Route::resource('vacations', Dashboard\VacationController::class);
            Route::resource('terminationTypes', Dashboard\TerminationTypeController::class);
            Route::resource('nationality', Dashboard\NationalityController::class);
            Route::resource('religion', Dashboard\ReligionController::class);
            Route::resource('level', Dashboard\LevelController::class);
            Route::resource('benefitVariable', Dashboard\BenefitVariableController::class);
            Route::resource('bankVariable', Dashboard\BankVariableController::class);
            Route::resource('bloodType', Dashboard\BloodTypeController::class);
            Route::resource('country', Dashboard\CountryController::class);
            Route::resource('governorate', Dashboard\GovernorateController::class);
            Route::resource('city', Dashboard\CityController::class);
            Route::resource('employee', Dashboard\EmployeeController::class);
            Route::resource('relative-degrees', Dashboard\RelativeDegreeController::class);
            Route::resource('insurance-regions', Dashboard\InsuranceRegionController::class);
            Route::resource('insurance-offices', Dashboard\InsuranceOfficeController::class);
            Route::resource('insurance-types', Dashboard\InsuranceTypeController::class);
            Route::resource('contract-types', Dashboard\ContractTypeController::class);
            Route::resource('family-jobs', Dashboard\FamilyJobController::class);
            Route::resource('educational-degrees', Dashboard\EducationalDegreeController::class);
            Route::resource('grades', Dashboard\GradeController::class);
            Route::resource('universities', Dashboard\UniversityController::class);
            Route::resource('specializations', Dashboard\SpecializationController::class);

            Route::put('employee/{id}/profile-update', [Dashboard\EmployeeController::class, 'update_profile'])->name('employee.profile_update');
            Route::put('employee/{id}/military-service-update', [Dashboard\EmployeeController::class, 'update_military_service'])->name('employee.update_military_service');
            Route::post('employees/{employee}/contracts', [Dashboard\EmployeeController::class, 'contractStore'])->name('employees.contracts.store');
            Route::delete('employees/{employee}/contracts/{contract}', [Dashboard\EmployeeController::class, 'contractDestroy'])->name('employees.contracts.destroy');
            Route::put('employee/{employee}/insurance-update', [Dashboard\EmployeeController::class, 'updateInsurance'])->name('employee.insurance.update');

        });

        require __DIR__ . '../../auth.php';
    }
);