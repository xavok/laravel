<div class="get_education_inputs">
    <h1>Education</h1>
    <label for="exampleInputEmail1">School/University</label>

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">
            <span class="glyphicon glyphicon-book " aria-hidden="true"></span>
        </span>
        <input type="text" class="form-control" placeholder="UC Davis" name="school" id="school"
               aria-describedby="basic-addon1">
    </div>
    <label for="exampleInputEmail1">Graduation Date</label>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
        </span>
        <input type="date" class="form-control" placeholder="Graduation Date" name="graduation" id="graduation"
               aria-describedby="basic-addon1">
    </div>
    <label for="exampleInputEmail1">Education Level</label>
    <div class="input-group">
        <select class="form-control" name="education_level_id" id="education_level_id">
        </select>
    </div>
    <label for="exampleInputEmail1">Major</label>
    <div class="input-group">
        <select class="form-control" name="study_field_id" id="study_field_id">
        </select>
    </div>
</div>
<div id="place_to_add_more_education">
</div>
<button class="btn btn-default" type="button" id="addEducation" style="margin-top: 10px;">Add more</button>
<div class=" input-group" style="width: 100%;">
    <input type="submit" value="Next" name="EDsubmit" class="btn btn-default buttonNext" style="margin-left:10px">
    <input type="submit" value="Back" name="OCCsubmit" class="btn btn-default buttonNext">
</div>
