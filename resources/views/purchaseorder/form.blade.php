@extends ('layout/layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('style/css/form_po.css')}}">
@section('content')
    <form action="{{route('po.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="position-absolute top-55 start-50 translate-middle formulir form-inline row">
        <h2 class="text-center mt-3 mb-3">FORMULIR PURCHASE <span>ORDER</span></h2>
        @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}">
            {{ session('message')['desc'] }}
        </div>
        @endif

        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif

        <hr>
        <div class="mb-2 col-sm-4">
            <label for="nama_procurement" class="form-label">Nama Procurement</label>
            <input type="text" name="nama_procurement" value="{{Auth::user()->name}}" class="form-control shadow" id="nama_procurement" placeholder="Enter your name" required>
        </div>
        <div class="mb-2 col-sm-4">
            <label for="nomor_po" class="form-label ">Nomor PO</label>
            <input type="text" name="nomor_po" class="form-control shadow " id="nomor_po" placeholder="Enter asset number" required>
        </div>
        <div class="mb-2 col-sm-4">
            <label for="tanggal_po" class="form-label">Tanggal PO</label>
            <input type="date" name="tanggal_po" value="{{date('Y-m-d')}}" class="form-control shadow" id="tanggal_po" placeholder="Another input placeholder" required>
        </div>

        <div class="mb-2 col-sm-3">
            <label for="nama_vendor" class="form-label">Nama Vendor</label>
            <input type="text" name="nama_vendor" value="" class="form-control shadow" id="nama_vendor" placeholder="Nama Vendor" required>
        </div>
        <div class="mb-2 col-sm-3">
            <label for="vendor_company" class="form-label ">Perusahaan Vendor</label>
            <input type="text" name="vendor_company" class="form-control shadow " id="vendor_company" placeholder="Enter asset number" required>
        </div>
        <div class="mb-2 col-sm-3">
            <label for="vendor_phone" class="form-label ">No Telp Vendor</label>
            <input type="text" name="vendor_phone" class="form-control shadow " id="vendor_phone" placeholder="Enter asset number" required>
        </div>
        <div class="mb-2 col-sm-3">
            <label for="vendor_email" class="form-label ">Email Vendor</label>
            <input type="text" name="vendor_email" class="form-control shadow " id="vendor_email" placeholder="Enter asset number" required>
        </div>
        <div class="mb-0">
            <label for="vendor_address" class="form-label">Alamat Vendor</label>
            <textarea name="vendor_address" class="form-control shadow" id="vendor_address" rows="3" placeholder="Message" required></textarea>
        </div>
        <div class="mb-2 col-sm-12">
        <table class="table table-po">
            <thead>
                <tr>
                    <th>Product Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="product-form">
                <tr>
                    <td><input type="text" name="product_name[]" class="form-control" required></td>
                    <td><input type="number" name="qty[]" class="form-control qty" required></td>
                    <td><input type="number" name="price[]" class="form-control price" required></td>
                    <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
                    <td><button type="button" class="btn delete-row x-button" onclick="deleteRow(this)">
                        <img src="{{asset('style/assets/remove.png')}}">
                    </button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary col-md-12 mx-auto lapor-submit" id="add-row">Add Product</button>
        </div>
        <hr>
        <div class="row">
            <div class="mb-1 col-sm-6">
                <div class="mb-0">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control shadow" id="catatan" rows="3" placeholder="Message" required></textarea>
                </div>
            </div>
            <div class="mb-1 col-sm-6">
                <table class="table">
                    <tr>
                        <th>Subtotal ($)</th>
                        <td><input type="text" id="subtotal" name="subtotal" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <th>Discount (%)</th>
                        <td>
                            <input type="number" id="discount" name="discount" class="form-control" oninput="calculateTotal()">
                            <input type="text" id="discount_value" class="form-control mt-2" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>Total Amount ($)</th>
                        <td><input type="text" id="final_total" name="final_total" class="form-control" readonly></td>
                    </tr>
                </table>
            </div>
        </div>


        <button type="submit" value="save" class="btn btn-primary col-md-12 mx-auto lapor-submit">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to add a new row
    $('#add-row').click(function() {
        var newRow = `<tr>
            <td><input type="text" name="product_name[]" class="form-control" required></td>
            <td><input type="number" name="qty[]" class="form-control qty" required></td>
            <td><input type="number" name="price[]" class="form-control price" required></td>
            <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
            <td><button type="button" class="btn delete-row x-button" onclick="deleteRow(this)">
            <img src="{{asset('style/assets/remove.png')}}"></button></td>
        </tr>`;
        $('#product-form').append(newRow);
    });
     // Function to delete a row
     function deleteRow(button) {
        $(button).closest('tr').remove();
        calculateSubtotal();
    }

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
