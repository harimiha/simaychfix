<!DOCTYPE html>
<html>

<head>
    <title>Purchase Order {{$purchaseOrder->nomor_po}}</title>\
</head>
<body>
    <table width="100%">
        <thead>
            <tr>
                <td width="60%">
                    <!-- <img src="{{asset('style/logo.png')}}" alt="logo" width="50"/> -->
                </td>
                <td style="text-align: left" colspan="2">
                    <h2>PURCHASE ORDER</h2>
                </td>
            </tr>
            <tr>
                <td width="" colspan="3"></td>
            </tr>
            <tr>
                <td width="60%">
                    &nbsp;
                </td>
                <td style="text-align: left;background-color:#064399;color:#FFFFFF;padding:4px;">
                    PO NUMBER
                </td>
                <td style="text-align: left;background-color:#064399;color:#FFFFFF;padding:4px;">
                    DATE
                </td>
            </tr>
            <tr>
                <td width="60%">
                    &nbsp;
                </td>
                <td style="text-align: left;border: 1px solid #000;">
                    {{$purchaseOrder->nomor_po}}
                </td>
                <td style="text-align: left;border: 1px solid #000;">
                    {{$purchaseOrder->tanggal_po}}
                </td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </thead>
    </table>

    <table width="100%" style="margin-bottom: 10px;margin-top:5px;">
        <thead>
            <tr>
                <td colspan="2" width="50%" style="text-align:left;color:#FFFFFF;padding:4px;margin-bottom: 10px; background-color:#064399"><b>VENDOR</b></td>
                <td colspan="2" width="50%" style="text-align:left;color:#FFFFFF;padding:4px;margin-bottom: 10px; background-color:#064399"><b>CUSTOMER</b></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:left;margin-bottom: 10px;"></td>
                <td colspan="2" style="text-align:left;margin-bottom: 10px;"></td>
            </tr>
            <tr>
                <td colspan="2">NAME</td>
                <td colspan="2">NAME</td>
            </tr>
            <tr>
                <td colspan="2"><b>{{$purchaseOrder->nama_vendor}}</b></td>
                <td colspan="2"><b>PT. YCH Indonesia SP Semarang</b></td>
            </tr>
            <tr>
                <td colspan="2">COMPANY NAME</td>
                <td colspan="2">COMPANY NAME</td>
            </tr>
            <tr>
                <td colspan="2"><b>{{$purchaseOrder->vendor_company}}</b></td>
                <td colspan="2"><b>PT YCH Indonesia Semarang</b></td>
            </tr>
            <tr>
                <td colspan="2">ADDRESS</td>
                <td colspan="2">ADDRESS</td>
            </tr>
            <tr>
                <td colspan="2" width="50%"><b>{{$purchaseOrder->vendor_address}}</b></td>
                <td colspan="2" width="50%"><b>Kawasan Industri Candi Block XI-A
                Jl. Gatot Subroto, Bambankerep, Semarang 50211, Central Java, Indonesia</b></td>
            </tr>
            <tr>
                <td colspan="2">PHONE</td>
                <td colspan="2">PHONE</td>
            </tr>
            <tr>
                <td colspan="2"><b>{{$purchaseOrder->vendor_phone}}</b></td>
                <td colspan="2"><b>(+62 21) 883 0828</b></td>
            </tr>
            <tr>
                <td colspan="2">EMAIL ADDRESS</td>
                <td colspan="2">EMAIL ADDRESS</td>
            </tr>
            <tr>
                <td colspan="2"><b>{{$purchaseOrder->vendor_email}}</b></td>
                <td colspan="2"><b>indonesia@ych.com</b></td>
            </tr>
        </thead>
    </table>
    <div>
        <table width="100%" cellspacing="0" cellpadding="3" class="table table-bordered"
            style="border-collapse: collapse">
            <thead>
                <tr>
                    <th style="background-color:#064399;color:#FFFFFF;padding:4px;text-align: left; border: 1px solid #000;"><b>Product Description</b></th>
                    <th style="background-color:#064399;color:#FFFFFF;padding:4px;text-align: center;border: 1px solid #000;"><b>Quantity</b></th>
                    <th style="background-color:#064399;color:#FFFFFF;padding:4px;text-align: right;border: 1px solid #000;"><b>Unit Price</b></th>
                    <th style="background-color:#064399;color:#FFFFFF;padding:4px;text-align: right;border: 1px solid #000;"><b>Amount</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchaseOrder->details as $key=>$detail)
                    <tr>
                        <td valign="top" style='border: 1px solid #000;text-align:left;'>{{$detail->product}}</td>
                        <td valign="top" style="border: 1px solid #000;text-align: center;">{{$detail->qty}}</td>
                        <td valign="top" style="border: 1px solid #000;text-align: right;">{{ number_format($detail->unit_price,0,',','.')}}</td>
                        <td valign="top" style="border: 1px solid #000;text-align: right;">{{number_format(($detail->unit_price * $detail->qty),0,',','.')}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td style="background-color:#064399;color:#FFFFFF;padding:4px;" valign="top" colspan="2">Note</td>
                    <td valign="top" style="text-align: right;">Subtotal ($)</td>
                    <td valign="top" style="text-align: right;">{{number_format($purchaseOrder->sub_total,0,',','.')}}</td>
                </tr>
                <tr>
                    <td style="" valign="top" colspan="2">{{$purchaseOrder->catatan}}</td>
                    <td valign="top" style="text-align: right;">Discount (%)  {{$purchaseOrder->discount}}</td>
                    <td valign="top" style="text-align: right;">- {{number_format($purchaseOrder->discount / 100 * $purchaseOrder->sub_total,0,',','.')}}</td>
                </tr>
                <tr>
                    <td style="" valign="top"></td>
                    <td valign="top" style=""></td>
                    <td valign="top" style="text-align: right;font-weight:bold;">Total Amount ($)</td>
                    <td valign="top" style="text-align: right;font-weight:bold;">{{number_format($purchaseOrder->total,0,',','.')}}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>

