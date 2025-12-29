<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    // --- HOME (HEADER & SLIDER) ---
    public function index() {
        $articles = [
            [
                'title' => 'Bantu Pendidikan Anak Pedalaman Papua',
                'date' => '2025-01-15',
                'description' => 'Kami mengumpulkan dana untuk membangun perpustakaan dan menyediakan buku pelajaran bagi 500 anak di daerah pedalaman Papua. Mari bersama wujudkan pendidikan merata!',
                'img' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=800&h=400&fit=crop',
                'link' => '#'
            ],
            [
                'title' => 'Rumah Harapan untuk Korban Bencana',
                'date' => '2025-02-20',
                'description' => 'Program pembangunan rumah layak huni bagi 50 keluarga korban gempa. Setiap donasi Anda adalah harapan baru bagi mereka yang kehilangan tempat tinggal.',
                'img' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=800&h=400&fit=crop',
                'link' => '#'
            ],
            [
                'title' => 'Pangan Bergizi untuk Balita Kurang Gizi',
                'date' => '2025-03-10',
                'description' => 'Kampanye penyediaan makanan bergizi untuk 1000 balita di daerah terpencil. Nutrisi yang baik adalah hak setiap anak untuk tumbuh sehat dan cerdas.',
                'img' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800&h=400&fit=crop',
                'link' => '#'
            ]
        ];
        return view('home', compact('articles'));
    }

    public function donateGeneral() {
        return view('pages.donate_general');
    }

    public function storeGeneral(Request $request) {

        $status = rand(0, 1) ? 'successful' : 'denied';

        Donation::create([
            'user_id' => Auth::id(),
            'campaign_id' => null, // General
            'amount' => $request->amount,
            'status' => $status
        ]);

        return redirect()->route('result', ['status' => $status]);
    }

    public function listCampaigns() {
        $campaigns = Campaign::all();
        return view('pages.campaign_list', compact('campaigns'));
    }

    public function detailCampaign($id) {
        $campaign = Campaign::findOrFail($id);
        
        $topDonaters = Donation::where('campaign_id', $id)
                        ->where('status', 'successful')
                        ->orderBy('amount', 'desc')
                        ->take(10)
                        ->with('user')
                        ->get();

        return view('pages.campaign_detail', compact('campaign', 'topDonaters'));
    }

    public function payCampaign($id) {
        $campaign = Campaign::findOrFail($id);
        return view('pages.campaign_pay', compact('campaign'));
    }

    public function storeCampaign(Request $request, $id) {
        $status = rand(0, 1) ? 'successful' : 'denied';

        Donation::create([
            'user_id' => Auth::id(),
            'campaign_id' => $id,
            'amount' => $request->amount,
            'status' => $status
        ]);

        return redirect()->route('result', ['status' => $status]);
    }

    public function result($status) {
        return view('pages.result', compact('status'));
    }

    public function createProposal() {
        return view('pages.proposal_create');
    }

    public function storeProposal(Request $request) {

        $fileName = time() . '.' . $request->file('file')->extension();
        $request->file('file')->move(public_path('uploads'), $fileName);

        // Handle thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Proposal::create([
            'user_id' => Auth::id(),
            'activity_name' => $request->activity_name,
            'activity_date' => $request->activity_date,
            'activity_address' => $request->activity_address,
            'target_amount' => $request->target_amount,
            'pic_name' => $request->pic_name,
            'pic_city' => $request->pic_city,
            'pic_zip' => $request->pic_zip,
            'pic_birth_place' => '-',
            'pic_birth_date' => '2000-01-01',
            'pic_address' => '-', 
            'pic_province' => '-',
            'pic_country' => '-',
            'pic_gender' => '-', 
            'proposal_file' => $fileName,
            'thumbnail' => $thumbnailPath,
            'status' => 'pending',
        ]);

        return view('pages.proposal_done');
    }

    public function profile() { 
        return view('pages.profile'); 
    }

    public function settings() { 
        return view('pages.settings'); 
    }

    // Pages di footer
    public function about() { return view('pages.about'); }

    // My Campaigns for verified users
    public function myCampaigns() {
        $user = Auth::user();
        
        // Check if user is verified
        if (!$user->isKycVerified()) {
            return redirect()->route('profile.edit')->with('error', 'Anda harus terverifikasi untuk melihat campaign.');
        }
        
        // Get user's proposals
        $proposals = Proposal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get campaigns created from user's approved proposals
        $campaignTitles = $proposals->where('status', 'approved')
            ->pluck('activity_name')
            ->toArray();
        
        $campaigns = Campaign::whereIn('title', $campaignTitles)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pages.my_campaigns', compact('proposals', 'campaigns'));
    }
}
