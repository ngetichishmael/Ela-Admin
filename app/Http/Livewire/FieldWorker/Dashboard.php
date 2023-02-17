<?php

namespace App\Http\Livewire\FieldWorker;

use App\Models\FieldWorker;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public ?string $search = null;
  public $perPage = 10;
  public $sortField = 'id';
  public $sortAsc = true;
  public function render()
  {
    $searchTerm = '%' . $this->search . '%';
    $fieldworkers = FieldWorker::whereLike(['name', 'phone_number', 'id_number'], $searchTerm)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);
    return view('livewire.field-worker.dashboard', [
      'fieldworkers' => $fieldworkers
    ]);
  }
}
