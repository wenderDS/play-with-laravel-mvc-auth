<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $seriesRepository)
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Request $request): View
    {
        $series = Series::all();

        $successMessage = session('message.success');

        return view('series.index')
            ->with('series', $series)
            ->with('successMessage', $successMessage)
            ;
    }

    public function create(): View
    {
        return view('series.create');
    }

    public function edit(Series $series)
    {
        return view('series.edit')
            ->with('series', $series)
            ;
    }

    public function store(SeriesFormRequest $request): RedirectResponse
    {
        $series = $this->seriesRepository->add($request);
        $userList = User::all();

        foreach ($userList as $user) {
            $mail = new SeriesCreated(
                $series->name,
                $series->id,
                $request->seasonsQty,
                $request->episodesPerSeason
            );

            Mail::to($user)->send($mail);
        }

        return to_route('series.index')
            ->with('message.success', "Series '{$series->name}' was added with success!")
            ;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $oldName = $series->name;
        $newName = $request->post('name');

        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('message.success', "Series '{$oldName}' was modified to '{$newName}' with success!")
            ;
    }

    public function destroy(Series $series): RedirectResponse
    {
        $series->delete();

        return to_route('series.index')
            ->with('message.success', "Series '{$series->name}' was removed with success!")
            ;
    }
}
