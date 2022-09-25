@extends('layouts.index')


@section('content')

<!-- End Card -->
<div class="col-xxl-12 col-md-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center"> Master Sales </h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal"> <i class="fa-solid fa-plus"></i> Add </button>
                    </div>

 
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Sales ID </th>
                                <th> Sales Name </th>
                                <th colspan=2> Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($result as $k => $v)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $v->SalesID }}</td>
                                    <td> {{ $v->SalesName }}</td>
                                    <td>  
                                        <div class="row">
                                            <div class="col-md-1">
                                                <form action="{{ url('/delete-sales') }}" method="POST">
                                                    <input type ="hidden" name="id" value="{{ $v->SalesID }}"> 
                                                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                    <button class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-md-1">
                                                <a class="btn btn-warning" href="{{ url('/sales/'.$v->SalesID) }}"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
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
        <h5 class="modal-title">Form Sales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
            <label for="inputText" class="col-sm-4 col-form-label">Sales ID</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="SalesID" placeholder="Sales ID">
                </div>
            </div>

            <div class="row mb-3">
            <label for="inputText" class="col-sm-4 col-form-label">Sales Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="SalesName" placeholder="Sales Name">
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveSales">Save changes</button>
        </div>
    </div>
    </div>
</div>

<script type="text/javascript">
    $('#saveSales').click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '<?= csrf_token() ?>'
            }
        });

        var $post = {};
            $post['sales'] = 'sales';
            $post['SalesID'] = $('#SalesID').val();
            $post['SalesName'] = $('#SalesName').val();

        $.ajax({
            url     : "{{ url('/save-sales') }}",
            data    : $post,
            type    : "POST",
            success:function(){
                location.reload();
            }
        })
    });

</script>

@endsection