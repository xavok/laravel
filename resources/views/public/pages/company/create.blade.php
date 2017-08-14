@extends('public.layouts.master')

@section('content')
    <div id="seeker_preference">
        <div class="container-fluid">
            <div class="progress">
                <div id="bar" class="progress-bar progress-bar-success"
                     role="progressbar" aria-valuenow="60" aria-valuemin="0"
                     aria-valuemax="100" style="width: 0%;">
                    0%
                </div>
            </div>

            @if($page == 'about')
                @include('public.pages.forms.company.about')
            @elseif($page == 'industry')
                @include('public.pages.forms.industry')
            @elseif($page == 'occupation')
                @include('public.pages.forms.occupation')
            @elseif($page == 'education')
                @include('public.pages.forms.education')
            @elseif($page == 'qualification')
                @include('public.pages.forms.qualification')
            @elseif($page == 'cultural')
                @include('public.pages.forms.cultural')
            @endif
        </div>
    </div>
@endsection

