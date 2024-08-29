<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Invoice;
use App\Models\Asset;
use App\Models\Nbv;
use Illuminate\Http\Request;
use PDF;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $assets = Asset::all();
        return view('asset/index',compact('assets'));
    }

    public function form()
    {
        $invoices = Invoice::where('status',1)->get();
        return view('asset/form',compact('invoices'));
    }

    public function getPoDetails($id)
    {
        $invoice        = Invoice::find($id);
        $purchaseOrder  = PurchaseOrder::find($invoice->purchase_order_id);
        $poDetails      = PurchaseOrderDetail::where('purchase_order_id', $invoice->purchase_order_id)->get();
        $json_data      = array(
            "invoice"               => $invoice,
            "purchaseOrder"         => $purchaseOrder,
            "purchaseOrderDetail"   => $poDetails
        );
        return json_encode($json_data);
    }

    public function save(Request $request)
    {
        try {
            foreach ($request->asset_name as $key => $value) {
                $asset = new Asset;
                $asset->asset_name          = $value;
                $asset->asset_number        = $request->asset_number[$key];
                $asset->asset_description   = $request->asset_description[$key];
                $asset->invoice_number      = $request->nomor_invoice[$key];
                $asset->vendor_name         = $request->vendor_name[$key];
                $asset->resp_center         = $request->resp_center[$key];
                $asset->date_in_service     = $request->date_in_servics[$key];
                $asset->depreciation_method = $request->depreciation[$key];
                $asset->life                = $request->life[$key];
                $asset->cost                = $request->cost[$key];
                $asset->residual            = $request->residual[$key];
                if($request->depreciation[$key]=='Bangunan Gudang' || $request->depreciation[$key]=='Kendaraan' || $request->depreciation[$key]=='Peralatan Kantor' || $request->depreciation[$key]=='Peralatan Lunak'){
                    $asset->depreciation_year   = round((($request->cost[$key] - $request->residual[$key]) /($request->life[$key] / 12)),2);
                }else{
                    // $check = Asset::where('asset_number', $request->asset_number[$key])->latest()->first();
                    // $asset->depreciation_year   = $check ? ($check->depreciation_year * 20/100) : 0;
                    $asset->depreciation_year   = round(($request->cost[$key] - $request->residual[$key]) / ($request->life[$key] / 12),2);
                }
                $asset->save();
                if($asset){
                    $year = intdiv($request->life[$key] - 1, 12) + 1;
                    for ($i=1; $i <= $year; $i++) {
                        $nbv = new Nbv;
                        $nbv->asset_id = $asset->id;
                        $nbv->value    = $request->cost[$key]-($asset->depreciation_year * $i);
                        $nbv->save();
                    }
                }
            }
            $desc = "Data berhasil disimpan";
            return redirect()->route('asset.index')->with('message', ['status'=>'success','desc'=>$desc]);
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('asset.add')->with('message', ['status'=>'danger','desc'=>$desc]);
        }
    }

}
