<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index', [
            'settings' => Setting::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.create', [
            'setting' => new Setting(),           
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SettingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $post = $request->all();
        $setting = new Setting;        
        if ($setting->fill($post) && $setting->save()) {
                        
            return redirect()->route('admin.settings.index')->with('flash_success', _i('Data saved successfully!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while saving data!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', [
            'setting' => $setting,          
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SettingRequest $request
     * @param  \App\Entities\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $post = $request->all();        
        if ($setting->update($post)){
            
            return redirect()->route('admin.settings.index')->with('flash_success', _i('Data successfully updated!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while updating data!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        if (empty(Setting::ALL_NAMES[$setting->name])) {
            $setting->delete();

            return redirect()->route('admin.settings.index')->with('flash_success', _i('Data successfully deleted!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('You cannot delete this data!'));
    }
}
