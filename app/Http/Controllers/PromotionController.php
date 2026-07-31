<?php

namespace App\Http\Controllers;

class PromotionController extends FrontendController
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
            ];
        }, $list);
        return view('promotion', array_merge(compact('promotion'), $data));
    }
}
