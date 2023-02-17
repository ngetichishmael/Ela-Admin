@extends('layouts.layoutMaster')

@section('title', 'Field Work')


@section('content')
    <div>
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Add new Field Worker</strong>
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
                                    <form method="POST" action="{{ route('field-workers.store') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group text-center">

                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Full Names</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false" placeholder="Full Name">
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="id_number" class="control-label mb-1">Id Number</label>
                                            <input id="id_number" name="id_number" type="text"
                                                class="form-control cc-name valid" data-val="true"
                                                data-val-required="Please enter the name on card" autocomplete="cc-name"
                                                aria-required="true" aria-invalid="false" aria-describedby="cc-name"
                                                placeholder="ID Number">
                                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name"
                                                data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number" class="control-label mb-1">Phone Number</label>
                                            <input id="phone_number" name="phone_number" type="tel"
                                                class="form-control cc-number identified visa" value=""
                                                data-val="true" data-val-required="Please enter the card number"
                                                data-val-cc-number="Please enter a valid card number"
                                                placeholder="Phone Number">
                                            <span class="help-block" data-valmsg-for="cc-number"
                                                data-valmsg-replace="true"></span>
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
    </div>
    <div class="clearfix"></div>

@endsection
