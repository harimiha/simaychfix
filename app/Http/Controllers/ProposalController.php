<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendMail;
use App\Models\Report;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->role_id==6){
            $proposals = Proposal::where('user_id',$request->user()->id)->get();
        }elseif($request->user()->role_id==1){
            $proposals = Proposal::whereIn('status',[1,3,4])->get();
        }else{
            $proposals = Proposal::all();
        }
        return view('proposal/index',compact('proposals'));
    }

    public function form()
    {
        return view('proposal/form');
    }

    public function save(Request $request)
    {
        try {
            $proposal = new Proposal;
            $proposal->user_id             = $request->user()->id;
            $proposal->nama_procurement     = $request->nama_procurement;
            $proposal->nomor_aset          = $request->nomor_aset;
            $proposal->tanggal_pengajuan   = $request->tanggal_pengajuan;
            $file = $request->file('doc');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');
            $proposal->doc = 'uploads/'.$filename;
            $proposal->save();
            if($proposal){
                $users = User::where('role_id', 3)->get();
                $body = $request->nama_procurement.' telah melakukan mengajukan proposal harga. <br/>Mohon segera ditinjau dan diverifikasi!';
                Mail::to($users)->send(new SendMail([
                    'title' => 'Pengajuan Proposal Harga',
                    'body' => $body
                ]));
                $desc = "Data berhasil disimpan";
                return redirect()->route('ph.progress')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disimpan";
                return redirect()->route('ph.submit')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('ph.submit')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }

    public function check(Request $request)
    {
        if($request->user()->role_id==3){
            $proposals = Proposal::where('status',0)->get();
        }elseif($request->user()->role_id==1){
            $proposals = Proposal::where('status',1)->get();
        }
        return view('proposal/check',compact('proposals'));
    }

    public function approved(Request $request)
    {
        try {
            $proposal = Proposal::find($request->proposal_approve_id);
            $proposal->status        = $request->user()->role_id==3 ? 1 : 3;
            if($request->user()->role_id==3){
                $proposal->process_hod_id    = $request->user()->id;
                $users = User::where('role_id', 1)->get();
                $body = 'HOD telah memverifikasi pengajuan proposal harga. <br/>Mohon segera ditinjau dan diverifikasi!';
                Mail::to($users)->send(new SendMail([
                    'title' => 'Pengajuan Proposal Harga',
                    'body' => $body
                ]));
                $desc = "Data berhasil disimpan";
            }else{
                $proposal->process_cgm_id    = $request->user()->id;
            }
            $proposal->save();
            if($proposal){
                $desc = "Data berhasil disetujui";
                return redirect()->route('ph.progress')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disetujui";
                return redirect()->route('review.index')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('review.index')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }

    public function rejected(Request $request)
    {
        try {
            $proposal = Proposal::find($request->proposal_id);
            $proposal->status        = $request->user()->role_id==3 ? 2 : 4;
            if($request->user()->role_id==3){
                $proposal->process_hod_id    = $request->user()->id;
            }else{
                $proposal->process_cgm_id    = $request->user()->id;
            }
            $proposal->reason_reject = $request->reason_reject;
            $proposal->save();
            if($proposal){
                $desc = "Data berhasil ditolak";
                return redirect()->route('ph.progress')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal ditolak";
                return redirect()->route('review.index')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('review.index')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }

}
