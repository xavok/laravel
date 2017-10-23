<div class="panel panel-default">
    <div class="panel-body">
        <form method="post" id="job_info">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id"/>
            <h1>Job Info</h1>

            <label for="name">Name</label>
            <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"
                                                                  aria-hidden="true"></span></span>
                <input type="text" class="form-control" id="name" name="name" placeholder="Web Developer"
                       value="@if(!empty($profile->name)){{$profile->name}}@endif"
                       aria-describedby="basic-addon1" required>
            </div>

            <label for="description">Description</label>
            <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true">
                                </span>
                            </span>
                <textarea class="form-control" id="description" name="description" placeholder="Description"
                          value="@if(!empty($profile->description)){{$profile->description}}@endif"
                          aria-describedby="basic-addon1" required></textarea>
            </div>

            <label for="country_id">Country</label>
            <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker "
                                                                  aria-hidden="true"></span></span>
                <select class="chosen-select form-control" name="country_id" id="city">
                    @foreach($countries as $country)
                        <option value="{{$country->id}}"
                                @if( !empty($address) && $country->id == $address->country_id) selected @endif >{{$country->full_name}}</option>
                    @endforeach
                </select>
            </div>

            <label for="zip">Zip</label>
            <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon  glyphicon-map-marker "
                                                                  aria-hidden="true"></span></span>
                <input type="text" class="form-control" name="zip" placeholder="11111" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                       aria-describedby="basic-addon1" id="zip"
                       value="@if(!empty($address->zip)){{$address->zip}}@endif" required>
            </div>
            <br>
            <div class="input-group">
                <input type="checkbox" name="should_be_matched"
                       aria-describedby="basic-addon1" id="should_be_matched"
                       value="@if(!empty($profile->should_be_matched)){{$profile->should_be_matched}}@endif">Start Matching Immediately
            </div>

            <div class=" input-group" style="width: 100%;">
                <input type="submit" value="Next" class="btn btn-default buttonNext"
                       id="submit_personal_info">
            </div>
        </form>
    </div>
</div>
