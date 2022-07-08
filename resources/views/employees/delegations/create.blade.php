@extends('layouts.app')
@section('title', 'Delegations')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add Delegations
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/team/delegations/') }}" method="POST">
                            {{ csrf_field() }}
                            @method('post')

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="clientselect">{{ __('Client') }}
                                        {{--<span style="color: red;"> [Required]</span>--}}
                                    </label>
                                    <select style="background: none; height: calc(2.25rem + 2px); width: 100%; font-size: 1rem"
                                            id="clientselect"
                                            class="chosen form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}"
                                            name="client_id">
                                        <option value="{{ old('client_id') }}" selected disabled>Which Client?
                                        </option>
                                        <option value="999">
                                            Others
                                        </option>
                                        @foreach($clients as $client)
                                            <option data-location="{{ $client->location }}"
                                                    data-type="{{ $client->engagementtype }}"
                                                    data-period="{{ Carbon\Carbon::parse($client->engagementperiod)->format('Y') }}"
                                                    value="{{$client->id}}">{{$client->clientname}}
                                                , {{$client->clientcode}}
                                                @if($client -> engagementperiodstart === '0001-01-01' || $client -> engagementperiodstart === '0000-00-00' || $client -> engagementperiodstart === 'null')
                                                    @else
                                                    , &#126; {{ date('d M Y', strtotime($client -> engagementperiodstart)) }}
                                                    @endif
                                                , {{ date('d M Y', strtotime($client -> engagementperiod)) }}
                                                , {{ $client -> engagementtype }}
                                                @if($client -> keterangan !== null)
                                                    # {{ $client -> keterangan }}
                                                @else
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('client_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <script type="text/javascript">
                                $(".chosen").chosen();
                            </script>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="clientselect">{{ __('Team') }}
                <select name="group_id" id="divisi" class="form-control">
<option disabled selected>Choose Group</option>
@foreach($groups as $group)
    <option value="{{$group->id}}">{{$group->name}}</option>
@endforeach
</select>
</div>
</div>

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

    <script>
            $('#clientselect').on('change', function () {
                $('#period')
                    .val(
                        $(this).find(':selected').data('period')
                    );
                $('#type')
                    .val(
                        $(this).find(':selected').data('type')
                    );
                $('#location')
                    .val(
                        $(this).find(':selected').data('location')
                    );
            });


    </script>
@endsection
