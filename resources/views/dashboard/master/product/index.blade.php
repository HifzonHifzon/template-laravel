@extends('layouts.index')


@section('content')

<!-- End Card -->
<div class="col-xxl-12 col-md-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title"> Master Product </h5>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Product ID </th>
                                <th> Product Name</th>
                                <th> Weight</th>
                                <th> Price </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($result as $k => $v)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $v->ProductID }}</td>
                                    <td> {{ $v->ProductName }}</td>
                                    <td> {{ $v->Weight }}</td>
                                    <td> {{ $v->Price }}</td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Card -->

</script>

@endsection