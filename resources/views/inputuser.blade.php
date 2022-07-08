<html>
<head>
    @include ('style')
    <title>Users</title>
</head>
<body>

<div class="form-content">
    <form action="{{ URL::to('/input') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" name="nip" value="{{ old('nip') }}">
            <div class="ErrorMessage">
                @foreach($errors->get('nip') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            <div class="ErrorMessage">
                @foreach($errors->get('name') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="example@solis.co.id" value="{{ old('email') }}">
            <div class="ErrorMessage">
                @foreach($errors->get('email') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>
        <!--<input type="hidden" name="category" value="Jakarta">-->
        <div class="form-group">
            <label for="logintype">Category</label>
            <select name="logintype" value="{{ old('logintype') }}">
                <option value="" selected disabled>Choose Category</option>
                <option value="nonprofessional">Partner</option>
                <option value="nonprofessional">Admin</option>
                <option value="professionaltax">Tax</option>
                <option value="professionalaudit">Audit</option>
                <option value="professionalaccounting">Accounting</option>
            </select>
            <div class="ErrorMessage">
                @foreach($errors->get('logintype') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="admin">Type</label>
            <select name="admin" value="{{ old('admin') }}">
                <option value="" selected disabled>Choose User Role</option>
                <option value="0">User</option>
                <option value="1">HRD</option>
                <option value="2">Partner</option>
            </select>
            <div class="ErrorMessage">
                @foreach($errors->get('admin') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <button class="submit-button" type="submit" value="Submit">Submit</button>
        </div>
    </form>
</div>

</body>
</html>