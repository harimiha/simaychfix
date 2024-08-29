<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->role_id==6){
            $reports = Report::where('user_id',$request->user()->id)->get();
        }else{
            $reports = Report::all();
        }
        return view('report/index',compact('reports'));
    }

    public function form()
    {
        return view('report/form');
    }

    public function save(Request $request)
    {
        $request->validate([
            'foto' => 'required|mimes:jpg,jpeg,png|max:2048', // validasi tipe file dan ukuran maksimal 2MB
            'nama_pegawai' => 'required|string|max:255',
            'nomor_aset' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'deskripsi_kerusakan' => 'required|string|max:1000',
        ]);        

        try {
            $report = new Report;
            $report->user_id             = $request->user()->id;
            $report->nama_pegawai        = $request->nama_pegawai;
            $report->nomor_aset          = $request->nomor_aset;
            $report->tanggal_pengajuan   = $request->tanggal_pengajuan;
            $report->deskripsi_kerusakan = $request->deskripsi_kerusakan;
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');
            $report->foto = 'uploads/'.$filename;
            $report->save();
            if($report){
                // $users = User::where('role_id', 5)->get();
                // $body = $request->nama_pegawai.' telah melakukan pelaporan aset. <br/>Mohon segera ditinjau dan diverifikasi!'.'<br/> Link '.route('reportasset.check');
                // Mail::to($users)->send(new SendMail([
                //     'title' => 'Pelaporan Kerusakan Aset',
                //     'body' => $body
                // ]));
                $desc = "Data berhasil disimpan";
                return redirect()->route('reportasset.progress')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disimpan";
                return redirect()->route('report.create')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('report.create')->with('message', ['status'=>'danger','desc' => $th->getMessage()]);
        }

    }

    public function check(Request $request)
    {
        $reports = Report::where('status',0)->get();
        return view('report/check',compact('reports'));
    }

    public function approved(Request $request)
    {
        try {
            $report = Report::find($request->report_approve_id);
            $report->status        = 1;
            $report->process_id    = $request->user()->id;
            $report->save();
            if($report){
                // $users = User::find($report->user_id);
                // $body = $request->user()->name.' telah menyetujui pelaporan aset Anda.'.'<br/> Link '.route('reportasset.progress');
                // Mail::to($users)->send(new SendMail([
                //     'title' => 'Pelaporan Kerusakan Aset Disetujui',
                //     'body' => $body
                // ]));
                $desc = "Data berhasil disetujui";
                return redirect()->route('reportasset.progress')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disetujui";
                return redirect()->route('reportasset.check')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('reportasset.check')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }
    public function rejected(Request $request)
    {
        try {
            $report = Report::find($request->report_id);
            $report->status        = 2;
            $report->reason_reject = $request->reason_reject;
            $report->process_id    = $request->user()->id;
            $report->save();
            if($report){
                // $users = User::find($report->user_id);
                // $body = $request->user()->name.' telah menolak pelaporan aset Anda.'.'<br/> Link '.route('reportasset.progress');
                // Mail::to($users)->send(new SendMail([
                //     'title' => 'Pelaporan Kerusakan Aset ditolak',
                //     'body' => $body
                // ]));
                $desc = "Data berhasil ditolak";
                return redirect()->route('reportasset.progress')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal ditolak";
                return redirect()->route('reportasset.check')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('reportasset.check')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }
}
