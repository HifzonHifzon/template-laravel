@extends('layouts.index')


@section('content')

<!-- Sales Card -->
<div class="col-xxl-12 col-md-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Transaction </h5>
            <div class="row">
                <div class="col-md-3">
                    {{-- <input type="text" class="form-control" id="id_search" placeholder="Search Invoice"> --}}
                    <select class="form-control" id="invoice_id" > 
                        @foreach ($invoice_all as $k => $v)
                            <option value="{{ $v->InvoiceNo }} "> {{ $v->InvoiceNo }} </option>
                        @endforeach
                    </select>

                    <i> * Pembuatan Invoice awal dibuat pada menu List Invoice </i>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary btn-md" id="search"> <i class="fa-solid fa-magnifying-glass"></i> Search </button>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Sales Card -->

<div class="col-xxl-12 col-md-12">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Form Transaksi </h5>
            <div id="content"> </div>
        </div>
    </div>
</div><!-- End Sales Card -->


<script type="text/javascript">

    $('#search').click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '<?= csrf_token() ?>'
            }
        });

       var $search_invoice = $('#invoice_id').val()
       var $post = {};
           $post['invoice_id'] = $search_invoice;


       $.ajax({
        url : "{{ url('/invoice/form') }}",
        data : $post,
        type: "POST",
        success:function(res){
            // alert(res)

            $('#content').html(res);
        }

       });
    });

</script>

@endsection