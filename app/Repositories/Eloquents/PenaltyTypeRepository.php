<?php

namespace App\Repositories\Eloquents;

use App\Models\PenaltyType;
use App\Repositories\Contracts\PenaltyTypeRepositoryInterface;
use Illuminate\Http\Request;
use App\Enums\Penalty;

class PenaltyTypeRepository extends BaseRepository implements PenaltyTypeRepositoryInterface {
    protected $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'affects_salary' => 'nullable|boolean',
        'type' => 'required|in:warning,deduction,other',
        'calculation_type' => 'required|in:base_salary_days,total_salary_days,value,other',
        'first_time' => 'required|numeric|min:0',
        'first_time_description' => 'nullable|string|max:255',
        'second_time' => 'required|numeric|min:0',
        'second_time_description' => 'nullable|string|max:255',
        'third_time' => 'required|numeric|min:0',
        'third_time_description' => 'nullable|string|max:255',
        'fourth_time' => 'required|numeric|min:0',
        'fourth_time_description' => 'nullable|string|max:255',
        'more_than_four_times' => 'required|numeric|min:0',
        'more_than_four_times_description' => 'nullable|string|max:255',
    ];

    public function __construct(PenaltyType $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array {
        //dd($request->all());
        return [
            'affects_salary' => (bool) $request->input('affects_salary', 0),
            'type' => $request->input('type'),
            'calculation_type' => $request->input('calculation_type'),

            'first_time' => $request->input('first_time', 0),
            'first_time_description' => $request->input('first_time_description'),
            'second_time' => $request->input('second_time', 0),
            'second_time_description' => $request->input('second_time_description'),
            'third_time' => $request->input('third_time', 0),
            'third_time_description' => $request->input('third_time_description'),
            'fourth_time' => $request->input('fourth_time', 0),
            'fourth_time_description' => $request->input('fourth_time_description'),
            'more_than_four_times' => $request->input('more_than_four_times', 0),
            'more_than_four_times_description' => $request->input('more_than_four_times_description'),
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return $this->extraStoreFields($request);
    }
}
