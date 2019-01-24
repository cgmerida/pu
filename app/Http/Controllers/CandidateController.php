<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Department;
use App\Municipality;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('candidates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Candidate::positions();

        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        $municipalities = [0 => 'Seleccione un departamento antes'];

        return view('candidates.create', compact('departments', 'municipalities', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Candidate::rules());

        Candidate::create($request->all());

        return redirect()->route('candidates.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        $positions = Candidate::positions();

        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        $municipalities = $candidate->municipality()->pluck('name', 'id');

        return view('candidates.show', compact('candidate', 'departments', 'municipalities', 'positions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        $positions = Candidate::positions();

        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        $municipalities = $candidate->municipality()->pluck('name', 'id');

        return view('candidates.edit', compact('candidate', 'departments', 'municipalities', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        $this->validate($request, Candidate::rules());

        $candidate->update($request->all());

        return redirect()->route('candidates.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
