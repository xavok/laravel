<div class="panel panel-default">
    <div class="panel-body">
        <form id="occupation_form" method="post" action="#">
            {{ csrf_field() }}
            @if($seekerOccupations->count())
                @foreach($seekerOccupations as $seekerOccupation)
                    @include('public.pages.form-pieces.occupation')
                @endforeach
            @else
                @include('public.pages.form-pieces.occupation')
            @endif
            <div id="place_to_add_more_occupation">
            </div>
            <button class="btn btn-default" type="button" id="addOccupation"
                    style="margin-top: 10px;">Add more
            </button>
            <div class="input-group" style="width: 100%;">
                <input type="submit" value="Next" name="OCCsubmit"
                       class="btn btn-default buttonNext" style="margin-left:10px">
            </div>
        </form>
    </div>
</div>