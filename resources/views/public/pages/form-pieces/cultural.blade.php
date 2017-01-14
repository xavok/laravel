<table class="table table-condensed">
    <tr>
        <th>Description</th>
        <th>1st Choice</th>
        <th>2nd Choice</th>
        <th>3rd Choice</th>
    </tr>
    @foreach($preferences as $preference)
        <tr>
            <td>{{$preference->description}}</td>
            <td>
                <select class="culture" name="{{$preference->slug}}_1_id">
                    @foreach($preference->choices as $choice)
                        <option value="{{$choice->rank}}"
                                @if($choice->rank == 1) selected @endif>{{$choice->description}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="culture" name="{{$preference->slug}}_2_id">
                    @foreach($preference->choices as $choice)
                        <option value="{{$choice->rank}}"
                                @if($choice->rank == 2) selected @endif>{{$choice->description}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="culture" name="{{$preference->slug}}_3_id">
                    @foreach($preference->choices as $choice)
                        <option value="{{$choice->rank}}"
                                @if($choice->rank == 3) selected @endif>{{$choice->description}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    @endforeach
</table>
<input type="hidden" name="id"
       value="@if(!empty($seekerPreferences) && !empty($seekerPreferences->id)){{$seekerPreferences->id}}@endif">