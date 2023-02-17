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

    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Id Number</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fieldworkers as $worker)
                        <tr>

                            <th scope="row">{{ $worker->id }}</th>
                            <td>{{ $worker->name }}</td>
                            <td>{{ $worker->id_number }}</td>
                            <td>{{ $worker->phone_number }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-danger">No Available Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $fieldworkers->links() }}
        </div>
    </div>
</section>
