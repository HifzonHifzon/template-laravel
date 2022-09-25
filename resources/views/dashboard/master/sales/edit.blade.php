@extends('layouts.index')


@section('content')


    <!-- End Card -->
    <div class="col-xxl-12 col-md-12">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title" style="text-align: center"> Update Sales </h5>
                <div class="row">

                    <form action="{{ url('/sales/update') }}" method="POST">
                        <div class="col-md-12">
                            <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Sales ID</label>
                                <div class="col-sm-8">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                    <input type="number" class="form-control" name="SalesID" placeholder="Sales ID" value="{{ $result->SalesID}}">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Sales Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="SalesName" placeholder="Sales Name" value="{{ $result->SalesName}}">
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