<?php
namespace App\Models;
class DeductionType extends BaseModel {
    protected $fillable = [
        'code',
        'name_ar',
        'name_en',
        'is_active',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // العلاقة مع المستخدم المضيف
    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by_id');
    }

    // العلاقة مع المستخدم المعدل
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active
            ? '<span class="badge bg-success">نشط</span>'
            : '<span class="badge bg-danger">غير نشط</span>';
    }
}