<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summary;
use App\Models\Report;

class SummaryController extends Controller
{
    public function index(Request $request)
    {
        $summaries = Summary::all();
        return view('summary/index', compact('summaries'));
    }

    public function form()
    {
        return view('summary/form');
    }

    public function save(Request $request)
    {
        try {
            $summary = new Summary;
            $summary->user_id = $request->user()->id;
            $summary->nama_adminAset = $request->nama_adminAset;
            $summary->tanggal_summary = $request->tanggal_summary;
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads',$filename, 'public');
            $summary->file = 'uploads/'. $filename;
            $summary->save();
            if($summary){
                $desc = 'Data berhasil disimpan';
                return redirect()->route('summary.index')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disimpan";
                return redirect()->route('invoice.add')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        } catch (\Throwable $th) {
            $desc = $th->getMessage();
            return redirect()->route('summary.add')->with('message', ['status'=>'danger', 'desc'=>$desc]);
        }
    }
}
