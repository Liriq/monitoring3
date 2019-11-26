<?php

namespace App\Http\Controllers\Frontend;

use App\Entities\Report;
use App\Entities\User;
use App\Entities\UserArea;
use App\Entities\Setting;
use App\Http\Controllers\Controller;
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
        $finish = (new Carbon('first day of this month'))->addDays($deadlineDay - 1)->endOfDay();

        $reports = Report::query()
            ->with(['answers', 'template:id,color'])
            ->orderBy('id', 'desc')
            ->get();

        $areas = UserArea::get(['user_id', 'latitude', 'longitude', 'radius'])
            ->each(function (UserArea $area) use ($reports) {
                $userID = $area->user_id;
                $areaReport = $reports->first(function (Report $report) use ($userID) {
                    return ($report->user_id == $userID && $report->answers->isNotEmpty());
                });

                $reportTable = view('frontend.reports._table')
                    ->with('reportAnswers', optional($areaReport)->answers ?? [])
                    ->render();

                $area->setAttribute('report_table', $reportTable);
                $area->setAttribute('template_color', optional($areaReport)->template->color ?? '');
            });

        return view('frontend.reports.index', [
            'areas' => $areas,
            'finish' => $finish,
        ]);
    }

    public function jsonReports()
    {
        $reports = Report::query()
            ->with(['answers', 'template:id,color'])
            ->orderBy('id', 'desc')
            ->get();

        $areas = UserArea::with('user')->get(['user_id', 'latitude', 'longitude', 'radius'])
            ->each(function (UserArea $area) use ($reports) {
                $userID = $area->user_id;
                $areaReport = $reports->first(function (Report $report) use ($userID) {
                    return ($report->user_id == $userID && $report->answers->isNotEmpty());
                });

                $area->setAttribute('report_answers', optional($areaReport)->answers ?? []);
                $area->setAttribute('template_color', optional($areaReport)->template->color ?? '');
            });

        return response()->json([
            'areas' => $areas
        ]);
    }

}
