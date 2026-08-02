<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class LoyalitasController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('home');
        $voucher = $this->apiGet('vouchers/available');
        $calendar = $this->buildCalendar();
        return view('loyalitas', array_merge(compact('voucher', 'calendar'), $data));
    }

    protected function buildCalendar(): array
    {
        $now = now();
        $year = (int) $now->format('Y');
        $month = (int) $now->format('n');
        $daysInMonth = (int) $now->format('t');

        $firstDow = (new Carbon($year.'-'.$month.'-01'))->dayOfWeek;
        $prevMonth = (new Carbon($year.'-'.$month.'-01'))->subMonth();
        $daysInPrev = (int) $prevMonth->format('t');
        $today = (int) $now->format('j');

        $cells = [];

        for ($d = $firstDow; $d > 0; $d--) {
            $cells[] = ['n' => $daysInPrev - $d + 1, 'type' => 'lastMonth'];
        }

        for ($d = 1; $d <= $daysInMonth; $d++) {
            $cells[] = ['n' => $d, 'type' => 'toMonth', 'today' => $d === $today];
        }

        $leading = (int) $firstDow;
        $total = $leading + $daysInMonth;
        if ($total % 7 !== 0) {
            $nextDay = 1;
            while ($total % 7 !== 0) {
                $cells[] = ['n' => $nextDay++, 'type' => 'nextMonth'];
                $total++;
            }
        }

        $rows = [];
        foreach (array_chunk($cells, 7) as $chunk) {
            $rows[] = $chunk;
        }

        return [
            'month_name' => $now->format('F'),
            'month_lower' => strtolower($now->format('F')),
            'year' => $now->format('Y'),
            'rows' => $rows,
        ];
    }

    public function claimVoucher($voucherId)
    {
        $response = $this->apiPost('loyalitas/claim-voucher', ['voucher_id' => $voucherId]);
        if ($response['success'] ?? false) {
            return redirect('/loyalitas')->with('info', 'Berhasil diklaim');
        }
        return redirect()->back()->with('info', $response['message'] ?? 'Gagal mengklaim voucher');
    }

    public function tarik()
    {
        $this->apiPost('loyalitas/tarik', ['nominal' => '50000']);
    }
}
