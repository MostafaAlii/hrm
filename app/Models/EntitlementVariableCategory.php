<?php
namespace App\Models;
class EntitlementVariableCategory extends BaseModel {
    protected $table = 'entitlement_variable_categories';
    protected $fillable = [
        'uuid',
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

    // العلاقة مع الشركة
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

    // Scope للنشطة فقط - إضافة هذا الـ Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor للاسم حسب اللغة
    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : ($this->name_en ?? $this->name_ar);
    }
}