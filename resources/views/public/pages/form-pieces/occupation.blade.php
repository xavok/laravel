<h1>Occupation</h1>
<label for="occupation">Occupation Name</label>

<div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span
                            class="glyphicon glyphicon-map-marker "
                            aria-hidden="true"></span></span>
    <select class="form-control" name="occupation_id"
            id="occupation">
        <option>Occupation Name</option>
        @foreach($occupations as $occupation)
            <option value="{{$occupation->id}}">{{$occupation->occupation_name}}</option>
            @endforeach
    </select>
</div>
<label for="occupation_subtype_id">Occupation Type Name</label>

<div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span
                            class="glyphicon glyphicon-map-marker "
                            aria-hidden="true"></span></span>
    <select class="form-control" name="occupation_subtype_id"
            id="occupation_subtype_id" disabled>
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
<input type="hidden" name="id[]" value="@if(!empty($seekerOccupation) && !empty($seekerOccupation->id)){{$seekerOccupation->id}}@endif">
