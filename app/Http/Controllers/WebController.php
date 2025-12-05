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
        // Data Artikel untuk Slider (Header)
        // Bisa klik previous/next, ada foto, nama, tanggal, deskripsi
        $articles = [
            [
                'title' => 'Menyelamatkan Terumbu Karang',
                'date' => '2025-01-10',
                'desc' => 'Kegiatan restorasi karang di Bali untuk SDG 14.',
                'image' => 'https://via.placeholder.com/800x400?text=Ocean+Conservation',
                'link' => '#'
            ],
            [
                'title' => 'Infrastruktur Hijau Desa',
                'date' => '2025-02-15',
                'desc' => 'Pembangunan jembatan ramah lingkungan SDG 9.',
                'image' => 'https://via.placeholder.com/800x400?text=Green+Infrastructure',
                'link' => '#'
            ]
        ];
        return view('home', compact('articles'));
    }

    // Donasi secara umum
    public function donateGeneral() {
        return view('pages.donate_general');
    }

    public function storeGeneral(Request $request) {

        // Status random -> apakah donasi berhasil atau tidak
        $status = rand(0, 1) ? 'successful' : 'denied';

        Donation::create([
            'user_id' => Auth::id(),
            'campaign_id' => null, // General
            'amount' => $request->amount,
            'status' => $status
        ]);

        return redirect()->route('result', ['status' => $status]);
    }

    // PICK WHERE YOUR DONATION GOES ---
    public function listCampaigns() {
        $campaigns = Campaign::all();
        return view('pages.campaign_list', compact('campaigns'));
    }

    public function detailCampaign($id) {
        $campaign = Campaign::findOrFail($id);
        
        // TOP DONATER (10 Besar)
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

    // Halaman hasil (abis donasi)
    public function result($status) {
        return view('pages.result', compact('status'));
    }

    // Donasi (Proposal)
    public function createProposal() {
        return view('pages.proposal_create');
    }

    public function storeProposal(Request $request) {

        // Upload proposal
        $fileName = time() . '.' . $request->file('file')->extension();
        $request->file('file')->move(public_path('uploads'), $fileName);

        Proposal::create([
            'user_id' => Auth::id(),
            'activity_name' => $request->activity_name,
            'target_amount' => $request->target_amount,
            'proposal_file' => $fileName
        ]);

        return view('pages.proposal_done'); // Halaman "your proposal is proposed!"
    }

    // Pages di navbar
    public function profile() { 
        return view('pages.profile'); 
    }

    public function settings() { 
        return view('pages.settings'); 
    }

    // Pages di footer
    public function about() { return view('pages.about'); }
}
