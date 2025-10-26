<?php
namespace App\Models;
class EntitlementVariable extends BaseModel {

    protected $fillable = [
        'uuid',
        'code',
        'name_ar',
        'name_en',
        'account_number',
        'entitlement_category_id',
        'category_value',
        'revenue_type_id',
        'nature',
        'affected_by_deductions',
        'not_affected_by_work_days',
        'not_affect_entitlements',
        'is_health_insurance',
        'is_taxable',
        'tax_exempt_amount',
        'max_taxable_amount',
        'has_min_limit',
        'min_limit_value',
        'has_max_limit',
        'max_limit_value',
        'is_active',
        'company_id',
        'added_by_id',
        'updated_by_id',
        'entitlement_type_relation_id'
    ];

    protected $casts = [
        'affected_by_deductions' => 'boolean',
        'not_affected_by_work_days' => 'boolean',
        'not_affect_entitlements' => 'boolean',
        'is_health_insurance' => 'boolean',
        'is_taxable' => 'boolean',
        'tax_exempt_amount' => 'decimal:2',
        'max_taxable_amount' => 'decimal:2',
        'has_min_limit' => 'boolean',
        'min_limit_value' => 'decimal:2',
        'has_max_limit' => 'boolean',
        'max_limit_value' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // العلاقة مع نوع متغير الاستحقاق
    public function category()
    {
        return $this->belongsTo(EntitlementVariableCategory::class, 'entitlement_category_id');
    }

    // العلاقة مع نوع الإيراد
    public function revenueType()
    {
        return $this->belongsTo(RevenueType::class);
    }

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

    // Scope للنشطة فقط
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope حسب الخضوع للضريبة
    public function scopeTaxable($query)
    {
        return $query->where('is_taxable', true);
    }

    // Accessor للاسم حسب اللغة
    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : ($this->name_en ?? $this->name_ar);
    }

    // Accessor للحالة
    public function getStatusBadgeAttribute()
    {
        return $this->is_active
            ? '<span class="badge bg-success">نشط</span>'
            : '<span class="badge bg-danger">غير نشط</span>';
    }

    // Accessor للخضوع للضريبة
    public function getTaxableBadgeAttribute()
    {
        return $this->is_taxable
            ? '<span class="badge bg-warning">يخضع للضريبة</span>'
            : '<span class="badge bg-secondary">لا يخضع للضريبة</span>';
    }

    // Accessor للتأمين الصحي
    public function getHealthInsuranceBadgeAttribute()
    {
        return $this->is_health_insurance
            ? '<span class="badge bg-info">يخضع للتأمين</span>'
            : '<span class="badge bg-secondary">لا يخضع للتأمين</span>';
    }

    // Accessor لطبيعة الاستحقاق
    public function getNatureBadgeAttribute()
    {
        return $this->nature === 'fixed'
            ? '<span class="badge bg-primary">ثابت</span>'
            : '<span class="badge bg-success">شهري</span>';
    }

    // Accessor للحدود
    public function getLimitsDisplayAttribute()
    {
        $limits = [];
        if ($this->has_min_limit && $this->min_limit_value) {
            $limits[] = 'الحد الأدنى: ' . number_format($this->min_limit_value, 2);
        }
        if ($this->has_max_limit && $this->max_limit_value) {
            $limits[] = 'الحد الأقصى: ' . number_format($this->max_limit_value, 2);
        }
        return $limits ? implode(' | ', $limits) : '-';
    }

    // Accessor للحقول المؤثرة
    public function getEffectsDisplayAttribute()
    {
        $effects = [];
        if ($this->affected_by_deductions) $effects[] = 'يتأثر بالاستقطاعات';
        if ($this->not_affected_by_work_days) $effects[] = 'لا يتأثر بأيام العمل';
        if ($this->not_affect_entitlements) $effects[] = 'لا يؤثر على الاستحقاقات';
        return $effects ? implode('، ', $effects) : '-';
    }

    public function entitlementTypeRelation()
    {
        return $this->belongsTo(EntitlementTypeRelation::class, 'entitlement_type_relation_id');
    }
}
