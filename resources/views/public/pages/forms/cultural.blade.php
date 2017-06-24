<div class="panel panel-default">
    <div class="panel-body">
        <form id="cultural_form" method="post" action="#">
            {{ csrf_field() }}
            <h1>Cultural Preferences</h1>
                @include('public.pages.form-pieces.cultural')
                <input type="submit" value="Next" class="btn btn-default buttonNext"
                       style="margin-left:10px">
            <a class="btn btn-default buttonNext" href="qualification" style="margin-left:10px">Preview</a>
        </form>
    </div>
</div>