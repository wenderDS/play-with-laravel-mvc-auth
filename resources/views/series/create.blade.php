<x-app-layout>
    <form action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-8">
                <label for="name" class="form-label">Name:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    autofocus
                />
            </div>

            <div class="col-2">
                <label for="seasonsQty" class="form-label">N° Seasons:</label>
                <input
                    type="number"
                    id="seasonsQty"
                    name="seasonsQty"
                    class="form-control"
                    value="{{ old('seasonsQty') }}"
                />
            </div>

            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Eps / Season:</label>
                <input
                    type="number"
                    id="episodesPerSeason"
                    name="episodesPerSeason"
                    class="form-control"
                    value="{{ old('episodesPerSeason') }}"
                />
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-app-layout>
