<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
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
    $customers = Customer::whereLike(['name', 'phone_number', 'meter_number', 'id_number'], $searchTerm)
      ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
      ->paginate($this->perPage);
    return view('livewire.customer.dashboard', [
      'customers' => $customers,
    ]);
  }
}
