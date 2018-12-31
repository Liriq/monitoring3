<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Template;
use App\Entities\TemplateQuestion;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TemplateRequest;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('admin.templates.index', [
            'templates' => Template::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.templates.create', $this->getData(new Template));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\TemplateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        $post = $request->except(['questions']);
        $template = new Template;        
        if ($template->fill($post) && $template->save()) {
            $template->createOrUpdateQuestions($request->questions);
            
            return redirect()->route('admin.templates.index')->with('flash_success', _i('Data saved successfully!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while saving data!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view('admin.templates.edit', $this->getData($template));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\TemplateRequest $request
     * @param  \App\Entities\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, Template $template)
    {
        $post = $request->except(['questions']);
        if ($template->update($post)){
            $this->deleteQuestions($template, $request->input('questions.*.id'));
            $template->createOrUpdateQuestions($request->questions);
            
            return redirect()->route('admin.templates.index')->with('flash_success', _i('Data successfully updated!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while updating data!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return redirect()->route('admin.templates.index')->with('flash_success', _i('Data successfully deleted!'));
    }
    
    private function deleteQuestions($template, $requestQuestions)
    {
        $currentIds = $template->questions->pluck('id')->toArray();
        $questionsIds = array_diff($currentIds, $requestQuestions);
        if (!empty($questionsIds)) {
            $template->questions()->whereIn('id', $questionsIds)->delete();
        }     
    }
    
    private function getData($template)
    {
        return [
            'template' => $template,
            'answerTypes' => TemplateQuestion::ALL_TYPES,
            'typeSelect' => TemplateQuestion::TYPE_SELECT,     
        ];
    }
}
