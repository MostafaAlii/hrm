<?php

namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
/*abstract class BaseRepository {
    protected $model;
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
        'is_active' => 'nullable|boolean',
    ];

    public function __construct(Model $model) {
        $this->model = $model;
    }

    protected function extraData(string $context): array {
        return [];
    }

    /*public function index($dataTable, $view, $title) {
        return $dataTable->render($view, array_merge(
            ['title' => $title],
            $this->extraData('index')
        ));
    }*
    public function index($dataTable = null, $view = null, $title = null)
    {
        // إذا مديليش parameters خليهم null وارجع view عادي
        if ($dataTable === null && $view === null && $title === null) {
            return view('default.index', array_merge(
                ['title' => 'Default Title'],
                $this->extraData('index')
            ));
        }
        if ($dataTable instanceof \Yajra\DataTables\DataTables) {
            return $dataTable->render($view, array_merge(
                ['title' => $title],
                $this->extraData('index')
            ));
        }
        if (is_string($dataTable) && is_string($view)) {
            return view($dataTable, array_merge(
                ['title' => $view],
                $this->extraData('index')
            ));
        }
        throw new \InvalidArgumentException('Invalid parameters for index method');
    }

    public function indexView($view, $title)
    {
        return view($view, array_merge(
            ['title' => $title],
            $this->extraData('index')
        ));
    }

    public function create($view, $title) {
        return view($view, array_merge(
            ['title' => $title],
            $this->extraData('create')
        ));
    }

    protected function extraStoreFields(Request $request): array {
        return [];
    }
    protected function extraUpdateFields(Request $request, $id): array {
        return [];
    }

    protected function afterStore($model, Request $request): void {}
    protected function afterUpdate($model, Request $request): void {}

    public function store(Request $request) {
        $validated = $request->validate($this->rules);
        $data = [
            'name_ar'   => $validated['name_ar'] ?? null,
            'name_en'   => $validated['name_en'] ?? null,
            'is_active' => $request->has('is_active') ?? null,
            'company_id' => get_user_data()->company_id ?? null,
            'added_by_id' => get_user_data()->id ?? null,
        ];
        $data = array_merge($data, $this->extraStoreFields($request));
        $record = $this->model->create($data);
        $this->afterStore($record, $request);
        return redirect()->back()->with('success', 'تم الحفظ بنجاح!');
    }

    public function edit($id, $view, $title) {
        $record = $this->model->findOrFail($id);
        return view($view, array_merge(
            ['title' => $title, 'record' => $record],
            $this->extraData('edit')
        ));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate($this->rules);
        $record = $this->model->findOrFail($id);
        $data = [
            'name_ar'   => $validated['name_ar'] ?? null,
            'name_en'   => $validated['name_en'] ?? null,
            'is_active' => $request->has('is_active') ?? null,
            'company_id' => get_user_data()->company_id ?? null,
            'updated_by_id' => get_user_data()->id ?? null,
        ];
        $data = array_merge($data, $this->extraUpdateFields($request, $id));
        $record->update($data);
        $this->afterUpdate($record, $request);
        return redirect()->back()->with('success', 'تم التحديث بنجاح!');
    }

    public function show($id, $view, $title)
    {
        $record = $this->model->findOrFail($id);
        return view($view, array_merge(
            ['title' => $title, 'record' => $record],
            $this->extraData('show')
        ));
    }
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function destroy($model) {
        $model->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح!');
    }
}*/

abstract class BaseRepository
{
    protected $model;
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
        'is_active' => 'nullable|boolean',
    ];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function extraData(string $context): array
    {
        return [];
    }

    public function index($dataTable = null, $view = null, $title = null)
    {
        // إذا مديليش parameters خليهم null وارجع view عادي
        if ($dataTable === null && $view === null && $title === null) {
            return view('default.index', array_merge(
                ['title' => 'Default Title'],
                $this->extraData('index')
            ));
        }

        // إذا أول parameter هو DataTable (أي نوع من الـ DataTables)
        if (is_object($dataTable) && method_exists($dataTable, 'render')) {
            return $dataTable->render($view, array_merge(
                ['title' => $title],
                $this->extraData('index')
            ));
        }

        // إذا أول parameter هو view (بدون DataTable)
        if (is_string($dataTable) && is_string($view)) {
            return view($dataTable, array_merge(
                ['title' => $view],
                $this->extraData('index')
            ));
        }

        throw new \InvalidArgumentException('Invalid parameters for index method. Received: ' . gettype($dataTable));
    }

    public function indexView($view, $title)
    {
        return view($view, array_merge(
            ['title' => $title],
            $this->extraData('index')
        ));
    }

    public function create($view, $title)
    {
        return view($view, array_merge(
            ['title' => $title],
            $this->extraData('create')
        ));
    }

    protected function extraStoreFields(Request $request): array
    {
        return [];
    }
    protected function extraUpdateFields(Request $request, $id): array
    {
        return [];
    }

    protected function afterStore($model, Request $request): void {}
    protected function afterUpdate($model, Request $request): void {}

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $data = [
            'name_ar'   => $validated['name_ar'] ?? null,
            'name_en'   => $validated['name_en'] ?? null,
            'is_active' => $request->has('is_active') ?? null,
            'company_id' => get_user_data()->company_id ?? null,
            'added_by_id' => get_user_data()->id ?? null,
        ];
        $data = array_merge($data, $this->extraStoreFields($request));
        $record = $this->model->create($data);
        $this->afterStore($record, $request);
        return redirect()->back()->with('success', 'تم الحفظ بنجاح!');
    }

    public function edit($id, $view, $title)
    {
        $record = $this->model->findOrFail($id);
        return view($view, array_merge(
            ['title' => $title, 'record' => $record],
            $this->extraData('edit')
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules);
        $record = $this->model->findOrFail($id);
        $data = [
            'name_ar'   => $validated['name_ar'] ?? null,
            'name_en'   => $validated['name_en'] ?? null,
            'is_active' => $request->has('is_active') ?? null,
            'company_id' => get_user_data()->company_id ?? null,
            'updated_by_id' => get_user_data()->id ?? null,
        ];
        $data = array_merge($data, $this->extraUpdateFields($request, $id));
        $record->update($data);
        $this->afterUpdate($record, $request);
        return redirect()->back()->with('success', 'تم التحديث بنجاح!');
    }

    public function show($id, $view, $title)
    {
        $record = $this->model->findOrFail($id);
        return view($view, array_merge(
            ['title' => $title, 'record' => $record],
            $this->extraData('show')
        ));
    }
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function destroy($model)
    {
        $model->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح!');
    }
}
