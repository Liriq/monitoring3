<?php

namespace App\Http\Controllers\Frontend;

use App\Entities\Report;
use App\Entities\Template;
use App\Entities\TemplateQuestion;
use App\Entities\User;
use App\Entities\UserArea;
use App\Entities\Setting;
use App\Entities\ReportAnswer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;
use App\Http\Requests\Admin\ReportAnswersRequest;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deadlineDay = optional(Setting::whereName(Setting::REPORT_DEADLINE)->first())->value;
        $start = (new Carbon('first day of this month'))->startOfDay();
        $finish = (new Carbon('first day of this month'))->addDays($deadlineDay - 1)->endOfDay();
        
        $reports = Report::query()
            ->with(['answers'])
            ->orderBy('id', 'desc')
            ->get();

        $areas = UserArea::get(['user_id', 'latitude', 'longitude', 'radius'])
            ->each(function (UserArea $area) use ($reports, $start, $finish) {
                $userID = $area->user_id;
                $areaReport = $reports->first(function (Report $report) use ($userID) {
                    return ($report->user_id == $userID && $report->answers->isNotEmpty());
                });

                $reportTable = view('frontend.reports._table')
                    ->with('reportAnswers', optional($areaReport)->answers ?? [])
                    ->render();

                $area->setAttribute('report_table', $reportTable);
            });

        return view('frontend.reports.index', [
            'areas' => $areas,
            'usersWithCompletedReports' => User::whereHas('reports', function($query) use ($start, $finish) {
                $query->whereBetween('published_at', [$start, $finish]);
            })->pluck('id', 'id'),
            'finish' => $finish,
        ]);
    }
    
}
