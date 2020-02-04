<?php

namespace App\Exports;

use App\Rol;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OwnerExport implements FromView
{
    public function view(): View
    {
        $roles = Rol::where('name', 'admin')->get();

        $users = collect();
        foreach ($roles as $rol) {
            if (($rol->users()->get())->isNotEmpty()) {
                $users = $rol->users()->get();
            }
        }
        return view('superUser.export.client_list', [
            'users' => $users
        ]);
    }
}
