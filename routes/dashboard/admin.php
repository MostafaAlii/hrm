<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Dashboard\Reports;
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
            Route::resource('penalty-types', Dashboard\PenaltyTypeController::class);
            Route::resource('cost-centers', Dashboard\CostCenterController::class);
            Route::resource('salary-cards', Dashboard\SalaryCardController::class);
            Route::resource('performance-report-items', Dashboard\PerformanceReportItemController::class);
            Route::resource('license-variables', Dashboard\LicenseVariableController::class);
            Route::resource('employment-documents', Dashboard\EmploymentDocumentController::class);
            Route::put('employee/{id}/profile-update', [Dashboard\EmployeeController::class, 'update_profile'])->name('employee.profile_update');
            Route::put('employee/{id}/military-service-update', [Dashboard\EmployeeController::class, 'update_military_service'])->name('employee.update_military_service');
            Route::post('employees/{employee}/contracts', [Dashboard\EmployeeController::class, 'contractStore'])->name('employees.contracts.store');
            Route::delete('employees/{employee}/contracts/{contract}', [Dashboard\EmployeeController::class, 'contractDestroy'])->name('employees.contracts.destroy');
            Route::put('employee/{employee}/insurance-update', [Dashboard\EmployeeController::class, 'updateInsurance'])->name('employee.insurance.update');
            Route::post('employee-qualifications', [Dashboard\EmployeeController::class, 'qualificationsStore'])->name('employee.qualifications.store');
            Route::delete('employee-qualifications/{id}', [Dashboard\EmployeeController::class, 'qualificationsDestroy'])->name('employee.qualifications.destroy');
            Route::put('employee-qualifications-update/{id}', [Dashboard\EmployeeController::class, 'qualificationsUpdate'])->name('employee.qualifications.update');
            Route::post('employees/{employee}/families', [Dashboard\EmployeeController::class, 'familyStore'])->name('employee.families.store');
            Route::put('employees/{employee}/families/{family}', [Dashboard\EmployeeController::class, 'familyUpdate'])->name('employee.families.update');
            Route::delete('employees/{employee}/families/{family}', [Dashboard\EmployeeController::class, 'familyDestroy'])->name('employee.families.destroy');
            Route::post('employees/{employee}/emergencies', [Dashboard\EmployeeController::class, 'emergencyStore'])->name('employee.emergencies.store');
            Route::put('employees/{employee}/emergencies/{emergency}', [Dashboard\EmployeeController::class, 'emergencyUpdate'])->name('employee.emergencies.update');
            Route::delete('employees/{employee}/emergencies/{emergency}', [Dashboard\EmployeeController::class, 'emergencyDestroy'])->name('employee.emergencies.destroy');
            Route::post('employees/{employee}/trainings', [Dashboard\EmployeeController::class, 'trainingStore'])->name('employee.trainings.store');
            Route::put('employees/{employee}/trainings/{training}', [Dashboard\EmployeeController::class, 'trainingUpdate'])->name('employee.trainings.update');
            Route::delete('employees/{employee}/trainings/{training}', [Dashboard\EmployeeController::class, 'trainingDestroy'])->name('employee.trainings.destroy');
            Route::post('employees/{employee}/licenses', [Dashboard\EmployeeController::class, 'licenseStore'])->name('employee.licenses.store');
            Route::put('employees/{employee}/licenses/{license}', [Dashboard\EmployeeController::class, 'licenseUpdate'])->name('employee.licenses.update');
            Route::delete('employees/{employee}/licenses/{license}', [Dashboard\EmployeeController::class, 'licenseDestroy'])->name('employee.licenses.destroy');
            Route::post('employees/{employee}/employment-documents', [Dashboard\EmployeeController::class, 'employmentDocumentStore'])->name('employee.employment-documents.store');
            Route::put('employees/{employee}/employment-documents/{document}', [Dashboard\EmployeeController::class, 'employmentDocumentUpdate'])->name('employee.employment-documents.update');
            Route::delete('employees/{employee}/employment-documents/{document}', [Dashboard\EmployeeController::class, 'employmentDocumentDestroy'])->name('employee.employment-documents.destroy');
            Route::post('employees/{employee}/experiences', [Dashboard\EmployeeController::class, 'experienceStore'])->name('employee.experiences.store');
            Route::put('employees/{employee}/experiences/{experience}', [Dashboard\EmployeeController::class, 'experienceUpdate'])->name('employee.experiences.update');
            Route::delete('employees/{employee}/experiences/{experience}', [Dashboard\EmployeeController::class, 'experienceDestroy'])->name('employee.experiences.destroy');
            Route::post('employees/{employee}/benefits', [Dashboard\EmployeeController::class, 'benefitStore'])->name('employee.benefits.store');
            Route::put('employees/{employee}/benefits/{benefit}', [Dashboard\EmployeeController::class, 'benefitUpdate'])->name('employee.benefits.update');
            Route::delete('employees/{employee}/benefits/{benefit}', [Dashboard\EmployeeController::class, 'benefitDestroy'])->name('employee.benefits.destroy');
            // Basic Salart الاساسى من الراتب
            Route::post('employees/{employee}/basic-salary', [Dashboard\EmployeeController::class, 'basicSalaryStore'])->name('employee.basic_salary.store');
            Route::post('employees/{employee}/toggle-tax', [Dashboard\EmployeeController::class, 'toggleTaxStatus'])->name('employee.toggle_tax');
            Route::post('employees/{employee}/allowance', [Dashboard\EmployeeController::class, 'allowanceStore'])->name('employee.allowance.store');
            Route::post('employees/{employee}/entitlement', [Dashboard\EmployeeController::class, 'entitlementStore'])->name('employee.entitlement.store');
            Route::post('employees/{employee}/deduction', [Dashboard\EmployeeController::class, 'deductionStore'])->name('employee.deduction.store');
            Route::post('employees/{employee}/variable-insurance', [Dashboard\EmployeeController::class, 'variableInsuranceStore'])->name('employee.variable_insurance.store');
            Route::post('employees/{employee}/social-insurance', [Dashboard\EmployeeController::class, 'socialInsuranceStore'])->name('employee.social_insurance.store');

            // Tax-Settings ::
            Route::get('tax-settings', [Dashboard\TaxSettingController::class, 'index'])->name('tax-settings.index');
            Route::post('tax-settings', [Dashboard\TaxSettingController::class, 'store'])->name('tax-settings.store');
            Route::put('tax-settings/{taxSetting}', [Dashboard\TaxSettingController::class, 'update'])->name('tax-settings.update');
            Route::resource('tax-brackets', Dashboard\TaxBracketController::class);
            // إعدادات التأمينات
            Route::get('insurance-settings', [Dashboard\InsuranceSettingController::class, 'index'])->name('insurance-settings.index');
            Route::post('insurance-settings', [Dashboard\InsuranceSettingController::class, 'store'])->name('insurance-settings.store');
            Route::put('insurance-settings/{insuranceSetting}', [Dashboard\InsuranceSettingController::class, 'update'])->name('insurance-settings.update');

            // Employees Salary Tabs::
            Route::resource('tax-transaction-types', Dashboard\TaxTransactionTypeController::class);
            Route::resource('expense-types', Dashboard\ExpenseTypeController::class);
            Route::resource('revenue-types', Dashboard\RevenueTypeController::class);
            Route::resource('deduction-types', Dashboard\DeductionTypeController::class);
            Route::resource('allowance-variables', Dashboard\AllowanceVariableController::class);
            Route::resource('entitlement-variables', Dashboard\EntitlementVariableController::class);
            Route::resource('deduction-variables', Dashboard\DeductionVariableController::class);
            // Reports ::
            Route::prefix('reports')->as('reports.')->middleware(['auth:admin'])->group(function () {
                Route::get('employees', [Reports\EmployeeReportController::class, 'index'])->name('employee-informations.index');
                Route::get('employees/filter', [Reports\EmployeeReportController::class, 'filter'])->name('employee.filter');
            });
        });

        require __DIR__ . '../../auth.php';
    }
);
