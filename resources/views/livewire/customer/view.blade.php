@extends('layouts.layoutMaster')

@section('title', 'Customers')


@section('content')
    <div class="row">
        <div class="col">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Updates Customer Readings</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <hr>
                                        <form action="{{ route('customers.update', ['customer' => $customer]) }}"
                                            method="POST" novalidate="novalidate">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group text-center">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Customer Name</label>
                                                <input id="name" name="type34" type="text" class="form-control"
                                                    aria-required="true" aria-invalid="false"
                                                    value="{{ $customer->type == 1 ? 'Ordinary' : 'Organization/Institution' }}"
                                                    readonly>
                                                <input id="name" name="type" type="text" class="form-control"
                                                    aria-required="true" aria-invalid="false" value="{{ $customer->type }}"
                                                    placeholder="{{ $customer->type === 1 ? 'Ordinary' : 'Organization/Institution' }}"
                                                    readonly hidden>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Customer Name</label>
                                                <input id="name" name="name" type="text" class="form-control"
                                                    aria-required="true" aria-invalid="false" value="{{ $customer->name }}"
                                                    placeholder="{{ $customer->name }}" readonly>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="id_number" class="control-label mb-1">Id Number</label>
                                                <input id="id_number" name="id_number" type="text"
                                                    class="form-control cc-name valid" data-val="true"
                                                    data-val-required="Please enter the id number" autocomplete="id_number"
                                                    aria-required="true" aria-invalid="false" aria-describedby="id_number"
                                                    value="{{ $customer->id_number }}"
                                                    placeholder="{{ $customer->id_number }}" readonly>
                                                <span class="help-block field-validation-valid" data-valmsg-for="id_number"
                                                    data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number" class="control-label mb-1">Phone Number</label>
                                                <input id="phone_number" name="phone_number" type="tel"
                                                    class="form-control cc-number identified visa" data-val="true"
                                                    data-val-required="Please enter the phone number"
                                                    data-val-cc-number="Please enter a valid phone number"
                                                    value="{{ $customer->phone_number }}"
                                                    placeholder="{{ $customer->phone_number }}" readonly>
                                                <span class="help-block" data-valmsg-for="phone_number"
                                                    data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="meter_number" class="control-label mb-1">Meter
                                                            Number</label>
                                                        <input id="meter_number" name="meter_number" type="tel"
                                                            class="form-control cc-exp" data-val="true"
                                                            data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year"
                                                            value="{{ $customer->meter_number }}"
                                                            placeholder="{{ $customer->meter_number }}" readonly>
                                                        <span class="help-block" data-valmsg-for="cc-exp"
                                                            data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Current Meter
                                                        Reading</label>
                                                    <div class="input-group">
                                                        <input id="current_meter_reading" name="current_meter_reading"
                                                            type="tel" class="form-control cc-cvc" data-val="true"
                                                            data-val-required="Please current meter reading"
                                                            data-val-cc-cvc="Please enter a valid meter reading"
                                                            autocomplete="off"
                                                            value="{{ $customer->current_meter_reading }}"
                                                            placeholder="{{ $customer->current_meter_reading }}">
                                                        <div class="input-group-addon">
                                                            <span class="fa fa-question-circle fa-lg"
                                                                data-toggle="popover" data-container="body"
                                                                data-html="true" data-title="Security Code"
                                                                data-content="<div class='text-center one-card'>The 3 digit code on back of the card..<div class='visa-mc-cvc-preview'></div>
                                                                data-trigger="hover">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-success">
                                                    <label for="amount" class="control-label mb-1">Amount</label>
                                                    <input id="amount" name="amount" type="number"
                                                        inputmode="numeric" pattern="\d*"
                                                        class="form-control cc-name valid" data-val="true"
                                                        data-val-required="Please enter the amount" autocomplete="amount"
                                                        aria-required="true" aria-invalid="false"
                                                        aria-describedby="amount" placeholder="amount" required>
                                                    <span class="help-block field-validation-valid"
                                                        data-valmsg-for="amount" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <button type="submit" class="mr-1 btn btn-primary">Update
                                                    Reading</button>
                                                <a type="reset" href="{{ url()->previous() }}"
                                                    class="btn btn-outline-secondary">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Customer Meter Readings</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card">
                                        <div class="pt-0 card-datatable table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Previous</th>
                                                        <th>Current Read</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($customer->MeterReading as $customer)
                                                        <tr>
                                                            <th scope="row">{{ $customer->id }}</th>
                                                            <td>{{ $customer->previous_reading }}</td>
                                                            <td>{{ $customer->current_reading }}</td>
                                                            <td>{{ $customer->updated_at }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center text-danger">No
                                                                Available Data</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div>
                    <!--/.col-->
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

    @endsection
