<div class="panel panel-default">
    <div class="panel-body">
        <form method="post" id="personal_info_form">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id"/>
            <h1>Personal Info</h1>

            <label for="exampleInputEmail1">First Name</label>
            <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"
                                                                  aria-hidden="true"></span></span>
                <input type="text" class="form-control" id="fName" name="first_name" placeholder="John"
                       value="{{$profile->first_name}}"
                       aria-describedby="basic-addon1" required>
            </div>

            <label for="exampleInputEmail1">Last Name</label>
            <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"
                                                                  aria-hidden="true"></span></span>
                <input type="text" class="form-control" id="lName" name="last_name" placeholder="Doe"
                       value="{{$profile->last_name}}"
                       aria-describedby="basic-addon1" required>
            </div>


            <label for="exampleInputEmail1">Country</label>
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
                <input type="text" class="form-control" name="zip" placeholder="11111"
                       aria-describedby="basic-addon1" id="zip" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                       value="@if(!empty($address->zip)){{$address->zip}}@endif" required>
            </div>

            <label for="exampleInputEmail1">Phone</label>
            <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-phone "
                                                                  aria-hidden="true"></span></span>
                <input type="text" class="form-control" name="phone" placeholder="5555555555"
                       aria-describedby="basic-addon1" id="phone"
                       value="@if(!empty($phone->phone_number)){{$phone->phone_number}}@endif">
            </div>

            <div class=" input-group" style="width: 100%;">
                <input type="submit" value="Next" class="btn btn-default buttonNext"
                       id="submit_personal_info">
            </div>
        </form>
    </div>
</div>
