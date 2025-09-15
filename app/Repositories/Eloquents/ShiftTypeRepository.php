<?php

namespace  App\Repositories\Eloquents;
use Carbon\Carbon;
use App\Models\ShiftType;
use App\Repositories\Contracts\ShiftTypeRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\ShiftTypeDataTable;
use App\Enums\ShiftType\ShiftType as ShiftTypeEnum;
class ShiftTypeRepository implements ShiftTypeRepositoryInterface
{
    public function index(ShiftTypeDataTable $shiftTypeDataTable)
    {
        $types = ShiftTypeEnum::cases();
        return $shiftTypeDataTable->render('dashboard.admin.shiftType.index', ['types' => $types,'title' => 'الشيفتات']);
    }

    /*public function create()
    {
        return view('dashboard.admin.shiftTypes.btn.create', ['title' => 'إضافة فرع']);
    }*/

    public function create()
    {
        $types = ShiftTypeEnum::cases();
        return view('dashboard.admin.shiftType.btn.create', ['types' => $types,'title' => 'إضافة فرع']);
    }

    /*public function store(Request $request) {
        $validated = $request->validate([
            'type'       => 'required|in:' . implode(',', array_column(ShiftTypeEnum::cases(), 'value')),
            'from_time'  => 'nullable|date_format:H:i A',
            'to_time'    => 'nullable|date_format:H:i A',
            'total_hour' => 'nullable|date_format:H:i',
            'is_active'  => 'boolean',
        ]);

        ShiftType::create([
            'type'       => $validated['type'],
            'from_time'  => $validated['from_time'],
            'to_time'    => $validated['to_time'],
            'total_hour' => $validated['total_hour'],
            'is_active'  => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.shift-types.index')->with('success', 'تم إنشاء الشيفت بنجاح');
    }*/

    public function store(Request $request)
    {
        $data = $request->all();

        // احسب الساعات تلقائي لو النوع morning أو evening
        if (
            in_array($data['type'] ?? '', ['morning', 'evening'])
            && !empty($data['from_time'])
            && !empty($data['to_time'])
        ) {
            // خد بالك: الفورم بيرجع H:i مش h:i A
            $from = \Carbon\Carbon::createFromFormat('H:i', $data['from_time']);
            $to   = \Carbon\Carbon::createFromFormat('H:i', $data['to_time']);

            // احسب فرق الساعات والدقايق
            $diffInMinutes = $to->diffInMinutes($from);
            $hours = floor($diffInMinutes / 60);
            $minutes = $diffInMinutes % 60;

            // رجع بصيغة time للـ DB H:i:s
            $data['total_hour'] = sprintf('%02d:%02d:00', $hours, $minutes);
        }

        ShiftType::create([
            'type'       => $data['type'] ?? null,
            'from_time'  => $data['from_time'] ?? null,
            'to_time'    => $data['to_time'] ?? null,
            'total_hour' => $data['total_hour'] ?? null,
            'is_active'  => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.shift-types.index')
            ->with('success', 'تم إنشاء الشيفت بنجاح');
    }



    public function edit($id) {
        $shiftType = ShiftType::findOrFail($id);
        $types = ShiftTypeEnum::cases();
        return view('dashboard.admin.shiftType.btn.edit', compact('shiftType', 'types'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type'       => 'required|in:' . implode(',', array_column(ShiftTypeEnum::cases(), 'value')),
            'from_time'  => 'nullable|date_format:H:i',
            'to_time'    => 'nullable|date_format:H:i',
            'total_hour' => 'nullable|date_format:H:i',
            'is_active'  => 'boolean',
        ]);
        $shiftType = ShiftType::findOrFail($id);
        $shiftType->update([
            'type'       => $validated['type'],
            'from_time'  => $validated['from_time'],
            'to_time'    => $validated['to_time'],
            'total_hour' => $validated['total_hour'],
            'is_active'  => $request->boolean('is_active'),
        ]);
        return redirect()->route('admin.shift-types.index')->with('success', 'تم تعديل الشيفت بنجاح');
    }

    public function destroy(ShiftType $shiftType)
    {
        $shiftType->delete();
        return redirect()->route('admin.shift-types.index')->with('success', 'تم حذف الشيفت بنجاح');
    }
}
