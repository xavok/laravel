<div class="get_industry_inputs">
    <h1>Industry</h1>
    <label for="industry_id">Industry Name</label>
    <div class="input-group industries">
                <span class="input-group-addon" id="basic-addon1"><span
                            class="glyphicon glyphicon-map-marker "
                            aria-hidden="true"></span></span>
        <select class="form-control" name="industry_id[]">
            <option>Industry Name</option>
            @foreach($industries as $industry)
                <option value="{{$industry->id}}"
                        @if(!empty($seekerIndustry) && $industry->id == $seekerIndustry->industry_id) selected @endif>{{$industry->industry_name}}</option>
            @endforeach
        </select>
    </div>
    <label for="industry_years">Industry Years</label>
    <div class="input-group">
                    <span class="input-group-addon"><span
                                class="glyphicon  glyphicon-map-marker "
                                aria-hidden="true"></span></span>
        <input type="text" class="form-control"
               name="industry_years[]"
               placeholder="Years in this industry"
               value="@if(!empty($seekerIndustry) && !empty($seekerIndustry->years)){{$seekerIndustry->years}}@endif"
               aria-describedby="basic-addon1">
    </div>
    <input type="hidden" name="id[]"
           value="@if(!empty($seekerIndustry) && !empty($seekerIndustry->id)){{$seekerIndustry->id}}@endif">
</div>