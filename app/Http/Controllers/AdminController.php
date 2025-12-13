<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Proposal;
use App\Models\ApprovalLog;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    // Dashboard
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('is_admin', false)->count(),
            'pending_kyc' => User::where('kyc_status', 'pending')->count(),
            'pending_proposals' => Proposal::where('status', 'pending')->count(),
            'approved_users' => User::where('kyc_status', 'approved')->count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    // Users List
    public function users(Request $request)
    {
        $query = User::where('is_admin', false);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('kyc_status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.users', compact('users'));
    }

    // User Detail (for expansion)
    public function userDetail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.partials.user_detail', compact('user'));
    }

    // Campaigns List (approved proposals become campaigns)
    public function campaigns(Request $request)
    {
        $query = Campaign::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('community_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $campaigns = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.campaigns', compact('campaigns'));
    }

    // Campaign Detail with Donors
    public function campaignDetail($id)
    {
        $campaign = Campaign::findOrFail($id);
        $donations = \App\Models\Donation::where('campaign_id', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $stats = [
            'total_donors' => $donations->count(),
            'total_collected' => $donations->where('status', 'successful')->sum('amount'),
            'successful' => $donations->where('status', 'successful')->count(),
            'denied' => $donations->where('status', 'denied')->count(),
        ];
        
        return view('admin.campaign_detail', compact('campaign', 'donations', 'stats'));
    }

    // Approval Requests
    public function approvalRequests()
    {
        $pendingUsers = User::where('kyc_status', 'pending')->get();
        $pendingProposals = Proposal::with('user')->where('status', 'pending')->get();
        
        return view('admin.approvals', compact('pendingUsers', 'pendingProposals'));
    }

    // Approve User KYC
    public function approveUser(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $user = User::findOrFail($id);
        $user->kyc_status = 'approved';
        $user->kyc_verified_at = now();
        $user->kyc_rejection_reason = null;
        $user->save();

        ApprovalLog::create([
            'admin_id' => Auth::id(),
            'action' => 'approved',
            'target_type' => 'user',
            'target_id' => $id,
            'reason' => $request->reason,
            'feedback' => null,
        ]);

        return redirect()->back()->with('success', 'User KYC berhasil disetujui!');
    }

    // Reject User KYC
    public function rejectUser(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
            'feedback' => 'required|string|max:500',
        ]);

        $user = User::findOrFail($id);
        $user->kyc_status = 'rejected';
        $user->kyc_rejection_reason = $request->feedback;
        $user->save();

        ApprovalLog::create([
            'admin_id' => Auth::id(),
            'action' => 'rejected',
            'target_type' => 'user',
            'target_id' => $id,
            'reason' => $request->reason,
            'feedback' => $request->feedback,
        ]);

        return redirect()->back()->with('success', 'User KYC telah ditolak.');
    }

    // Approve Proposal → Create Campaign
    public function approveCampaign(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'approved';
        $proposal->rejection_reason = null;
        $proposal->save();

        // Create Campaign from approved Proposal
        Campaign::create([
            'title' => $proposal->activity_name,
            'community_name' => $proposal->pic_name,
            'description' => 'Campaign untuk ' . $proposal->activity_name . ' di ' . $proposal->activity_address,
            'target' => $proposal->target_amount,
            'collected' => 0,
            'date' => $proposal->activity_date,
            'status' => 'approved',
        ]);

        ApprovalLog::create([
            'admin_id' => Auth::id(),
            'action' => 'approved',
            'target_type' => 'proposal',
            'target_id' => $id,
            'reason' => $request->reason,
            'feedback' => null,
        ]);

        return redirect()->back()->with('success', 'Proposal disetujui dan Campaign berhasil dibuat!');
    }

    // Reject Proposal
    public function rejectCampaign(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
            'feedback' => 'required|string|max:500',
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'rejected';
        $proposal->rejection_reason = $request->feedback;
        $proposal->save();

        ApprovalLog::create([
            'admin_id' => Auth::id(),
            'action' => 'rejected',
            'target_type' => 'proposal',
            'target_id' => $id,
            'reason' => $request->reason,
            'feedback' => $request->feedback,
        ]);

        return redirect()->back()->with('success', 'Proposal telah ditolak.');
    }

    // Approval History
    public function approvalHistory(Request $request)
    {
        $query = ApprovalLog::with('admin')->orderBy('created_at', 'desc');

        if ($request->filled('type')) {
            $query->where('target_type', $request->type);
        }

        $logs = $query->paginate(30);
        
        return view('admin.history', compact('logs'));
    }
}
