<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email"  value="{{ old('email', @$item->email) }}" required autofocus>
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" value="{{ old('password', @$item->password) }}" required>
</div>

<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" name="first_name" value="{{ old('first_name', @$item->first_name) }}" required>
</div>

<div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', @$item->last_name) }}" required>
</div>

<div class="form-group">
    <label for="should_be_matched">Should Be Matched</label>
    <input type="checkbox" class="form-control" name="should_be_matched" value="{{ old('should_be_matched', @$item->should_be_matched) }}" required>
</div>
