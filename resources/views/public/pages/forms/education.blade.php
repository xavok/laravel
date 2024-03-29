<div class="panel panel-default">
    <div class="panel-body">
        @include('public.includes.messages')
        <form id="education_form" method="post" action="#">
            {{ csrf_field() }}
            @if($seekerEducations->count())
                @foreach($seekerEducations as $seekerEducation)
                    @include('public.pages.form-pieces.education')
                @endforeach
            @else
                @include('public.pages.form-pieces.education')
            @endif
            <div id="place_to_add_more_education">
            </div>
            <button class="btn btn-default" type="button" id="addEducation" style="margin-top: 10px;">Add more
            </button>
            <div class="input-group" style="width: 100%;">
                <input type="submit" value="Next" class="btn btn-default buttonNext" style="margin-left:10px">
                <a class="btn btn-default buttonNext" href="occupation" style="margin-left:10px">Preview</a>
            </div>
        </form>
    </div>
</div>
