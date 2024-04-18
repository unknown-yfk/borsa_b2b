@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-xs-2">
                        <form action="/order/history/post" method="POST">
                            @csrf
                            <label><strong> Select ROM you want to handover Please: </strong></label><br><br>
                            <select id="rom_id" name="rom_id" class="form-control" required>
                                <option value=""></option>
                                @foreach ($roms as $rom)
                                    <option value="{{ $rom->id }}"> {{ $rom->firstName }}
                                        {{ $rom->middleName }} {{ $rom->lastName }}</option>
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
