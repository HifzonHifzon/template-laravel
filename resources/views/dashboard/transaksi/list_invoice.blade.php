@extends('layouts.index')


@section('content')

<!-- End Card -->
<div class="col-xxl-12 col-md-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title"> Master Invoice </h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal"> <i class="fa-solid fa-plus"></i> Add </button>
                    </div>

                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Invoice No</th>
                                <th> Invoice To  </th>
                                <th> Ship To  </th>
                                <th> Sales Name  </th>
                                <th> Courier Name </th>
                                <th> Payment Name </th>
                                <th colspan="2"> Action </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($result as $k => $v)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $v->InvoiceNo }}</td>
                                    <td> {{ $v->InvoiceTo }}</td>
                                    <td> {{ $v->ShipTo }}</td>
                                    <td> {{ $v->SalesName }}</td>
                                    <td> {{ $v->CourierName }}</td>
                                    <td> {{ $v->PaymentName }}</td>
                                    <td>  
                                        <div class="row">
                                            <div class="col-md-1">
                                                <form action="{{ url('/delete-courier') }}" method="POST">
                                                    <input type ="hidden" name="id" value="{{ $v->CourierID }}"> 
                                                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                    <button class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Card -->


<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Form Invoice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


        <form action="{{ url('/invoice/save') }}" method="POST"> 
           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
           <div class="row">
			    <div class="col-md-12">
			        <div class="form-group">

			        <div class="form-group">
			        <label for="usr">Invoice Date : </label>
			            <input type="date" class="form-control"  name="InvoiceDate" id="InvoiceDate">
			        </div>
			        <div class="form-group">
			            <label for="usr">To :</label>
			            <textarea class="form-control" cols="30" rows="10" name="InvoiceTo" id="InvoiceTo"></textarea>
			        </div>


			        <div class="form-group">
			            <label for="usr">Sales Name :</label>
			            <select class="form-control" name="SalesID" id="SalesID">  
			                @foreach ($sales_list as $k => $v)
			                    <option value="{{ $v->SalesID }} "> {{ $v->SalesName }} </option>
			                @endforeach
			            </select>
			        </div>

			        
			        <div class="form-group">
			            <label for="usr">Courier :</label>
			            <select name="CourierID" class="form-control" id="CourierID"> 
			            @foreach ($courier_list as $k => $v)
			                <option value="{{ $v->CourierID }} "> {{ $v->CourierName }} </option>
			            @endforeach
			            </select>
			        </div>
			    </div>

			    <div class="col-md-12">
			        <div class="form-group">
			            <div class="form-group">
			                <label for="usr">Ship To :</label>
			                <textarea class="form-control" cols="30" rows="10" name="ShipTo" id="ShipTo"></textarea>
			            </div>

			        <div class="form-group">
			            <label for="usr">Payment Type :</label>
			             <select  class="form-control" name="PaymentType" id="PaymentType"> 
			                @foreach ($payment_list as $k => $v)
			                    <option value="{{ $v->PaymentID }}"> {{ $v->PaymentName }} </option>
			                @endforeach
			            </select>
			        </div>
			    </div>
			</div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="saveCourier">Save changes</button>
        </div>
    </div>

	</form>
    </div>
</div>

<script type="text/javascript">
    $('#saveCourier').click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                }
            });

            var $post = {};
                $post['CourierID'] = $('#CourierID').val();
                $post['CourierName'] = $('#CourierName').val();

            $.ajax({
                url     : "{{ url('/save-courier') }}",
                data    : $post,
                type    : "POST",
                success:function(){
                    location.reload();
                }
            })
        });
</script>

@endsection