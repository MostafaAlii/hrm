<?php

namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
abstract class BaseRepository {
    protected $model;
    protected $rules = [
        'name_ar'   => 'required|string|max:255',
        'name_en'   => 'required|string|max:255',
        'is_active' => 'nullable|boolean',
    ];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index($dataTable, $view, $title)
    {
        return $dataTable->render($view, ['title' => $title]);
    }

    public function create($view, $title)
    {
        return view($view, ['title' => $title]);
    }

    protected function extraStoreFields(Request $request): array {
        return [];
    }
    protected function extraUpdateFields(Request $request, $id): array {
        return [];
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);

        $data = [
            'name_ar'   => $validated['name_ar'],
            'name_en'   => $validated['name_en'],
            'is_active' => $request->has('is_active'),
            'company_id' => get_user_data()->company_id ?? null,
            'added_by_id' => get_user_data()->id ?? null,
        ];
        $data = array_merge($data, $this->extraStoreFields($request));
        $this->model->create($data);
        return redirect()->back()->with('success', 'تم الحفظ بنجاح!');
    }

    public function edit($id, $view, $title)
    {
        $record = $this->model->findOrFail($id);
        return view($view, ['title' => $title, 'record' => $record]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules);

        $record = $this->model->findOrFail($id);
        $data = [
            'name_ar'   => $validated['name_ar'],
            'name_en'   => $validated['name_en'],
            'is_active' => $request->has('is_active'),
            'company_id' => get_user_data()->company_id ?? null,
            'updated_by_id' => get_user_data()->id ?? null,
        ];
        $data = array_merge($data, $this->extraUpdateFields($request, $id));
        $record->update($data);
        return redirect()->back()->with('success', 'تم التحديث بنجاح!');
    }

    public function destroy($model)
    {
        $model->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح!');
    }
}
