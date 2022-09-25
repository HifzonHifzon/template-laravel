<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="usr">Invoice No : </label>
            <input type="text" class="form-control"  name="InvoiceNo" id="InvoiceNo" value="{{ $invoice_list->InvoiceNo }}" readonly="true">
        </div>

        <div class="form-group">
        <label for="usr">Invoice Date : </label>
            <input type="date" class="form-control"  name="InvoiceDate" id="InvoiceDate" value="{{ date('Y-m-d', strtotime($invoice_list->InvoiceDate)) }}">
        </div>
        <div class="form-group">
            <label for="usr">To :</label>
            <textarea class="form-control" cols="30" rows="10" name="InvoiceTo" id="InvoiceTo">{{ $invoice_list->InvoiceTo }}</textarea>
        </div>


        <div class="form-group">
            <label for="usr">Sales Name :</label>
            <select class="form-control" name="SalesID" id="SalesID">  
                @foreach ($sales_list as $k => $v)
                    <option value="{{ $v->SalesID }} " {{ $v->SalesID === $invoice_list->SalesID ? "selected" : "" }}> {{ $v->SalesName }} </option>
                @endforeach
            </select>
        </div>

        
        <div class="form-group">
            <label for="usr">Courier :</label>
            <select name="CourierID" class="form-control" id="CourierID"> 
            @foreach ($courier_list as $k => $v)
                <option value="{{ $v->CourierID }} " {{ $v->CourierID === $invoice_list->CourierID ? "selected" : "" }}> {{ $v->CourierName }} </option>
            @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label for="usr">Ship To :</label>
                <textarea class="form-control" cols="30" rows="10" name="ShipTo" id="ShipTo">{{ $invoice_list->ShipTo }}</textarea>
            </div>

        <div class="form-group">
            <label for="usr">Payment Type :</label>
             <select name="sales_id" class="form-control" name="PaymentType" id="PaymentType"> 
                @foreach ($payment_list as $k => $v)
                    <option value="{{ $v->PaymentID }}" {{ $v->PaymentID === $invoice_list->PaymentType ? "selected" : "" }}> {{ $v->PaymentName }} </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-warning btn-md" style="margin:10px" id="update_invoice"><i class="fa-solid fa-pencil"></i> Update </button>
        <button class="btn btn-primary btn-md" style="margin:10px" id="id_detail_invoice"> <i class="fa-solid fa-eye"></i> View Detail Invoice </button>
    </div>
</div>


<div id="detail_invoice"> 


</div>

<script>


$('#update_invoice').click(function(){
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '<?= csrf_token() ?>'
            }
        });

    var $post = {};
        $post['InvoiceNo'] = $('#InvoiceNo').val();
        $post['InvoiceDate'] = $('#InvoiceDate').val();
        $post['InvoiceTo'] = $('#InvoiceTo').val();
        $post['SalesID'] = $('#SalesID').val();
        $post['CourierID'] = $('#CourierID').val();
        $post['ShipTo'] = $('#ShipTo').val();
        $post['PaymentType'] = $('#PaymentType').val();

    $.ajax({
        url     : "{{ url('/invoice/update') }}",
        data    : $post,
        type    : "POST",
        success:function(res){
            alert('Berhasil di update')
        }


    });


});




$('#id_detail_invoice').click(function(){
     var $post = {};
        $post['InvoiceNo'] = $('#InvoiceNo').val();
     
         $.ajax({
            url     : "{{ url('/invoice/detail') }}",
            data    : $post,
            type    : "POST",
            success:function(res){
                $('#detail_invoice').html(res);
            }
    });
 });

</script>