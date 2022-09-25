@extends('layouts.index')


@section('content')

<!-- End Card -->
<div class="col-xxl-12 col-md-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title"> Master Courier </h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal"> <i class="fa-solid fa-plus"></i> Add </button>
                    </div>

                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Courier ID </th>
                                <th> Courier Name </th>
                                <th colspan="2"> Action </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($result as $k => $v)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $v->CourierID }}</td>
                                    <td> {{ $v->CourierName }}</td>
                                    <td>  
                                        <div class="row">
                                            <div class="col-md-1">
                                                <form action="{{ url('/delete-courier') }}" method="POST">
                                                    <input type ="hidden" name="id" value="{{ $v->CourierID }}"> 
                                                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                    <button class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-md-1">
                                                <a class="btn btn-warning" href="{{ url('/courier/'.$v->CourierID) }}"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
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
        <h5 class="modal-title">Form Courier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
            <label for="inputText" class="col-sm-4 col-form-label">Courier ID</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="CourierID" placeholder="Courier ID">
                </div>
            </div>

            <div class="row mb-3">
            <label for="inputText" class="col-sm-4 col-form-label">Courier Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="CourierName" placeholder="Courier Name">
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveCourier">Save changes</button>
        </div>
    </div>
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