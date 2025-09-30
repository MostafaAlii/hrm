<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\InsuranceSettingRepositoryInterface;
use Illuminate\Http\Request;
class InsuranceSettingController extends Controller {
    public function __construct(protected InsuranceSettingRepositoryInterface $repository) {}
    public function index() {
        return $this->repository->indexView('dashboard.admin.settings.insurance-settings.index', 'إعدادات التأمينات');
    }

    public function store(Request $request) {
        return $this->repository->store($request);
    }

    public function update(Request $request, $id) {
        return $this->repository->update($request, $id);
    }
}
