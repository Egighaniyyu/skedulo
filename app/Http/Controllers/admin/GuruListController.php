<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GuruList;
use App\Models\DataGuru;
use Illuminate\Http\Request;

class GuruListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = DataGuru::all();
        return view('admin.data-guru.guru-list', compact('guru'));
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
    public function show(GuruList $guruList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuruList $guruList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuruList $guruList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuruList $guruList)
    {
        //
    }
}
