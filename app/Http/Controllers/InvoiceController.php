<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->role_id==4){
            $invoices = Invoice::where('user_id',$request->user()->id)->get();
        }else{
            $invoices = Invoice::all();
        }
        return view('invoice/index',compact('invoices'));
    }

    public function form()
    {
        $purchaseOrders = PurchaseOrder::all();
        return view('invoice/form',compact('purchaseOrders'));
    }

    public function save(Request $request)
    {
        try {
            $invoice = new Invoice;
            $invoice->user_id           = $request->user()->id;
            $invoice->purchase_order_id = $request->purchase_order_id;
            $invoice->nama_procurement  = $request->nama_procurement;
            $invoice->nomor_invoice     = $request->nomor_invoice;
            $invoice->tanggal_invoice   = $request->tanggal_invoice;
            $invoice->keterangan        = $request->keterangan;
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');
            $invoice->file = 'uploads/'.$filename;
            $invoice->save();
            if($invoice){
                $desc = "Data berhasil disimpan";
                return redirect()->route('invoice.index')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disimpan";
                return redirect()->route('invoice.add')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('invoice.add')->with('message', ['status'=>'danger','desc'=>$desc]);
        }
    }

    public function payment(Request $request)
    {
        $invoices = Invoice::where('status',0)->get();
        return view('invoice/payment',compact('invoices'));
    }

    public function savePayment(Request $request)
    {
        try {
            $invoice = Invoice::find($request->invoice_id);
            $invoice->finance_id    = $request->user()->id;
            $invoice->status        = 1;
            $file                   = $request->file('proof');
            $filename               = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');
            $invoice->proof         = 'uploads/'.$filename;
            $invoice->save();
            if($invoice){
                $desc = "Data berhasil disimpan";
                return redirect()->route('invoice.index')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disimpan";
                return redirect()->route('payment.index')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('payment.index')->with('message', ['status'=>'danger','desc'=>$desc]);
        }
    }


}
