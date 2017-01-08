<div class="panel panel-default">
    <div class="panel-body">
        @include('public.includes.messages')
        <form id="industry_form" method="post" action="#">
            <div id="get_industry_inputs">
                {{ csrf_field() }}
                @if($seekerIndustries->count())
                    @foreach($seekerIndustries as $seekerIndustry)
                        @include('public.pages.form-pieces.industry')
                    @endforeach
                @else
                    @include('public.pages.form-pieces.industry')
                @endif
            </div>
            <div id="place_to_add_more_industry">
            </div>
            <button class="btn btn-default" type="button" id="addIndustry"
                    style="margin-top: 10px;">Add more
            </button>
            <div class="input-group" style="width: 100%;">
                <input type="submit" value="Next" name="INsubmit"
                       class="btn btn-default buttonNext" style="margin-left:10px">
            </div>
        </form>
    </div>
</div>
