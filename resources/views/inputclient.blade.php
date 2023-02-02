@extends('layouts.app')
@section('title', 'Clients')

@section('content')
    <style>
        select option:disabled {
            color: #000;
            font-weight: bold;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="card-title">Input New Client Data</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/administration/timereport/insertclient') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="clientname"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Client Name') }}</label>

                                <div class="col-md-6">
                                    <input id="clientname" type="text"
                                           class="form-control{{ $errors->has('clientname') ? ' is-invalid' : '' }}"
                                           name="clientname" value="{{ old('clientname') }}" required autofocus>

                                    @if ($errors->has('clientname'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('clientname') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="clientcode"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Client Code') }}</label>

                                <div class="col-md-6">
                                    <input id="clientcode" type="text"
                                           class="form-control{{ $errors->has('clientcode') ? ' is-invalid' : '' }}"
                                           name="clientcode" value="{{ old('clientcode') }}" required autofocus>

                                    @if ($errors->has('clientcode'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('clientcode') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="engagementdatestart"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Start Period') }}</label>

                                <div class="col-md-6">
                                    <input id="engagementdatestart" type="date"
                                           class="form-control{{ $errors->has('engagementdatestart') ? ' is-invalid' : '' }}"
                                           name="engagementdatestart" value="{{ old('engagementdatestart') }}" required autofocus>

                                    @if ($errors->has('engagementdatestart'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('engagementdatestart') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="engagementdate"
                                       class="col-md-4 col-form-label text-md-right">{{ __('End Period') }}</label>

                                <div class="col-md-6">
                                    <input id="engagementdate" type="date"
                                           class="form-control{{ $errors->has('engagementdate') ? ' is-invalid' : '' }}"
                                           name="engagementdate" value="{{ old('engagementdate') }}" required autofocus>

                                    @if ($errors->has('engagementdate'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('engagementdate') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="engagementtype"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Engagement Type') }}</label>

                                <div class="col-md-6">
                                    <select id="engagementtype"
                                            class="engagementtype form-control{{ $errors->has('engagementtype') ? ' is-invalid' : '' }}"
                                            name="engagementtype" value="{{ old('engagementtype') }}" required
                                            autofocus>
                                        <option value="" disabled>Choose Engagement Type</option>
                                        <option value="" disabled>Solis</option>
                                        <option value="A-001">Accounting Services - Monthly</option>
                                        <option value="A-002">Accounting Services - Project</option>
                                        <option value="A-003">Accounting Services - Review</option>
                                        <option value="T-001">Tax Services - Monthly</option>
                                        <option value="T-002">Tax Services - Yearly</option>
                                        <option value="T-003">Tax Services - Personal Tax</option>
                                        <option value="T-004">Tax Services - TP Documentation</option>
                                        <option value="T-005">Tax Services - Tax Audit</option>
                                        <option value="T-006">Tax Services - Tax Consultation</option>
                                        <option value="T-099">Tax Services - Others</option>
                                        <option value="L-001">Legal Services</option>
                                        <option value="O-001">Other Services</option>
                                        <option value="P-001">Packages</option>
                                        <option value="" disabled>MSId</option>
                                        <option value="M-001">General Audit</option>
                                        <option value="M-002">Special Audit</option>
                                        <option value="M-099">Others</option>
                                    </select>
                                    @if ($errors->has('engagementtype'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('engagementtype') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="institusi"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Institution Name') }}</label>

                                <div class="col-md-6">
                                    <select id="institusi"
                                            class="form-control{{ $errors->has('institusi') ? ' is-invalid' : '' }}"
                                            name="institusi" value="{{ old('institusi') }}" required autofocus>
                                        <option value="" disabled>Choose Institution</option>
                                        <option value="MSId">MSId</option>
                                        <option value="SOLIS">SOLIS</option>

                                    </select>
                                    @if ($errors->has('institusi'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('institusi') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="branch"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Institution Branch') }}</label>

                                <div class="col-md-6">
                                    <select id="branch"
                                            class="form-control{{ $errors->has('branch') ? ' is-invalid' : '' }}"
                                            name="branch" value="{{ old('branch') }}" required autofocus>
                                        <option value="" disabled>Choose Institution</option>
                                        <option value="JAKARTA">Jakarta</option>
                                        <option value="BATAM">Batam</option>

                                    </select>
                                    @if ($errors->has('branch'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('branch') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                                <div class="col-md-6">
                                    <input id="location" type="text"
                                           class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                           name="location" value="{{ old('location') }}" required autofocus>

                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fee" class="col-md-4 col-form-label text-md-right">{{ __('Fee') }}</label>

                                <div class="col-md-6">
                                    <input id="fee" type="number"
                                           class="form-control{{ $errors->has('fee') ? ' is-invalid' : '' }}"
                                           name="fee" value="{{ old('fee') }}" required autofocus>

                                    @if ($errors->has('fee'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('fee') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                                <div class="col-md-6">
                                    <input id="keterangan" type="text"
                                           class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}"
                                           name="keterangan" value="{{ old('keterangan') }}" required autofocus>

                                    @if ($errors->has('keterangan'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('keterangan') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="groups"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Groups Delegation') }}</label>

                                <div class="col-md-6">
                                    <select name="groups[]" id="groups" class="form-control" multiple>
                                        @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                        </select>
                                    @if ($errors->has('groups'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('groups') }}</strong>
                            </span>
                                    @endif
                                <p><br>Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</p>
                                </div>
                            </div>

                            <div class="form-group row mb-0" style="display: flex; justify-content: center;">
                                <a class="btn btn-outline-secondary" style="margin-right: 5px;"
                                   href="{{ URL::to('/administration/timereport/clients') }}">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Submit<!--{{ __('Submit') }}-->
                                </button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.engagementtype').change(function () {
                if ($('.engagementtype option:selected').text() == "Others") {
                    $('html .engagementtype').after("<input placeholder='Engagement Type' style='margin-top: 5px;' name='keterangan' class='other others form-control' required autofocus>");
                    $('.otherservice').remove();
                    $('.othertaxservice').remove();
                }
                else if ($('.engagementtype option:selected').text() == "Other Services") {
                    $('html .engagementtype').after("<input placeholder='Engagement Type' style='margin-top: 5px;' name='keterangan' class='other otherservice form-control' required autofocus>");
                    $('.others').remove();
                    $('.othertaxservice').remove();
                }
                else if ($('.engagementtype option:selected').text() == "Tax Services - Others") {
                    $('html .engagementtype').after("<input placeholder='Engagement Type' style='margin-top: 5px;' name='keterangan' class='other othertaxservice form-control' required autofocus>");
                    $('.otherservice').remove();
                    $('.others').remove();

                }
                else {
                    $('.other').remove();
                }
            })
        });
    </script>
@endsection
