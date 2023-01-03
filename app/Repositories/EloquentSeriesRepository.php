<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request): Series
    {
        return DB::transaction(function () use ($request, &$series) {
            $series = Series::create($request->all());
            $seasonsArray = [];

            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasonsArray[] = [
                    'series_id' => $series->id,
                    'number' => $i
                ];
            }

            Season::insert($seasonsArray);

            $seasons = $series->seasons;
            $episodesArray = [];

            foreach ($seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episodesArray[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }

            Episode::insert($episodesArray);

            return $series;
        });
    }
}
