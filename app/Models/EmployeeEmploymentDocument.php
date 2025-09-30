<?php
namespace App\Models;

use App\Models\Concerns\UploadMedia;
class EmployeeEmploymentDocument extends BaseModel {
    use UploadMedia;
    protected $fillable = [
        'uuid',
        'employment_document_id',
        'delivery_status',
        'notes',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];
    protected $casts = [
        'delivery_status' => 'string',
    ];

    public function getDeliveryStatusTextAttribute()
    {
        return $this->delivery_status === 'delivered' ? 'تم التسليم' : 'لم يتم التسليم';
    }

    public function getDeliveryStatusBadgeAttribute() {
        return $this->delivery_status === 'delivered'
            ? '<span class="badge bg-success">تم التسليم</span>'
            : '<span class="badge bg-danger">لم يتم التسليم</span>';
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function employmentDocument() {
        return $this->belongsTo(EmploymentDocument::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }

    public function media() {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getDocumentImageAttribute()
    {
        return $this->getMediaUrl('employment_documents', $this, null, 'media');
    }
}
