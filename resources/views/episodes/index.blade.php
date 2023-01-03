<x-app-layout>
    <x-message-success :success-message="$successMessage"/>

    <a href="{{ route('seasons.index', $season->series->id) }}" class="btn btn-outline-info mb-2">back</a>

    <form method="post">
        @csrf

        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episode {{ $episode->number }}

                    <input
                        type="checkbox"
                        name="episodes[]"
                        value="{{ $episode->id }}"
                        @if($episode->watched)
                            checked
                        @endif
                    />
                </li>
            @endforeach
        </ul>

        <button class="btn btn-primary mt-2 mb-2">
            Save
        </button>
    </form>
</x-app-layout>
