<?php
namespace App\Filters\EmployeeReport\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
class LevelFilter {
    public static function apply(Builder $query, Request $request): Builder {
        if ($request->has('filter_by_level') && $request->filter_by_level == 1) {
            if ($request->filled('level_id')) {
                $levelId = $request->level_id;
                $companyId = get_user_data()->company_id;
                $query->whereHas('level', function ($q) use ($levelId, $companyId) {
                    $q->where('id', $levelId)
                        ->where('company_id', $companyId)
                        ->where('is_active', 1);
                });
            }
        }

        return $query;
    }
}
