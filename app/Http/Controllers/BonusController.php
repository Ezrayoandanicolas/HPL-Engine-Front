<?php

namespace App\Http\Controllers;

class BonusController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('home');
        $resp = $this->apiGet('promotions');
        $list = $resp['data']['promotions'] ?? [];
        $promotion = array_map(function ($p) {
            return (object) [
                'id' => $p['id'],
                'title' => $p['title'],
                'bonus_title' => $p['bonus'],
                'min_deposite' => $p['min_deposite'],
                'max_deposite' => $p['max_deposite'],
                'tanggal_akhir' => $p['tanggal_akhir'],
                'body' => $p['body'],
                'img' => $p['img'],
                'bonus' => $p['bonus'],
                'status' => $p['status'] ?? null,
            ];
        }, $list);
        $claimedPromotionIds = $this->apiGet('bonus/claimed-ids');
        return view('bonus', array_merge(compact('promotion', 'claimedPromotionIds'), $data));
    }

    public function update($id)
    {
        $response = $this->apiPost('bonus/claim', ['promo_id' => $id]);
        if ($response['success'] ?? false) {
            return back()->with('success', 'Klaim Bonus Berhasil!');
        }
        return back()->with('info', $response['message'] ?? 'Gagal mengklaim bonus. Silakan coba lagi.');
    }

    public function historyKlaim()
    {
        $data = $this->fetchPage('home');
        return view('history_klaim', $data);
    }

    public function historyKlaims()
    {
        $response = $this->apiGet('bonus/history-klaims');
        return response()->json($response);
    }
}
