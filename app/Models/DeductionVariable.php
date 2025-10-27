<?php
namespace App\Models;
class DeductionVariable extends BaseModel {
    protected $fillable = [
        'uuid',
        'code',
        'name_ar',
        'name_en',
        'account_number',
        'deduction_category_id',
        'entitlement_type_relation_id',
        'tax_system_code',
        'is_fixed',
        'is_monthly',
        'value',
        'is_taxable',
        'affects_bonus',
        'not_affect_salary',
        'deduction_type_id',
        'is_active',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'is_fixed' => 'boolean',
        'is_monthly' => 'boolean',
        'is_taxable' => 'boolean',
        'affects_bonus' => 'boolean',
        'not_affect_salary' => 'boolean',
        'is_active' => 'boolean',
        'value' => 'decimal:2',
    ];

    // العلاقة مع نوع متغير الاستقطاع
    public function category()
    {
        return $this->belongsTo(DeductionVariableCategory::class, 'deduction_category_id');
    }

    // العلاقة مع علاقات أنواع الاستحقاقات
    public function entitlementTypeRelation()
    {
        return $this->belongsTo(EntitlementTypeRelation::class, 'entitlement_type_relation_id');
    }

    // العلاقة مع نوع الاستقطاع
    public function deductionType()
    {
        return $this->belongsTo(DeductionType::class, 'deduction_type_id');
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

    // Accessor لطبيعة الاستقطاع
    public function getNatureBadgeAttribute()
    {
        if ($this->is_fixed && $this->is_monthly) {
            return '<span class="badge bg-info">ثابت وشهري</span>';
        } elseif ($this->is_fixed) {
            return '<span class="badge bg-primary">ثابت</span>';
        } elseif ($this->is_monthly) {
            return '<span class="badge bg-success">شهري</span>';
        } else {
            return '<span class="badge bg-secondary">غير محدد</span>';
        }
    }

    // Accessor للتأثيرات
    public function getEffectsDisplayAttribute()
    {
        $effects = [];
        if ($this->affects_bonus) $effects[] = 'يؤثر على المكافأة';
        if ($this->not_affect_salary) $effects[] = 'لا يؤثر على المرتب';
        return $effects ? implode('، ', $effects) : '-';
    }

    public function getFormattedValueAttribute()
    {
        return $this->value ? number_format($this->value, 2) : '-';
    }
}
