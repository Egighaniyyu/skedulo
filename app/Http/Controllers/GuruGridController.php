<?php

namespace App\Http\Controllers;

use App\Models\GuruGrid;
use Illuminate\Http\Request;

class GuruGridController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data-guru.guru-grid');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GuruGrid $guruGrid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuruGrid $guruGrid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuruGrid $guruGrid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuruGrid $guruGrid)
    {
        //
    }
}
