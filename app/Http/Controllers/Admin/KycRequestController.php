<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Services\AlertService;
use App\Services\MailService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KycRequestController extends Controller
{
    function index(): View
    {
        $kycRequests = Kyc::paginate(25);
        return view("admin.kyc.index", compact("kycRequests"));
    }
    function pending(): View
    {
        $kycRequests = Kyc::whereStatus('pending')->paginate(25);
        return view("admin.kyc.pending", compact("kycRequests"));
    }
    function rejected(): View
    {
        $kycRequests = Kyc::whereStatus('rejected')->paginate(25);
        return view("admin.kyc.rejected", compact("kycRequests"));
    }
    function show(Kyc $kyc_request): View
    {
        return view('admin.kyc.show', compact('kyc_request'));
    }
    function download(Kyc $kyc_request): StreamedResponse
    {
        return Storage::disk('local')->download($kyc_request->document_scan_copy);
    }

    function update(Kyc $kyc_request, Request $request): RedirectResponse
    {
        $kyc_request->update([
            'status' => $request->status,
        ]);

        if ($kyc_request->status == 'approved') {
            MailService::send(
                to: $kyc_request->user->email,
                subject: 'KYC Application Has Been Approved',
                body: 'Dear ' . $kyc_request->user->name . ',

                Congratulations! Your KYC verification has been successfully approved.

                You now have full access to your vendor dashboard and can start managing your store without any restrictions.

                If you have any questions, feel free to contact our support team.

                Best regards,
                The Support Team'
            );
        } elseif ($kyc_request->status == 'rejected') {
            MailService::send(
                to: $kyc_request->user->email,
                subject: 'KYC Application Has Been Rejected',
                body: 'Dear ' . $kyc_request->user->name . ',

                Thank you for submitting your KYC application.

                After review, we are unable to approve your request at this time.
                Please make sure that all required documents are clear, valid, and match your account information.

                You can resubmit your KYC request from your dashboard after making the necessary corrections.

                If you have any questions, our support team is here to help.

                Best regards,
                Support Team'
            );
        }



        AlertService::updated();
        return redirect()->route('admin.kyc.index');
    }
}
