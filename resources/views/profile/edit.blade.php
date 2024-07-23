@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Profile'))
@section('content_header_title', __('Profile Information'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="container">
        <div class="p-3 mb-3">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="p-4 sm:p-8 bg-{{Auth::user()->mode}} shadow sm:rounded-lg mb-3">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="p-4 sm:p-8 bg-{{Auth::user()->mode}} shadow sm:rounded-lg mb-3">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-12">
                    <div class="p-4 sm:p-8 bg-{{Auth::user()->mode}} shadow sm:rounded-lg mb-3">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>  --}}
            </div>

        </div>
    </div>
@stop