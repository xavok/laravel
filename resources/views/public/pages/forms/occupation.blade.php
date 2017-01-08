<div class="panel panel-default">
    <div class="panel-body">
        <form id="occupation_form" method="post" action="#">
            <div id="get_occupation_inputs">
                {{ csrf_field() }}
                <input type="hidden" name="seeker_occupation_experience_id"
                       id="seeker_occupation_experience_id" value=""/>

                <h1>Occupation</h1>
                <label for="occupation">Occupation Name</label>

                <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span
                            class="glyphicon glyphicon-map-marker "
                            aria-hidden="true"></span></span>
                    <select class="form-control" name="occupation_id"
                            id="occupation">
                        <option>Occupation Name</option>
                    </select>
                </div>
                <label for="occupation_subtype_id">Occupation Type Name</label>

                <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span
                            class="glyphicon glyphicon-map-marker "
                            aria-hidden="true"></span></span>
                    <select class="form-control" name="occupation_subtype_id"
                            id="occupation_subtype_id">
                        <option>Occupation Type Name</option>
                    </select>
                </div>

                <label for="occupation_years">Occupation Years</label>

                <div class="input-group">

                    <span class="input-group-addon"><span
                                class="glyphicon  glyphicon-map-marker "
                                aria-hidden="true"></span></span>
                    <input type="text" class="form-control"
                           name="occupation_years" id="occupation_years"
                           placeholder="Years in this occupation"
                           aria-describedby="basic-addon1">
                </div>
            </div>
            <div id="place_to_add_more_occupation">
            </div>
            <button class="btn btn-default" type="button" id="addOccupation"
                    style="margin-top: 10px;">Add
                more
            </button>
            <div class="input-group" style="width: 100%;">

                <input type="submit" value="Next" name="OCCsubmit"
                       class="btn btn-default buttonNext" style="margin-left:10px">
                <input type="submit" value="Back" name=""
                       class="btn btn-default buttonNext">

            </div>
        </form>
    </div>
</div>