<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends BaseAdminController
{
    public function index()
    {
        $resp = $this->adminGet('banners');
        $Banner = $resp['data']['banners'] ?? [];
        $Banner = json_decode(json_encode($Banner));
        return view('backoffice.banner.banner', compact('Banner'));
    }

    public function create()
    {
        return view('Dashboard.Banner.create');
    }

    public function store(Request $request)
    {
        $authParams = $this->getAuthParams();
        $data = $request->except('_token', '_method');

        if ($request->hasFile('img')) {
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
            $this->uploadFileToApi('banners', $multipart);
        } else {
            $this->adminPost('banners', $data);
        }
        return redirect('/Admin/Dashboard/Banner')->with('success', 'Banner has been added!!');
    }

    public function edit(string $id)
    {
        $resp = $this->adminGet("banners/{$id}");
        $Banner = $resp['data']['banner'] ?? null;
        if (!$Banner) abort(404);
        $Banner = (object) $Banner;
        return view('Dashboard.Banner.edit', compact('Banner'));
    }

    public function update(Request $request, string $id)
    {
        $authParams = $this->getAuthParams();
        $data = $authParams;
        if ($request->status !== null) {
            $data['status'] = $request->status;
        }
        if ($request->has('Judul')) {
            $data['Judul'] = $request->Judul;
        } else {
            $data['Judul'] = '';
        }
        if ($request->hasFile('img')) {
            $multipart = [['name' => 'img', 'contents' => fopen($request->file('img')->getPathname(), 'r'), 'filename' => $request->file('img')->getClientOriginalName()]];
            foreach ($data as $k => $v) {
                $multipart[] = ['name' => $k, 'contents' => $v];
            }
            $this->uploadFileToApi("banners/{$id}", $multipart);
        } else {
            $this->adminPost("banners/{$id}", $data);
        }
        return redirect('/Admin/Dashboard/Banner')->with('success', 'Banner has been Updated!!');
    }

    public function destroy(string $id)
    {
        $this->adminDelete("banners/{$id}");
        return redirect('/Admin/Dashboard/Banner')->with('success', 'Banner has been deleted!!');
    }
}
