<section class="app-user-list">
    <!-- users filter start -->
    <div class="card">
        <h5 class="card-header">Search Filter</h5>
        <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row ml-2">
            <div class="col-md-4 ml-1">
                <div class="input-group input-group-merge">
                    <input wire:model.debounce.150ms="search" type="text" id="fname-icon" class="form-control"
                        name="fname-icon" placeholder="Search" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Select Per Page</label>
                    <select wire:model='perPage' class="form-control form-control-sm" id="selectSmall">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Sort</label>
                    <select wire:model="sortAsc" class="form-control form-control-sm" id="selectSmall">
                        <option value="1">Ascending</option>
                        <option value="0">Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">


            </div>
        </div>
    </div>
    {{-- @include('partials.loaderstyle') --}}

    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Id Number</th>
                        <th>Meter Number</th>
                        <th>Current Meter Number</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>

                            <th scope="row">{{ $customer->id }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone_number }}</td>
                            <td>{{ $customer->id_number }}</td>
                            <td>{{ $customer->meter_number }}</td>
                            <td>{{ $customer->current_meter_reading }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-danger">No Available Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $customers->links() }}
        </div>
    </div>
</section>
