<div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
    <form action="{{ route('admin.employee.profile_update', $record->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h5 class="mb-3 mt-2 section-title">البيانات الشخصية</h5>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label">رقم البطاقه / جواز السفر</label>
                <input type="text" name="identity_number" class="form-control"
                    value="{{ old('identity_number', $record->identity_number) }}">
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">تاريخ الميلاد</label>
                <input type="date" name="birthday_date" class="form-control"
                    value="{{ old('birthday_date', $record->birthday_date?->format('Y-m-d')) }}">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label">النوع</label>
                <select name="gender_id" class="form-select" required>
                    <option value="">-- اختر النوع --</option>
                    @foreach($genders as $gender)
                    <option value="{{ $gender->id }}" {{ $record->gender_id == $gender->id ? 'selected' : '' }}>
                        {{ $gender->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">محافظه الميلاد</label>
                <select name="birth_governorate_id" class="form-select" required>
                    <option value="">-- اختر المحافظه --</option>
                    @foreach($governorates as $governorate)
                    <option value="{{ $gender->id }}" {{ $record?->profile?->birth_governorate_id == $governorate->id ?
                        'selected' : '' }}>
                        {{ $governorate->name_ar }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label">الجنسيه</label>
                    <select name="nationality_id" class="form-select" required>
                        <option value="">-- اختر الجنسيه --</option>
                        @foreach($nationalities as $nationality)
                        <option value="{{ $nationality->id }}" {{ $record->nationality_id == $nationality->id ?
                            'selected' : '' }}>
                            {{ $nationality->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">الديانه</label>
                    <select name="religion_id" class="form-select" required>
                        <option value="">-- اختر الديانه --</option>
                        @foreach($religions as $religion)
                        <option value="{{ $religion->id }}" {{ $record?->profile?->religion_id == $religion->id ?
                            'selected' : '' }}>
                            {{ $religion->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label">الحالة الاجتماعية</label>
                    <select name="marital_status" class="form-select" required>
                        <option value="">-- اختر الحالة --</option>
                        @foreach(\App\Enums\Employee\MaritalStatus::options() as $status)
                        <option value="{{ $status['value'] }}" {{ old('marital_status', $record->
                            profile?->marital_status?->value ??
                            $record->profile?->marital_status) == $status['value'] ? 'selected' : '' }}>
                            {{ $status['label'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">فصيله الدم</label>
                    <select name="blood_type_id" class="form-select" required>
                        <option value="">-- اختر الفصيله --</option>
                        @foreach($bloodTypes as $bloodType)
                        <option value="{{ $bloodType->id }}" {{ $record?->profile?->blood_type_id == $bloodType->id ?
                            'selected' : '' }}>
                            {{ $bloodType->name_ar }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <h5 class="mb-3 mt-2 section-title">بيانات العنوان</h5>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label">المحافظه</label>
                <select name="address_governorate_id" class="form-select" required>
                    <option value="">-- اختر المحافظه --</option>
                    @foreach($governorates as $governorate)
                    <option value="{{ $governorate->id }}" {{ $record?->profile?->address_governorate_id ==
                        $governorate->id ? 'selected' : '' }}>
                        {{ $governorate->name_ar }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">المركز / المدينة</label>
                <input type="text" name="address_city" class="form-control"
                    value="{{ old('address_city', $record?->profile?->address_city) }}">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-8">
                <label class="form-label">العنوان</label>
                <input type="text" name="address" class="form-control"
                    value="{{ old('address', $record?->profile?->address) }}">
            </div>
        </div>
        <h5 class="mb-3 mt-2 section-title">بيانات الاتصال</h5>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label">تليفون</label>
                <input type="text" name="phone" class="form-control"
                    value="{{ old('phone', $record?->profile?->phone) }}">
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">موبايل 1 / واتس اب</label>
                <input type="text" name="mobile1" class="form-control"
                    value="{{ old('mobile1', $record?->profile?->mobile1) }}">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label">فاكس</label>
                <input type="text" name="fax" class="form-control" value="{{ old('fax', $record?->profile?->fax) }}">
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">موبايل 2</label>
                <input type="text" name="mobile2" class="form-control"
                    value="{{ old('mobile2', $record?->profile?->mobile2) }}">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label">البريد الالكترونى</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $record?->profile?->email) }}">
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">حفظ</button>
        </div>
    </form>
</div>
