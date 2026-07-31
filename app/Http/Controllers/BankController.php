<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankController extends BaseAdminController
{
    public function index()
    {
        $resp = $this->adminGet('banks');
        $bank = $resp['data']['banks'] ?? [];
        $bank = json_decode(json_encode($bank));
        return view('backoffice.deposit_bank.deposit_bank', compact('bank'));
    }

    public function create()
    {
        return view('Dashboard.DANA.create');
    }

    public function store(Request $request)
    {
        $authParams = $this->getAuthParams();
        $data = $request->except('_token', '_method');

        if ($request->hasFile('image_qr')) {
            $multipart = [];
            foreach ($request->except('_token', '_method') as $key => $value) {
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
            $this->uploadFileToApi('banks', $multipart);
        } else {
            $this->adminPost('banks', $data);
        }
        return redirect('/Admin/Dashboard/Manage-Bank')->with('success', 'Bank has been added!!');
    }

    public function update(Request $request, string $id)
    {
        $authParams = $this->getAuthParams();
        $data = [];
        if ($request->status !== null) {
            $data['status'] = $request->status;
        }
        if ($request->has('nama_bank')) {
            $data['nama_bank'] = $request->nama_bank;
            $data['nama_penerima'] = $request->nama_penerima;
            $data['no_rek'] = $request->no_rek;
        }
        if ($request->hasFile('image_qr')) {
            $multipart = [
                ['name' => 'image_qr', 'contents' => fopen($request->file('image_qr')->getPathname(), 'r'), 'filename' => $request->file('image_qr')->getClientOriginalName()]
            ];
            foreach ($authParams as $k => $v) {
                $multipart[] = ['name' => $k, 'contents' => $v];
            }
            foreach ($data as $k => $v) {
                $multipart[] = ['name' => $k, 'contents' => $v];
            }
            $this->uploadFileToApi("banks/{$id}", $multipart);
        } else {
            $data = array_merge($data, $authParams);
            $this->adminPost("banks/{$id}", $data);
        }
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }
}
