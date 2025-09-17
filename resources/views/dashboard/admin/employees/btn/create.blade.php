<!-- Modal Create -->
<div class="modal fade" id="createDepartmentModal" tabindex="-1" aria-labelledby="createBranchLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.employee.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBranchLabel">إضافة موظف جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name_ar" class="form-label">الاسم بالعربي</label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="name_en" class="form-label">الاسم بالإنجليزي</label>
                            <input type="text" name="name_en" id="name_en" class="form-control" value="{{ old('name_en') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="code" class="form-label">الكود</label>
                            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="barcode" class="form-label">الباركود</label>
                            <input type="text" name="barcode" id="barcode" class="form-control" value="{{ old('barcode') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="hiring_date" class="form-label">تاريخ التعيين</label>
                            <input type="date" name="hiring_date" id="hiring_date" class="form-control" value="{{ old('hiring_date') }}"
                                required>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                            <label for="birthday_date" class="form-label">تاريخ الميلاد</label>
                            <input type="date" name="birthday_date" id="birthday_date" class="form-control" value="{{ old('birthday_date') }}"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="identity_number" class="form-label">رقم الهويه/جواز السفر</label>
                            <input type="text" name="identity_number" id="identity_number" class="form-control" value="{{ old('identity_number') }}"
                                required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="gender_id" class="form-label">النوع</label>
                            <select name="gender_id" id="gender_id" class="form-select" required>
                                <option value="">اختر النوع</option>
                                @foreach($genders as $gender)
                                <option value="{{ $gender->id }}" {{ old('gender_id')==$gender->id ? 'selected' : '' }}>
                                    {{ $gender->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nationality_id" class="form-label">الجنسيه</label>
                            <select name="nationality_id" id="nationality_id" class="form-select" required>
                                <option value="">اختر الجنسيه</option>
                                @foreach($nationalities as $nationality)
                                <option value="{{ $nationality->id }}" {{ old('nationality_id')==$nationality->id ? 'selected' : '' }}>
                                    {{ $nationality->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="level_id" class="form-label">المستوى</label>
                            <select name="level_id" id="level_id" class="form-select" required>
                                <option value="">اختر المستوى</option>
                                @foreach($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id')==$level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="branch_id" class="form-label">جهه العمل</label>
                            <select name="branch_id" id="branch_id" class="form-select" required>
                                <option value="">اختر جهه العمل</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id')==$branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                            <label for="department_id" class="form-label">الاداره</label>
                            <select name="department_id" id="department_id" class="form-select" required>
                                <option value="">اختر الاداره</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id')==$department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="section_id" class="form-label">القسم</label>
                            <select name="section_id" id="section_id" class="form-select" required>
                                <option value="">اختر القسم</option>
                                @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id')==$section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="job_category_id" class="form-label">الوظيفه</label>
                            <select name="job_category_id" id="job_category_id" class="form-select" required>
                                <option value="">اختر الوظيفه</option>
                                @foreach($jobCategories as $jobCategory)
                                <option value="{{ $jobCategory->id }}" {{ old('job_category_id')==$jobCategory->id ? 'selected' : '' }}>
                                    {{ $jobCategory->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="salary_place_id" class="form-label">مكان استلام المرتب</label>
                            <select name="salary_place_id" id="salary_place_id" class="form-select" required>
                                <option value="">اختر مكان الاستلام</option>
                                @foreach($salaryPlaces as $salaryPlace)
                                <option value="{{ $salaryPlace->id }}" {{ old('salary_place_id')==$salaryPlace->id ? 'selected' : '' }}>
                                    {{ $salaryPlace->name }}
                                </option>
                                @endforeach
                            </select>
                            <small class="form-text text-center text-muted mt-1">
                                يجب إكمال تفاصيل استلام المرتب من خلال
                                <br>
                                <a href="{{ route('admin.employee.index') }}" class="text-primary text-decoration-underline">
                                    شاشة العاملين
                                </a>
                            </small>
                        </div>
                    </div>

                    

                    

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">حفظ</button>
                </div>
            </div>
        </form>
    </div>
</div>