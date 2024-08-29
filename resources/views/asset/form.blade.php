@extends ('layout/layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('style/css/form_po.css')}}">
@section('content')
    <form action="{{route('asset.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="position-absolute top-55 start-50 translate-middle formulir form-inline row">
        <h2 class="text-center mt-3 mb-3">FORMULIR ASSET <span>REGISTER</span></h2>
        @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}">
            {{ session('message')['desc'] }}
        </div>
        @endif
        <hr>
        <div class="mb-3 col-sm-4">
            <label for="invoice_id" class="form-label ">Nomor Invoice</label>
            <select class="form-control shadow" id="invoice_id" name="invoice_id" required>
                    <option value="">Pilih Salah Satu</option>
                @foreach ($invoices as $invoice)
                    <option value="{{$invoice->id}}">{{$invoice->nomor_invoice}}</option>
                @endforeach
            </select>
        </div>
        <table class="table" id="invoice_details">
            <thead>
                <tr>
                    <th>Asset Name</th>
                    <th>Asset Number</th>
                    <th>Asset Description</th>
                    <th>Invoice Number</th>
                    <th>Vendor Name</th>
                    <th>Resp Center</th>
                    <th>Date in Service</th>
                    <th>Depreciation Method</th>
                    <th>Life (M)</th>
                    <th>Cost</th>
                    <th>Residual</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <button type="submit" value="save" class="btn btn-primary col-md-12 mx-auto lapor-submit">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#invoice_id').change(function() {
            var invoiceId = $(this).val();
            if (invoiceId) {
                $.ajax({
                    url: '/data-purchase-order-detail/' + invoiceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);

                        var detailsTableBody = $('#invoice_details tbody');
                        detailsTableBody.empty();
                        data.purchaseOrderDetail.forEach(function(detail) {
                            var row = '<tr>' +
                                '<td><input type="text" name="asset_name[]" value="'+detail.product+'" class="form-control" readonly></td>' +
                                '<td><input type="text" name="asset_number[]" class="form-control" required></td>' +
                                '<td><input type="text" name="asset_description[]" class="form-control" required></td>' +
                                '<td><input type="text" name="nomor_invoice[]" value="'+data.invoice.nomor_invoice+'" class="form-control" readonly></td>' +
                                '<td><input type="text" name="vendor_name[]" value="'+data.purchaseOrder.nama_vendor+'" class="form-control" readonly></td>' +
                                '<td><input type="text" name="resp_center[]" value="'+data.purchaseOrder.vendor_phone+'" class="form-control" readonly></td>' +
                                '<td><input type="date" name="date_in_servics[]" value="{{date("Y-m-d")}}" class="form-control" required></td>' +
                                '<td><select class="form-control shadow" id="depreciation" name="depreciation[]" required><option value="Bangunan Gudang">Bangunan Gudang</option><option value="Peralatan dan Mesin">Peralatan dan Mesin</option><option value="Kendaraan">Kendaraan</option><option value="Peralatan Kantor">Peralatan Kantor</option><option value="Perangkat Lunak">Perangkat Lunak</option></select></td>'+
                                '<td><input type="number" name="life[]" class="form-control life" required></td>' +
                                '<td><input type="text" name="cost[]" value="'+detail.unit_price+'" class="form-control" readonly></td>' +
                                '<td><input type="text" name="residual[]" class="form-control residual" required></td>' +
                                '</tr>';
                            detailsTableBody.append(row);
                        });
                    },
                    error: function(xhr) {
                        alert('Error fetching invoice details.');
                    }
                });
            }
        });
    });
    // Function to add a new row
    // $('#add-row').click(function() {
    //     var newRow = `<tr>
    //         <td><input type="text" name="product_name[]" class="form-control" required></td>
    //         <td><input type="number" name="qty[]" class="form-control qty" required></td>
    //         <td><input type="number" name="price[]" class="form-control price" required></td>
    //         <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
    //         <td><button type="button" class="btn btn-danger delete-row" onclick="deleteRow(this)">X</button></td>
    //     </tr>`;
    //     $('#product-form').append(newRow);
    // });
     // Function to delete a row
    //  function deleteRow(button) {
    //     $(button).closest('tr').remove();
    //     calculateSubtotal();
    // }

    // Function to calculate total price when quantity or price changes
    $(document).on('input', '.qty, .price', function() {
        var $row = $(this).closest('tr');
        var qty = $row.find('.qty').val();
        var price = $row.find('.price').val();
        var total = qty * price;
        $row.find('.total_price').val(total);
        calculateSubtotal();
    });

    // Function to calculate subtotal
    function calculateSubtotal() {
        var subtotal = 0;
        $('.total_price').each(function() {
            var total = parseFloat($(this).val()) || 0;
            subtotal += total;
        });
        $('#subtotal').val(subtotal);
        calculateTotal();
    }

    // Function to calculate discount and final total
    function calculateTotal() {
        var subtotal = parseFloat($('#subtotal').val()) || 0;
        var discountPercent = parseFloat($('#discount').val()) || 0;
        var discountValue = (discountPercent / 100) * subtotal;
        $('#discount_value').val(discountValue);
        var finalTotal = subtotal - discountValue;
        $('#final_total').val(finalTotal);
    }
</script>
@endsection
