<?php
namespace App\Models;
class AllowanceVariable extends BaseModel {
    protected $fillable = [
        'uuid',
        'code',
        'name_ar',
        'name_en',
        'account_number',
        'allowance_category_id',
        'category_value',
        'tax_system_code',
        'has_min_limit',
        'has_max_limit',
        'is_taxable',
        'is_health_insurance',
        'is_active',
        'company_id',
        'added_by_id',
        'updated_by_id',
        'min_limit_value',
        'max_limit_value',
    ];

    protected $casts = [
        'has_min_limit' => 'boolean',
        'has_max_limit' => 'boolean',
        'is_taxable' => 'boolean',
        'is_health_insurance' => 'boolean',
        'is_active' => 'boolean',
        'min_limit_value' => 'decimal:2',
        'max_limit_value' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(AllowanceCategory::class, 'allowance_category_id');
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

    // Scope حسب التامين الصحي
    public function scopeHealthInsurance($query)
    {
        return $query->where('is_health_insurance', true);
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

    // Accessor للحد الأدنى
    public function getMinLimitBadgeAttribute()
    {
        return $this->has_min_limit
            ? '<span class="badge bg-primary">له حد أدنى</span>'
            : '<span class="badge bg-secondary">لا يوجد حد أدنى</span>';
    }

    // Accessor للحد الأقصى
    public function getMaxLimitBadgeAttribute()
    {
        return $this->has_max_limit
            ? '<span class="badge bg-danger">له حد أقصى</span>'
            : '<span class="badge bg-secondary">لا يوجد حد أقصى</span>';
    }

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
}
