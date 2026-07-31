<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPromotionController extends BaseAdminController
{
    public function index()
    {
        $resp = $this->adminGet('promotions');
        $promotions = $resp['data']['promotions'] ?? [];
        $promotions = json_decode(json_encode($promotions));
        return view('backoffice.promosi.promosi', compact('promotions'));
    }

    public function create()
    {
        return view('Dashboard.Promotion.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');

        if ($request->hasFile('img')) {
            $authParams = $this->getAuthParams();
            $multipart = [];
            foreach ($data as $key => $value) {
                if ($request->hasFile($key)) {
                    $multipart[] = [
                        'name' => $key,
                        'contents' => fopen($request->file($key)->getPathname(), 'r'),
                        'filename' => $request->file($key)->getClientOriginalName(),
                    ];
                } else {
                    $multipart[] = ['name' => $key, 'contents' => $value];
                }
            }
            foreach ($authParams as $key => $value) {
                $multipart[] = ['name' => $key, 'contents' => $value];
            }
            $this->uploadFileToApi('promotions', $multipart);
        } else {
            $this->adminPost('promotions', $data);
        }

        return redirect('/Admin/Dashboard/Promotion')->with('success', 'Promotion has been added!!');
    }

    public function show($id)
    {
        $resp = $this->adminGet("promotions/{$id}");
        $promotion = $resp['data']['promotion'] ?? null;
        if (!$promotion) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return response()->json(['promotion' => $promotion]);
    }

    public function edit($id)
    {
        $resp = $this->adminGet("promotions/{$id}");
        $promotion = $resp['data']['promotion'] ?? null;
        if (!$promotion) abort(404);
        $promotion = (object) $promotion;
        return view('Dashboard.Promotion.edit', ['Promotion' => $promotion]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');

        if ($request->hasFile('img')) {
            $authParams = $this->getAuthParams();
            $multipart = [];
            foreach ($data as $key => $value) {
                if ($request->hasFile($key)) {
                    $multipart[] = [
                        'name' => $key,
                        'contents' => fopen($request->file($key)->getPathname(), 'r'),
                        'filename' => $request->file($key)->getClientOriginalName(),
                    ];
                } else {
                    $multipart[] = ['name' => $key, 'contents' => $value];
                }
            }
            foreach ($authParams as $key => $value) {
                $multipart[] = ['name' => $key, 'contents' => $value];
            }
            $this->uploadFileToApi("promotions/{$id}", $multipart);
        } else {
            $this->adminPost("promotions/{$id}", $data);
        }

        return redirect('/Admin/Dashboard/Promotion')->with('success', 'Promotion has been Updated!!');
    }

    public function destroy($id)
    {
        $this->adminDelete("promotions/{$id}");
        return redirect('/Admin/Dashboard/Promotion')->with('success', 'Deleted!');
    }

    public function getPromotions()
    {
        $resp = $this->adminGet('promotions');
        return response()->json(['promotions' => $resp['data']['promotions'] ?? []]);
    }
}
