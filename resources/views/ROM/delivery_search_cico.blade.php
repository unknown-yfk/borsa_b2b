@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-xs-2">
                        <form action="/delivery_search_cico/post" method="POST">
                            @csrf
                            <label><strong>Select CICO Please: </strong></label><br><br>
                            <select id="cico_id" name="cico_id" class="form-control" required>
                                <option value=""></option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}"> {{ $agent->firstName }}
                                        {{ $agent->middleName }} {{ $agent->lastName }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success mt-2">Search</button>


                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
