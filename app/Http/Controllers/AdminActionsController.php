<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AdminActionsController extends Controller
{
    public function delete($table, $id)
    {
        DB::table($table)
            ->where('id', $id)
            ->update(['status' => 2]);


        return redirect()->back()
            ->with('success', 'Kayıt silindi.');
    }

    public function setActiveState($table, $id)
    {
        $item = DB::table($table)
            ->where('id', $id)
            ->first();

        if ($item) {
            $newState = 0;
            if ($item->status == 0) {
                $newState = 1;
            }

            DB::table($table)
                ->where('id', $id)
                ->update(['status' => $newState]);
        }

        return redirect()->back()->with('success', 'Kayıt durumu başarıyla değişti.');
    }
}