@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Employee's Report</h1>
            <div class="input-group">
                <input type="search" placeholder="Search Data ... ">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </section>

        <section class="table_body">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Item Tag</th>
                        <th>Report Date</th>
                        <th>Description</th>
                        <th>Dokumentasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td class="col-nama">
                        <img src="{{asset('style/assets/user.png')}}"/> {{$report->nama_pegawai}}
                    </td>
                    <td>{{$report->nomor_aset}}</td>
                    <td>{{$report->tanggal_pengajuan}}</td>
                    <td class="col-nama">
                        {{$report->deskripsi_kerusakan}}
                    </td>
                    <td>
                        @if ($report->foto)
                            <a href="{{Storage::url($report->foto)}}" target="_blank">
                                <img src="{{Storage::url($report->foto)}}" width="100" >
                            </a>
                        @endif
                    </td>
                    <td>
                        <button class="icon" onclick="approve('{{ $report->id }}')">
                                <i class="fa fa-check "></i>
                        </button>
                        <button class="icon" onclick="reject('{{ $report->id }}')">
                                <i class="fa fa-times "></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
        <form id="rejectForm" method="POST" action="{{route('report.rejected')}}" style="display: none;">
            @csrf
            <input type="hidden" name="report_id" id="report_id" value="">
            <input type="hidden" name="reason_reject" id="reason_reject" value="">
        </form>
        <form id="approveForm" method="POST" action="{{route('report.approved')}}" style="display: none;">
            @csrf
            <input type="hidden" name="report_approve_id" id="report_approve_id" value="">
        </form>
    </main>
    <script>
        function approve(reportId) {
            document.getElementById('report_approve_id').value = reportId;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approveForm').submit();
                }
            })
        }

        function reject(reportId) {
            document.getElementById('report_id').value = reportId;

            // SweetAlert untuk Reject dengan input alasan
            Swal.fire({
                title: 'Are you sure?',
                text: "Please provide a reason for rejection:",
                icon: 'warning',
                input: 'textarea',
                inputPlaceholder: 'Enter your reason here...',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Reject',
                preConfirm: (reason) => {
                    if (!reason) {
                        Swal.showValidationMessage('Reason is required!');
                        return false;
                    }
                    document.getElementById('reason_reject').value = reason;
                    document.getElementById('rejectForm').submit();
                }
            });
        }
    </script>

@endsection
