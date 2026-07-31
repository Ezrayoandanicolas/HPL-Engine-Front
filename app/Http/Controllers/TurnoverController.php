<?php

namespace App\Http\Controllers;

class TurnoverController extends FrontendController
{
    public function getTurnovers()
    {
        $response = $this->apiGet('turnover/history');
        return response()->json($response);
    }

    public function turnOver()
    {
        $response = $this->apiGet('turnover/24h');
        return response()->json($response);
    }
}
