<?php

namespace App\Http\Controllers;

use App\Models\FieldWorker;
use App\Http\Requests\StoreFieldWorkerRequest;
use App\Http\Requests\UpdateFieldWorkerRequest;
use Illuminate\Contracts\Session\Session;

class FieldWorkerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('livewire.field-worker.layout');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('livewire.field-worker.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreFieldWorkerRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreFieldWorkerRequest $request)
  {
    FieldWorker::create($request->validated());
    Session()->flash("message", "Field Worker has been created successfully");
    return redirect()->route('field-workers');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\FieldWorker  $fieldWorker
   * @return \Illuminate\Http\Response
   */
  public function show(FieldWorker $fieldWorker)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\FieldWorker  $fieldWorker
   * @return \Illuminate\Http\Response
   */
  public function edit(FieldWorker $fieldWorker)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateFieldWorkerRequest  $request
   * @param  \App\Models\FieldWorker  $fieldWorker
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateFieldWorkerRequest $request, FieldWorker $fieldWorker)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\FieldWorker  $fieldWorker
   * @return \Illuminate\Http\Response
   */
  public function destroy(FieldWorker $fieldWorker)
  {
    //
  }
}
