<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardNavigationMenuController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('navigation-menus', [
            'search' => $request->input('search'),
            'category' => $request->input('category'),
        ]);
        $menus = $resp['data'] ?? [];

        $resp2 = $this->adminGet('navigation-menu-categories');
        $categories = $resp2['data'] ?? [];

        return view('backoffice.navigation-menu.index', compact('menus', 'categories'));
    }

    public function store(Request $request)
    {
        $this->adminPost('navigation-menus', $request->all());
        return redirect('/Admin/Dashboard/Navigation-Menu')->with('success', 'Menu added!');
    }

    public function update(Request $request, $id)
    {
        $this->adminPost("navigation-menus/{$id}", $request->all());
        return redirect('/Admin/Dashboard/Navigation-Menu')->with('success', 'Menu updated!');
    }

    public function destroy($id)
    {
        $this->adminDelete("navigation-menus/{$id}");
        return redirect('/Admin/Dashboard/Navigation-Menu')->with('success', 'Menu deleted!');
    }

    public function syncGGR()
    {
        $resp = $this->adminPost('sync-ggr-providers');
        return response()->json($resp);
    }

    public function syncGames()
    {
        $resp = $this->adminPost('sync-all-ggr-games');
        return response()->json($resp);
    }
}
