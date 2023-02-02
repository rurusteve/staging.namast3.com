@extends('layouts.app')
@section('title', 'Add Task')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Input Task
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/administration/timereport/inserttask') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="taskname" class="col-md-4 col-form-label text-md-right">{{ __('Task Name') }}</label>

                                <div class="col-md-6">
                                    <input id="taskname" type="text"
                                           class="form-control{{ $errors->has('taskname') ? ' is-invalid' : '' }}"
                                           name="taskname" value="{{ old('taskname') }}" required autofocus>

                                    @if ($errors->has('taskname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('taskname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="division" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="division" value="{{ old('division') }}" required>
                                        <option value="" {{ old('division') }} selected disabled>Choose Division</option>
                                        <option value="aud" {{ old('division') }}>Audit</option>
                                        <option value="acc" {{ old('division') }}>Accounting</option>
                                        <option value="tax" {{ old('division') }}>Taxation</option>
                                        <option value="adm" {{ old('division') }}>Administration</option>
                                    </select>

                                    @if ($errors->has('division'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('division') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="division" class="col-md-4 col-form-label text-md-right">{{ __('Group') }}</label>

                                <div class="col-md-6">
                                    <select id="group" required class="form-control" name="group">
                                    <option value="{{ old('group') }}" selected disabled>Choose Group
                                    </option>

                                    @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{ucwords($group->name)}}</option>
                                    @endforeach

                                    </select>

                                    @if ($errors->has('group'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('group') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!--<div class="form-group row">-->
                            <!--    <label for="activities" class="col-md-4 col-form-label text-md-right">{{ __('Activity Category') }}</label>-->

                            <!--    <div class="col-md-6">-->
                            <!--        <select class="form-control" name="activities" value="{{ old('activities') }}" required>-->
                            <!--            <option value="" {{ old('activities') }} selected disabled>Choose Activity Category</option>-->
                            <!--            <option value="1" {{ old('activities') }}>Professional Activities Relating to Engagements</option>-->
                            <!--            <option value="2" {{ old('activities') }}>Administration Activities and UN</option>-->
                            <!--        </select>-->

                            <!--        @if ($errors->has('activities'))-->
                            <!--            <span class="invalid-feedback" role="alert">-->
                            <!--            <strong>{{ $errors->first('activities') }}</strong>-->
                            <!--        </span>-->
                            <!--        @endif-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="form-group row mb-0" style="display: flex; justify-content: center;">

                                <a href="{{url()->previous()}}">
                                    <button type="button" class="btn btn-outline-secondary">Cancel</button>
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
@endsection
