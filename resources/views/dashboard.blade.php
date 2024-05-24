<x-admin>
    @section('title')
        {{ __('Dashboard') }}
    @endsection
    <div class="row">
        <!--<x-dashboard />-->
        <x-external-link />

        @php
            $petitions = App\Models\Petition::where('datepicker', '>=', Illuminate\Support\Facades\DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))
                    ->orderBy('datepicker','desc')
                    ->get();
            $companies = App\Models\Company::all();
            $petitionTypes = App\Models\PetitionType::all();
            $states = App\Models\State::all();
            $users = App\Models\User::all();
        @endphp

        <x-latest-petitions :petitions="$petitions" :companies="$companies" :petitionTypes="$petitionTypes" :users="$users" :states="$states" />
    </div>
</x-admin>
