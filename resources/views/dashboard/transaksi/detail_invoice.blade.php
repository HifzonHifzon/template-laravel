<div class="row">
<h3 style="margin-top:50px; text-align:center"> Detail Invoice </h3>
    <div class="col-md-12">

        <button class="btn btn-primary btn-md" style="margin:10px" id="add_detail" data-bs-target="#basicModal" data-bs-toggle="modal"> <i class="fa-solid fa-plus"></i> View Detail Invoice </button>
        <table class="table table-bordered table-hovered"> 
            <thead>
                <tr style="text-align: center;">
                    <th> No </th>
                    <th> Item </th>
                    <th> Weight </th>
                    <th> QTY </th>
                    <th> Unit Price </th>
                    <th> Total <i> (Weight * QTY * Harga) </i></th>
                </tr>
            </thead>
            <tbody>
            @if (!empty($result))
                @foreach ($result as $k => $v)
                <tr style="text-align: center;">
                    <td> {{ $loop->iteration }}</td>
                    <td> {{ $v->ProductName }}</td>
                    <td> {{ $v->Weight }}</td>
                    <td> {{ $v->Qty }}</td>
                    <td> RP. {{ number_format($v->Price,2) }}</td>
                    <td> RP. {{ number_format($v->Weight * $v->Price * $v->Qty,2) }}</td>
                </tr>
                @endforeach
            @endif
                <tr style="text-align: center;">
                    <th colspan="4">  </th>
                    <th> TOTAL </th>
                    <th> RP. {{ number_format( ($total[0]->total) ?? 0 ,2) ?? '0' }} </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>

 <div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Invoice</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <div class="row">
            <form action="{{ url('/invoice/detail/save') }}" method="POST">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="form-group">
                  <label for="usr">Invoice No :</label>
                  <input type="text" class="form-control" name="InvoiceNo" value="{{ $InvoiceNo }}" readonly="true">
                </div>
                <div class="form-group">
                  <label for="usr">Product :</label>
                  <select name="ProductID" class="form-control">
                      @foreach ($product as $k => $v)
                        <option value="{{ $v->ProductID }}"> Product : {{ $v->ProductName }} , Weight : {{ $v->Weight }} , Price : {{ $v->Price }}</option>
                      @endforeach   
                  </select>
                </div>

                <div class="form-group">
                  <label>Qty:</label>
                  <input type="number" class="form-control" name="Qty" placeholder="QTY">
                </div>
              <button type="submit" class="btn btn-primary" style="margin: 10px">Save changes</button>
           </form>
         </div>
        </div>
      </div>
    </div>
  </div><!-- End Basic Modal-->