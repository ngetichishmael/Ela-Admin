@extends('layouts.layoutMaster')

@section('title', 'Customers')


@section('content')
    <div>
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Customer Notification</strong>
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
                                    <form action="{{ route('bulk-sms.store') }}" method="post" novalidate="novalidate">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group text-center">

                                        </div>
                                        <div class="form-group text-center">
                                            <div class="col col-md-12"><label for="textarea-input"
                                                    class=" form-control-label">Notify ALL Customers</label></div>
                                            <div class="col-12 col-md-9">
                                            </div>
                                            <div class="form-group text-center">

                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row form-group">
                                                    <textarea name="text" id="textarea-input" rows="9" maxlength="159"
                                                        placeholder="Content... Maximum 160 characters" class="form-control" required></textarea>
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
