<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logName     = (string) $request->query('log_name', '');
        $causerId    = $request->integer('causer_id');
        $subjectType = (string) $request->query('subject_type', '');
        $subjectId   = $request->integer('subject_id');
        $q           = (string) $request->query('q', '');
        $dateFrom    = (string) $request->query('date_from', '');
        $dateTo      = (string) $request->query('date_to', '');

        $query = Activity::query()
            ->with(['causer', 'subject'])
            ->when($logName !== '', fn($q2) => $q2->where('log_name', $logName))
            ->when($causerId,    fn($q2) => $q2->where('causer_id', $causerId))
            ->when($subjectType !== '', fn($q2) => $q2->where('subject_type', $subjectType))
            ->when($subjectId,   fn($q2) => $q2->where('subject_id', $subjectId))
            ->when($q !== '', function ($q2) use ($q) {
                $q2->where(function ($qq) use ($q) {
                    $qq->where('description', 'ILIKE', '%'.$q.'%')
                       ->orWhere('properties', 'ILIKE', '%'.$q.'%');
                });
            })
            ->when($dateFrom !== '', fn($q2) => $q2->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo   !== '', fn($q2) => $q2->whereDate('created_at', '<=', $dateTo))
            ->orderByDesc('id');

        $activities = $query->paginate(20)->withQueryString();

        $logNames = Activity::query()
            ->select('log_name')->distinct()->orderBy('log_name')->pluck('log_name');

        return view('admin.activity-log.index', [
            'activities' => $activities,
            'logNames'   => $logNames,
            'filters'    => compact(
                'logName','causerId','subjectType','subjectId','q','dateFrom','dateTo'
            ),
        ]);
    }
}
