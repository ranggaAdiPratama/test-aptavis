<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];

        return view('home', $data);
    }

    public function classment()
    {
        $clubs = DB::table('clubs')->orderBy('name')->get();

        $results = [];

        if (count($clubs) > 0) {
            foreach ($clubs as $club) {
                $ma = DB::table('tallies')->where('club_id', $club->id)->count();

                $me = DB::table('tallies')
                    ->where('club_id', $club->id)
                    ->where('score', 3)
                    ->count();

                $k = DB::table('tallies')
                    ->where('club_id', $club->id)
                    ->where('score', 0)
                    ->count();

                $s = DB::table('tallies')
                    ->where('club_id', $club->id)
                    ->where('score', 1)
                    ->count();

                $gm = DB::table('tallies')
                    ->where('club_id', $club->id)
                    ->where('score', 3)
                    ->sum('goal');

                $gk = DB::table('tallies')
                    ->where('club_id', $club->id)
                    ->where('score', 0)
                    ->sum('goal');

                $point = DB::table('tallies')
                    ->where('club_id', $club->id)
                    ->sum('score');

                $results[] = [
                    'club'  => $club->name,
                    'ma'    => $ma,
                    'me'    => $me,
                    'k'     => $k,
                    's'     => $s,
                    'gm'    => $gm,
                    'gk'    => $gk,
                    'point' => $point,
                ];
            }

            usort($results, fn ($a, $b) => $b['point'] <=> $a['point']);
        }

        $data = [
            'results'   => $results,
            'title' => 'Klasemen'
        ];

        return view('classment', $data);
    }

    public function club()
    {
        $clubs = DB::table('clubs')->orderBy('name')->get();

        $data = [
            'title'     => 'Input Data Klub'
        ];

        return view('club', $data);
    }

    public function scoreMulti()
    {
        $clubs = DB::table('clubs')->orderBy('name')->get();

        $data = [
            'clubs' => $clubs,
            'script'    => 'components.scripts.score',
            'title' => 'Input Data Skor Multi'
        ];

        return view('multiScore', $data);
    }

    public function scoreSingle()
    {
        $clubs = DB::table('clubs')->orderBy('name')->get();

        $data = [
            'clubs' => $clubs,
            'title' => 'Input Data Skor Single'
        ];

        return view('singleScore', $data);
    }
}
