@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Invoice's Report</h1>
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
                        <th>Nomor Inv</th>
                        <th>Report Date</th>
                        <th>Dokumen</th>
                        <th>Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td class="col-nama">
                        <img src="{{asset('style/assets/user.png')}}"/> {{$invoice->nama_procurement}}
                    </td>
                    <td>{{$invoice->nomor_invoice}}</td>
                    <td>{{$invoice->tanggal_invoice}}</td>
                    <td>
                        @if ($invoice->file)
                            <a href="{{Storage::url($invoice->file)}}" target="_blank" style="text-decoration:none">
                                <p class="status success">Link</p>
                            </a>
                        @endif
                    </td>
                    <td>
                        <button href="#" style="border: none; border-radius:10px; padding: px;" onclick="uploadProof('{{ $invoice->id }}')">
                            <p class="status pending">UPLOAD PEMBAYARAN</p>
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // function upload(invoiceId) {
        //     document.getElementById('invoice_id').value = invoiceId;
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "Upload Bukti Pembayaran",
        //         icon: 'warning',
        //         input: 'file',
        //         inputAttributes: {
        //             // 'accept': 'image/*',
        //             'aria-label': 'Upload your file'
        //         },
        //         inputPlaceholder: 'Enter your reason here...',
        //         showCancelButton: true,
        //         confirmButtonColor: '#d33',
        //         cancelButtonColor: '#3085d6',
        //         confirmButtonText: 'Upload',
        //         preConfirm: (file) => {
        //             if (file) {
        //                 const reader = new FileReader();
        //                 reader.onload = (e) => {
        //                     Swal.fire({
        //                         title: 'Your uploaded file',
        //                         imageUrl: e.target.result,
        //                         imageAlt: 'The uploaded file'
        //                     });
        //                 };
        //                 reader.readAsDataURL(file);
        //             } else {
        //                 Swal.showValidationMessage('Please select a file');
        //             }
        //             document.getElementById('proof').value = file;
        //             document.getElementById('uploadForm').submit();
        //         }
        //     });
        // }

        function uploadProof(invoiceId) {
            Swal.fire({
                title: 'Upload Proof of Payment',
                html: `
                    <input type="file" id="swal-input-proof" class="swal2-input">
                `,
                preConfirm: () => {
                    const proof = document.getElementById('swal-input-proof').files[0];
                    if (!proof) {
                        Swal.showValidationMessage('You need to select a file');
                        return false;
                    }
                    return proof;
                },
                showCancelButton: true,
                confirmButtonText: 'Upload',
            }).then((result) => {
                if (result.isConfirmed) {
                    const proofFile = result.value;
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('invoice_id', invoiceId);
                    formData.append('proof', proofFile);
                    $.ajax({
                        url: "{{ route('payment.save') }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Your file has been uploaded.',
                                icon: 'success'
                            });
                            setTimeout(function () {
                                window.location.replace('{{route("invoice.index")}}');
                            }, 1000);
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        }

    </script>

@endsection
