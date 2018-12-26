<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Report;
use App\Entities\Template;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;

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
        return view('admin.reports.create', [
            'report' => new Report(),
            'templates' => Template::with('questions')->get(),
            'employees' => User::employee()->get()->pluck('fullName', 'id'),   
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
        $post = $request->all();
        $post['name'] = Template::find($post['template_id'])->name;
        $report = new Report;        
        if ($report->fill($post) && $report->save()) {
                        
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
        return view('admin.reports.edit', [
            'report' => $report,    
            'templates' => Template::with('questions')->get(),   
            'employees' => User::employee()->get()->pluck('fullName', 'id'),       
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
        $post = $request->all();
        $post['name'] = Template::find($post['template_id'])->name;        
        if ($report->update($post)){
            
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
}
