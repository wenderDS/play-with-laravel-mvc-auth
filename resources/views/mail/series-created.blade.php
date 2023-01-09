<x-mail::message>
# {{ $seriesName }} created

The series {{ $seriesName }} with {{ $seriesSeasonsQuantity }} seasons e {{ $episodesPerSeasons }} episodes

Access here:
<x-mail::button :url="route('seasons.index', $seriesID)">
    See More
</x-mail::button>
</x-mail::message>


