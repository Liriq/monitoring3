<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Report;
use App\Entities\Template;
use App\Entities\TemplateQuestion;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;
use App\Http\Requests\Admin\ReportAnswersRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.index', [
            'reports' => Report::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reports.create', $this->getData(new Report));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ReportRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request)
    {
        $post = $request->except(['answers']);
        $post['name'] = Template::find($post['template_id'])->name;
        $report = new Report;        
        if ($report->fill($post) && $report->save()) {
            $report->createAnswers($request->answers);
                 
            return redirect()->route('admin.reports.index')->with('flash_success', _i('Data saved successfully!'));
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
        return view('admin.reports.edit', $this->getData($report));
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
        $post = $request->except(['answers']);
        $post['name'] = Template::find($post['template_id'])->name;        
        if ($report->update($post)) {
            $this->deleteAnswers($report, $request->input('answers.*.id'));
            $report->updateAnswers($request->answers);
            return redirect()->route('admin.reports.index')->with('flash_success', _i('Data successfully updated!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while updating data!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('admin.reports.index')->with('flash_success', _i('Data successfully deleted!'));
    }
    
    public function getAnswers(ReportAnswersRequest $request)
    {
        $post = $request->all();
        if (!empty($post['report_id'])) {
            $report = Report::findOrFail($post['report_id']);
            $answers = $report->answers;
        } else {
            $template = Template::findOrFail($post['template_id']);
            $answers = $template->questions;
        }
        
        return $answers->toJson();
    }
    
    private function deleteAnswers($report, $requestAnswers)
    {
        $currentIds = $report->answers->pluck('id')->toArray();
        $answersIds = array_diff($currentIds, $requestAnswers);
        if (!empty($answersIds)) {
            $report->answers()->whereIn('id', $answersIds)->delete();
        }     
    }
    
    private function getData($report)
    {
        return [
            'report' => $report->load('answers'),
            'templates' => Template::get(['name', 'id']),
            'employeesByTemplate' => User::employee()->get(['id', 'name', 'lastname', 'template_id'])->groupBy('template_id'),
            'questionsByTemplate' => TemplateQuestion::get()->groupBy('template_id'),   
            'answerTypes' => TemplateQuestion::ALL_TYPES, 
            'typeSelect' => TemplateQuestion::TYPE_SELECT,
        ];
    } 
    
}
