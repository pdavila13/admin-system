<x-admin>
    @section('title')
        {{ __('Dashboard') }}
    @endsection
    <div class="row">
        <x-dashboard />
        <x-latest-petitions />
    </div>
</x-admin>
