<?php

namespace App\Http\Controllers\Dashboard;

use App\Entities\Report;
use App\Entities\ReportAnswer;
use App\Entities\Template;
use App\Entities\TemplateQuestion;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ReportRequest;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.reports.index', [
            'reports' => Report::where('user_id', Auth::id())->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Auth::user()->load(['template.questions']);
        if (empty($employee->template)) {
            return redirect()->route('dashboard.reports.index');
        }
               
        return view('dashboard.reports.create', [
            'report' => new Report(),
            'questions' => $employee->template->questions,
            'employee' => $employee,  
            'selectTypes' => [
                'select' => [TemplateQuestion::TYPE_SELECT => TemplateQuestion::TYPE_SELECT],
            ],             
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ReportRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request)
    {
        $employee = Auth::user();
        $template = $employee->template;
        $report = new Report;
        $reportData = [
            'user_id' => $employee->id,
            'template_id' => $template->id,
            'name' => $template->name,
            'published_at' => $request->published_at,
        ];
        if ($report->fill($reportData) && $report->save()) {
            $this->createAnswers($report, $template->questions->keyBy('id'), $request->answers);            
            return redirect()->route('dashboard.reports.index')->with('flash_success', _i('Data saved successfully!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while saving data!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    { 
        $employee = Auth::user()->load(['template.questions']);
        if (empty($employee->template)) {
            return redirect()->route('dashboard.reports.index');
        }        
               
        return view('dashboard.reports.edit', [
            'report' => $report->load(['answers']),
            'answers' => $report->answers,
            'selectTypes' => [
                'select' => [TemplateQuestion::TYPE_SELECT => TemplateQuestion::TYPE_SELECT],
            ],             
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ReportRequest $request
     * @param  \App\Entities\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, Report $report)
    {
        if ($report->update(['published_at' => $request->published_at])) {
            $this->updateAnswers($report->answers->keyBy('id'), $request->answers);
            return redirect()->route('dashboard.reports.index')->with('flash_success', _i('Data successfully updated!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while updating data!'));
    }
    
    private function createAnswers($report, $questions, $answers)
    {
        $answerData = [];
        foreach ($answers as $answer) {
            $question = $questions[$answer['question_id']];            
            $answerData = array_merge($answer, $question->toArray(), ['report_id' => $report->id]);
            ReportAnswer::create($answerData);
        }
    }
    
    private function updateAnswers($reportAnswers, $answers)
    {
        foreach ($answers as $answer) {           
            $reportAnswers[$answer['id']]->update(['answer' => $answer['answer']]);
        }
    }   
        
}
