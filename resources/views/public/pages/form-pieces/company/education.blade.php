<div class="get_education_inputs">
    <h1>Education</h1>

    <label for="exampleInputEmail1">Education Level</label>
    <div class="input-group">
        <select class="form-control education_level_id" name="education_level_id[]" >
            @foreach($levels as $level)
                <option value="{{$level->id}}"
                        @if(!empty($seekerEducation) && $level->id == $seekerEducation->education_level_id) selected @endif>{{$level->name}}</option>
            @endforeach
        </select>
    </div>
    <label for="exampleInputEmail1">Major</label>
    <div class="input-group">
        <select class="form-control study_field_id" name="study_field_id[]">
            @foreach($studyFields as $field)
                <option value="{{$field->id}}"
                        @if(!empty($seekerEducation) && $field->id == $seekerEducation->study_field_id) selected @endif>{{$field->name}}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="id[]"
           value="@if(!empty($seekerEducation) && !empty($seekerEducation->id)){{$seekerEducation->id}}@endif">
</div>

