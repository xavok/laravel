<div class="get_occupation_inputs">

    <h1>Occupation</h1>

    <label for="occupation">Occupation Name</label>
    <div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
    </span>
        <select class="form-control occupation" name="occupation[]">
            <option>Occupation Name</option>
            @foreach($occupations as $occupation)
                <option value="{{$occupation->id}}"
                        @if(!empty($seekerOccupation) && $occupation->id == $seekerOccupation->occupation_id) selected @endif>{{$occupation->occupation_name}}</option>
            @endforeach
        </select>
    </div>

    <label for="type">Occupation Type Name</label>
    <div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
                    <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
    </span>
        <select class="form-control type" name="type[]" @if(empty($seekerOccupation)) disabled @endif>
            <option>Occupation Type Name</option>
            @if(!empty($seekerOccupation))
                @foreach($seekerOccupation->getallTypesAttribute($seekerOccupation->occupation_id) as $type)
                    <option value="{{$type->id}}"
                            @if(!empty($seekerOccupation) && $seekerOccupation->occupation_subtype_id == $type->id) selected @endif>{{$type->occupation_subtype_name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <label for="years">Occupation Years</label>
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon  glyphicon-map-marker" aria-hidden="true"></span>
    </span>
        <input type="text" class="form-control" name="years[]" id="occupation_years"
               placeholder="Years in this occupation" aria-describedby="basic-addon1"
               value="@if(!empty($seekerOccupation) && !empty($seekerOccupation->years)){{$seekerOccupation->years}}@endif">
    </div>

    <input type="hidden" name="id[]"
           value="@if(!empty($seekerOccupation) && !empty($seekerOccupation->id)){{$seekerOccupation->id}}@endif">
</div>