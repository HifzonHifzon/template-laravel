@extends('layouts.index')


@section('content')


    <!-- End Card -->
    <div class="col-xxl-12 col-md-12">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title" style="text-align: center"> Update Courier </h5>
                <div class="row">

                    <form action="{{ url('/courier/update') }}" method="POST">
                        <div class="col-md-12">
                            <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Courier ID</label>
                                <div class="col-sm-8">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                    <input type="number" class="form-control" name="CourierID" placeholder="Courier ID" value="{{ $result->CourierID}}">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Courier Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="CourierName" placeholder="Courier Name" value="{{ $result->CourierName}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-8">
                                <button class="btn btn-info"> Update </button>
                                </div>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Card -->


@endsection