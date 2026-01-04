<?php
namespace App\Core\EmployeeStatus\Enums;
enum EmployeeStatusTabType: string {
    case SELECT = 'select'; // job, section, department...
    case STATUS = 'status';
    case BARCODE = 'barcode';
}
