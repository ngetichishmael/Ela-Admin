@extends('layouts.layoutMaster')

@section('title', 'Customers')


@section('content')
    <div>
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Add new Customer</strong>
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
                                    <form action="{{ route('customers.store') }}" method="post" novalidate="novalidate">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group text-center">

                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Customer Name</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false" placeholder="Customer Name">
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="id_number" class="control-label mb-1">Id Number</label>
                                            <input id="id_number" name="id_number" type="text"
                                                class="form-control cc-name valid" data-val="true"
                                                data-val-required="Please enter the id number" autocomplete="id_number"
                                                aria-required="true" aria-invalid="false" aria-describedby="id_number"
                                                placeholder="ID Number">
                                            <span class="help-block field-validation-valid" data-valmsg-for="id_number"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number" class="control-label mb-1">Phone Number</label>
                                            <input id="phone_number" name="phone_number" type="tel"
                                                class="form-control cc-number identified visa" value=""
                                                data-val="true" data-val-required="Please enter the phone number"
                                                data-val-cc-number="Please enter a valid phone number"
                                                placeholder="Phone Number">
                                            <span class="help-block" data-valmsg-for="phone_number"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="meter_number" class="control-label mb-1">Meter
                                                        Number</label>
                                                    <input id="meter_number" name="meter_number" type="tel"
                                                        class="form-control cc-exp" value="" data-val="true"
                                                        data-val-required="Please enter the card expiration"
                                                        data-val-cc-exp="Please enter a valid month and year"
                                                        placeholder="Meter Reading">
                                                    <span class="help-block" data-valmsg-for="cc-exp"
                                                        data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="x_card_code" class="control-label mb-1">Current Meter
                                                    Reading</label>
                                                <div class="input-group">
                                                    <input id="current_meter_reading" name="current_meter_reading"
                                                        type="tel" class="form-control cc-cvc" value=""
                                                        data-val="true" data-val-required="Please current meter reading"
                                                        data-val-cc-cvc="Please enter a valid meter reading"
                                                        autocomplete="off" placeholder="Current Reading">
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-question-circle fa-lg" data-toggle="popover"
                                                            data-container="body" data-html="true"
                                                            data-title="Security Code"
                                                            data-content="<div class='text-center one-card'>The 3 digit code on back of the card..<div class='visa-mc-cvc-preview'></div></div>"
                                                            data-trigger="hover"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <button type="submit" class="mr-1 btn btn-primary">Submit</button>
                                            <a type="reset" href="{{ url()->previous() }}"
                                                class="btn btn-outline-secondary">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div> <!-- .card -->

                </div>
                <!--/.col-->
            </div>
        </div>
        <div class="clearfix"></div>

    @endsection
