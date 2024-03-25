<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ScoreController extends Controller
{
    public function store(Request $request)
    {
        try {
            if ($request->mode == 'single') {
                $rules = [
                    'club_1'  => 'required|different:club_2',
                    'club_2'  => 'required|different:club_1'
                ];

                $messages = [
                    'club_1.required'   => 'Mohon pilih klub',
                    'club_1.different'  => 'Klub tidak boleh sama',
                    'club_2.required'   => 'Mohon pilih klub',
                    'club_2.different'  => 'Klub tidak boleh sama',
                ];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput($request->all);
                }

                $check = DB::table('scores')
                    ->where('club_1', $request->club_1)
                    ->where('club_2', $request->club_2)
                    ->first();

                if ($check) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            'error' => 'data sudah terdaftar'
                        ])
                        ->withInput($request->all);
                }

                $check = DB::table('scores')
                    ->where('club_1', $request->club_2)
                    ->where('club_2', $request->club_1)
                    ->first();

                if ($check) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            'error' => 'data sudah terdaftar'
                        ])
                        ->withInput($request->all);
                }

                DB::transaction(function () use ($request) {
                    $club_1     = $request->club_1;
                    $club_2     = $request->club_2;
                    $win_score  = $request->score_1;
                    $lose_score = $request->score_2;

                    if ($request->score_2 > $request->score_1) {
                        $club_1     = $request->club_2;
                        $club_2     = $request->club_1;
                        $win_score  = $request->score_2;
                        $lose_score = $request->score_1;
                    }

                    DB::table('scores')->insert([
                        'club_1'        => $club_1,
                        'club_2'        => $club_2,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'lose_score'    => $lose_score,
                        'win_score'     => $win_score,
                    ]);

                    if ($win_score == $lose_score) {
                        DB::table('tallies')->insert([
                            'club_id'       => $club_1,
                            'score'         => 1,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'goal'          => $win_score,
                        ]);

                        DB::table('tallies')->insert([
                            'club_id'       => $club_2,
                            'score'         => 1,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'goal'          => $win_score,
                        ]);
                    } else {
                        DB::table('tallies')->insert([
                            'club_id'       => $club_1,
                            'score'         => 3,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'goal'          => $win_score,
                        ]);

                        DB::table('tallies')->insert([
                            'club_id'       => $club_2,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'goal'          => $lose_score,
                        ]);
                    }
                });

                return redirect()
                    ->back()
                    ->with([
                        'success'   => 'Score berhasil ditambahkan'
                    ]);
            }

            if ($request->club_1 == null) {
                $json = [
                    'status'    => false,
                    'msg'       => 'Mohon pilih klub'
                ];
            } elseif ($request->club_2 == null) {
                $json = [
                    'status'    => false,
                    'msg'       => 'Mohon pilih klub'
                ];
            } elseif (count($request->club_1) !== count($request->club_2)) {
                $json = [
                    'status'    => false,
                    'msg'       => 'Mohon pilih klub'
                ];
            } else {
                for ($i = 0; $i < count($request->club_1); $i++) {
                    if ($request->club_1[$i] == $request->club_2[$i]) {
                        $json = [
                            'status'    => false,
                            'msg'       => 'Klub tidak boleh sama'
                        ];

                        return response()->json($json);
                    }

                    $check = DB::table('scores')
                        ->where('club_1', $request->club_1[$i])
                        ->where('club_2', $request->club_2[$i])
                        ->first();

                    if ($check) {
                        $json = [
                            'status'    => false,
                            'msg'       => 'data sudah terdaftar'
                        ];

                        return response()->json($json);
                    }

                    $check = DB::table('scores')
                        ->where('club_1', $request->club_2[$i])
                        ->where('club_2', $request->club_1[$i])
                        ->first();

                    if ($check) {
                        $json = [
                            'status'    => false,
                            'msg'       => 'data sudah terdaftar'
                        ];

                        return response()->json($json);
                    }

                    $count = 0;

                    for ($j = 0; $j < count($request->club_1); $j++) {
                        if ($request->club_1[$i] == $request->club_1[$j] && $request->club_2[$i] == $request->club_2[$j]) {
                            $count = $count + 1;
                        } elseif ($request->club_2[$i] == $request->club_1[$j] && $request->club_1[$i] == $request->club_2[$j]) {
                            $count = $count + 1;
                        }
                    }

                    if ($count > 1) {
                        $json = [
                            'status'    => false,
                            'msg'       => 'data tidak boleh sama'
                        ];

                        return response()->json($json);
                    }
                }

                for ($i = 0; $i < count($request->club_1); $i++) {
                    DB::transaction(function () use ($request, $i) {
                        $club_1     = $request->club_1[$i];
                        $club_2     = $request->club_2[$i];
                        $win_score  = $request->score_1[$i];
                        $lose_score = $request->score_2[$i];

                        if ($request->score_2[$i] > $request->score_1[$i]) {
                            $club_1     = $request->club_2[$i];
                            $club_2     = $request->club_1[$i];
                            $win_score  = $request->score_2[$i];
                            $lose_score = $request->score_1[$i];
                        }

                        DB::table('scores')->insert([
                            'club_1'        => $club_1,
                            'club_2'        => $club_2,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'lose_score'    => $lose_score,
                            'win_score'     => $win_score,
                        ]);

                        if ($win_score == $lose_score) {
                            DB::table('tallies')->insert([
                                'club_id'       => $club_1,
                                'score'         => 1,
                                'created_at'    => date('Y-m-d H:i:s'),
                                'goal'          => $win_score,
                            ]);

                            DB::table('tallies')->insert([
                                'club_id'       => $club_2,
                                'score'         => 1,
                                'created_at'    => date('Y-m-d H:i:s'),
                                'goal'          => $win_score,
                            ]);
                        } else {
                            DB::table('tallies')->insert([
                                'club_id'       => $club_1,
                                'score'         => 3,
                                'created_at'    => date('Y-m-d H:i:s'),
                                'goal'          => $win_score,
                            ]);

                            DB::table('tallies')->insert([
                                'club_id'       => $club_2,
                                'created_at'    => date('Y-m-d H:i:s'),
                                'goal'          => $lose_score,
                            ]);
                        }
                    });
                }

                $json = [
                    'status'    => true,
                    'msg'       => 'data berhasil disimpan'
                ];
            }

            return response()->json($json);
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                dd($e);
            }

            if ($request->mode == 'single') {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['error' => 'Terjadi kesalahan teknis']);
            }
        }
    }
}
