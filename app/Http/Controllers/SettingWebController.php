<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingWebController extends BaseAdminController
{
    public function index()
    {
        $setting = [];
        $resp = $this->adminGet('settings');
        if ($resp['success'] ?? false) {
            $setting = $resp['data']['setting'] ?? [];
        }
        return view('backoffice.setting.setting', compact('setting'));
    }

    public function store(Request $request)
    {
        $authParams = $this->getAuthParams();
        $data = array_merge($request->except('_token', '_method'), $authParams);

        if ($request->hasFile('icon') || $request->hasFile('logo')) {
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
            $resp = $this->uploadFileToApi('settings', $multipart);
        } else {
            $resp = $this->adminPost('settings', $data);
        }

        if (!($resp['success'] ?? false)) {
            $errors = $resp['errors'] ?? [];
            if (!empty($errors) && is_array($errors)) {
                $fieldNames = implode(', ', array_keys($errors));
                $msg = "Field wajib diisi: {$fieldNames}";
            } else {
                $msg = $resp['message'] ?? 'Gagal menyimpan setting';
                if (is_array($msg)) $msg = json_encode($msg);
            }
            return redirect('/Setting')->with('error', $msg);
        }
        return redirect('/Setting')->with('success', 'Setting Web Berhasil Dibuat!');
    }
}
