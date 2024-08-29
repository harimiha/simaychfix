<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;
use PDF;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $purchaseOrders = PurchaseOrder::where('user_id',$request->user()->id)->get();
        return view('purchaseorder/index',compact('purchaseOrders'));
    }

    public function form()
    {
        return view('purchaseorder/form');
    }

    public function save(Request $request)
    {
        try {
            $purchaseOrder = new PurchaseOrder;
            $purchaseOrder->user_id           = $request->user()->id;
            $purchaseOrder->nama_procurement  = $request->nama_procurement;
            $purchaseOrder->nomor_po          = $request->nomor_po;
            $purchaseOrder->tanggal_po        = $request->tanggal_po;
            $purchaseOrder->nama_vendor       = $request->nama_vendor;
            $purchaseOrder->vendor_company    = $request->vendor_company;
            $purchaseOrder->vendor_address    = $request->vendor_address;
            $purchaseOrder->vendor_phone      = $request->vendor_phone;
            $purchaseOrder->vendor_email      = $request->vendor_email;
            $purchaseOrder->sub_total         = $request->subtotal;
            $purchaseOrder->discount          = $request->discount;
            $purchaseOrder->total             = $request->final_total;
            $purchaseOrder->catatan           = $request->catatan;
            $purchaseOrder->save();
            if($purchaseOrder){
                foreach ($request->product_name as $key => $value) {
                    $purchaseOrderDetail = new PurchaseOrderDetail;
                    $purchaseOrderDetail->purchase_order_id = $purchaseOrder->id;
                    $purchaseOrderDetail->product           = $value;
                    $purchaseOrderDetail->qty               = $request->qty[$key];
                    $purchaseOrderDetail->unit_price        = $request->price[$key];
                    $purchaseOrderDetail->save();
                }
                $desc = "Data berhasil disimpan";
                return redirect()->route('po.index')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disimpan";
                return redirect()->route('po.submit')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('po.submit')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }

    public function pdf(Request $request, $id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $config = [
            'format'                => 'A4',
            'mode'                  => '',
            'default_font_size'     => '10',
            'default_font'          => '',
            'margin_left'           => 20,
            'margin_right'          => 20,
            'margin_top'            => 3,
            'margin_bottom'         => 20,
            'margin_header'         => 10,
            'margin_footer'         => 10,
            'title'                 => 'Purchase Order',
            'author'                => 'Purchase Order',
            'watermark_font'        => 'sans-serif',
            'display_mode'          => 'default',
        ];
        $pdf = PDF::loadView('purchaseorder/pdf', ['purchaseOrder' => $purchaseOrder], [], $config);
        ob_get_clean();
        return $pdf->stream('Purchase Order "' .$purchaseOrder->nomor_po.''.date('d_m_Y H_i_s') . '".pdf');
    }

}
