<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\EmployeeRepository;
use App\DataTables\Dashboard\Admin\EmployeeDataTable;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Concerns\UploadMedia;
class EmployeeController extends Controller
{
    use UploadMedia;
    protected $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(EmployeeDataTable $dataTable)
    {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.employees.index',
            'الموظفين '
        );
    }

    public function create()
    {
        return $this->repository->create(
            'dashboard.admin.employees.btn.create',
            'إضافة موظف'
        );
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function show($id)
    {
        return $this->repository->show(
            $id,
            'dashboard.admin.employees.btn.show',
            'تفاصيل الموظف'
        );
    }

    public function edit($id)
    {
        return $this->repository->edit(
            $id,
            'dashboard.admin.employees.btn.edit',
            'تعديل  موظف'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy(Employee $employee)
    {
        return $this->repository->destroy($employee);
    }

    public function update_profile(Request $request, $id) {
        $validated = $request->validate([
            'identity_number'      => 'nullable|string|max:255',
            'birthday_date'        => 'nullable|date',
            'gender_id'            => 'required|exists:genders,id',
            'nationality_id'       => 'required|exists:nationalities,id',
            'birth_governorate_id' => 'nullable|exists:governorates,id',
            'address_governorate_id' => 'nullable|exists:governorates,id',
            'religion_id'          => 'nullable|exists:religions,id',
            'marital_status'       => 'nullable|string|in:single,married,divorced,widowed',
            'blood_type_id'        => 'nullable|exists:blood_types,id',
            'address_city'         => 'nullable|string',
            'address'         => 'nullable|string',
            'phone'                  => 'nullable|string|max:20',
            'mobile1'                => 'nullable|string|max:20',
            'mobile2'                => 'nullable|string|max:20',
            'fax'                    => 'nullable|string|max:20',
            'email'                  => 'nullable|email|max:255',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update([
            'identity_number' => $validated['identity_number'] ?? $employee->identity_number,
            'birthday_date'   => $validated['birthday_date'] ?? $employee->birthday_date,
            'gender_id'       => $validated['gender_id'] ?? $employee->gender_id,
            'nationality_id'  => $validated['nationality_id'] ?? $employee->nationality_id,
        ]);

        $employee->profile()->updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'identity_number'      => $validated['identity_number'] ?? $employee->profile?->identity_number,
                'birthday_date'        => $validated['birthday_date'] ?? $employee->profile?->birthday_date,
                'gender_id'            => $validated['gender_id'] ?? $employee->profile?->gender_id,
                'nationality_id'       => $validated['nationality_id'] ?? $employee->profile?->nationality_id,
                'birth_governorate_id' => $validated['birth_governorate_id'] ?? $employee->profile?->birth_governorate_id,
                'religion_id'          => $validated['religion_id'] ?? $employee->profile?->religion_id,
                'marital_status'       => $validated['marital_status'] ?? $employee->profile?->marital_status,
                'blood_type_id'        => $validated['blood_type_id'] ?? $employee->profile?->blood_type_id,
                'address_governorate_id'        => $validated['address_governorate_id'] ?? $employee->profile?->address_governorate_id,
                'address_city'        => $validated['address_city'] ?? $employee->profile?->address_city,
                'address'        => $validated['address'] ?? $employee->profile?->address,
                'phone'        => $validated['phone'] ?? $employee->profile?->phone,
                'mobile1'        => $validated['mobile1'] ?? $employee->profile?->mobile1,
                'mobile2'        => $validated['mobile2'] ?? $employee->profile?->mobile2,
                'fax'        => $validated['fax'] ?? $employee->profile?->fax,
                'email'        => $validated['email'] ?? $employee->profile?->email,

            ]
        );

        return redirect()->back()->with('success', 'تم تحديث البيانات الشخصية بنجاح');
    }

    /*public function update_military_service(Request $request, $id) {
        $employee = Employee::findOrFail($id);
        $validated = $request->validate([
            'military_card_number' => 'nullable|string|max:255',
            'issue_date'           => 'nullable|date',
            'expiry_date'          => 'nullable|date|after_or_equal:issue_date',
            'batch_number'         => 'nullable|string|max:255',
            'additional_info'      => 'nullable|string',
            'status'                      => 'required|string|in:' . implode(',', array_column(\App\Enums\Employee\MilitaryStatus::cases(), 'value')),
        ]);
        $militaryService = $employee->militaryService()->updateOrCreate(
            ['employee_id' => $employee->id],
        );
        if ($request->hasFile('employeeMilitaryCertificate')) {
            $militaryService->updateSingleMedia(
                'militaryService', // الفولدر
                $request->file('employeeMilitaryCertificate'),
                $militaryService,
                null,
                'media', // علاقة media
                true,  // useStorage (خليه false علشان الملفات تتحط في storage/app/public)
                false,  // generateThumbnail
                'employeeMilitaryCertificate' // collection name
            );
        }
        return back()->with('success', 'تم تحديث بيانات الخدمة العسكرية بنجاح');
    }*/

    /*public function update_military_service(Request $request, $id) {
        $employee = Employee::findOrFail($id);
        $validated = $request->validate([
            'military_card_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'batch_number' => 'nullable|string|max:255',
            'additional_info' => 'nullable|string',
            'status' => 'required|string|in:' . implode(',', array_column(\App\Enums\Employee\MilitaryStatus::cases(), 'value')),
        ]);
        $militaryService = $employee->militaryService()->updateOrCreate(
            ['employee_id' => $employee->id],
            $validated
        );

        return back()->with('success', 'تم تحديث بيانات الخدمة العسكرية بنجاح');
    }*/

    public function update_military_service(Request $request, $id) {
        //dd('وصلت جوه الكنترولر', $request->all(), $request->file('employeeMilitaryCertificate'));
        //dd($request->file('employeeMilitaryCertificate'));
        $employee = Employee::findOrFail($id);
        //dd($employee->militaryService());
        // Validate the request data
        $validated = $request->validate([
            'military_card_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'batch_number' => 'nullable|string|max:255',
            'additional_info' => 'nullable|string',
            'status' => 'nullable|string|in:' . implode(',', array_column(\App\Enums\Employee\MilitaryStatus::cases(), 'value')),
            'status' => 'nullable|string',
            'employeeMilitaryCertificate' => 'nullable|image|mimes:jpeg,png,webp|max:2048', // Validate the image
        ]);
        $militaryService = $employee->militaryService()->updateOrCreate(
            ['employee_id' => $employee->id],
            array_filter($validated, fn($key) => $key !== 'employeeMilitaryCertificate', ARRAY_FILTER_USE_KEY)
        );
        // بعد التحديث أو الإنشاء لازم تجيب الموديل مش العلاقة
        $militaryService = $employee->militaryService;


        //dd($militaryService);
        if ($request->hasFile('employeeMilitaryCertificate')) {
            //dd("دخلت جوة رفع الملف");
            $militaryService->updateSingleMedia(
                baseFolder: 'employeeMilitaryCertificates',
                file: $request->file('employeeMilitaryCertificate'),
                model: $militaryService,   // ✅ دلوقتي موديل فعلي
                relation: 'media',
                useStorage: true,
                generateThumbnail: true,
                collectionName: 'employeeMilitaryCertificate',
                addWatermark: false
            );
        }
        /*if ($request->hasFile('employeeMilitaryCertificate')) {
            $path = $request->file('employeeMilitaryCertificate')->store('military_service_certificates', 'public');
            dd($path);
        }*/
        return back()->with('success', 'تم تحديث بيانات الخدمة العسكرية بنجاح');
    }
}