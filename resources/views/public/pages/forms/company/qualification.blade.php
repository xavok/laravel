<div class="panel panel-default">
    <div class="panel-body">
        <form id="qualifications_form" method="post" action="#">
            {{ csrf_field() }}
            <h1>Qualifications</h1>
            @if($seekerQualifications->count())
                @foreach($seekerQualifications as $seekerQualification)
                    @include('public.pages.form-pieces.qualification')
                @endforeach
            @else
                @include('public.pages.form-pieces.qualification')
            @endif
            <div class="add_qualifications">
            </div>
            <button class="btn btn-default" type="button" id="addQualification" style="margin-top: 10px;">Add more
            </button>
            <div class="input-group" style="width: 100%;">
                <input type="submit" value="Next" class="btn btn-default buttonNext"
                       style="margin-left:10px">
                <a class="btn btn-default buttonNext" href="education" style="margin-left:10px">Preview</a>
            </div>
        </form>
    </div>
</div>