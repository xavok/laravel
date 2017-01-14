<div class="get_qualifications">
    <select class="form-control" name="qualification[]">
        <option>Choose one</option>
        @foreach($allQualifications as $qualification)
            <option value="{{$qualification->id}}"
                    @if(!empty($seekerQualification) && $qualification->id == $seekerQualification->qualification_id) selected @endif>{{$qualification->name}}</option>
        @endforeach
    </select>
    <input type="hidden" name="id[]"
           value="@if(!empty($seekerQualification) && !empty($seekerQualification->id)){{$seekerQualification->id}}@endif">
</div>
