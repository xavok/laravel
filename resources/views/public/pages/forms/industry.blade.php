<div class="panel panel-default">
    <div class="panel-body">
        @include('public.includes.messages')
        <form id="industry_form" method="post" action="#">
            {{ csrf_field() }}
            @if($seekerIndustries->count())
                @foreach($seekerIndustries as $seekerIndustry)
                    @include('public.pages.form-pieces.industry')
                @endforeach
            @else
                @include('public.pages.form-pieces.industry')
            @endif
            <div id="place_to_add_more_industry">
            </div>
            <button class="btn btn-default" type="button" id="addIndustry"
                    style="margin-top: 10px;">Add more
            </button>
            <div class="input-group" style="width: 100%;">
                <input type="submit" value="Next" name="INsubmit"
                       class="btn btn-default buttonNext" style="margin-left:10px">
                <a class="btn btn-default buttonNext" href="about-you" style="margin-left:10px">Preview</a>
            </div>
        </form>
    </div>
</div>
