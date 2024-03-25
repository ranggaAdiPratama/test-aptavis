<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
    public function show($id)
    {
        $data = DB::table('clubs')->orderBy('name')->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'name'  => 'required|unique:clubs',
                'city'  => 'required'
            ];

            $messages = [
                'name.required' => 'Mohon isi nama klub',
                'name.unique'   => 'Nama sudah terdaftar',
                'city.required' => 'Mohon isi kota klub',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput($request->all);
            }

            DB::transaction(function () use ($request) {
                DB::table('clubs')->insert([
                    'city'          => $request->city,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'name'          => $request->name,
                ]);
            });

            return redirect()
                ->back()
                ->with([
                    'success'   => 'Club berhasil ditambahkan'
                ]);
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                dd($e);
            }

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan teknis']);
        }
    }
}
