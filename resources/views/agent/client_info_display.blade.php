@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-xs-2">
                        {{-- <div class="col-md-6">
                                                <img src="../../assets/users_img/{{ Auth::user()->userPhoto }}"
                                                    class="rounded-circle shadow-4-strong"
                                                    alt="{{ Auth::user()->userName }}" width="100rem" height="100rem">

                                            </div> --}}

                                            <div class="ml-5">
   <form action="/order/place" method="POST">
                @csrf
                <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                <input type="hidden" value="{{ $clients[0]->user_id }}" name="clients_user_id">

                        <img src="{{ asset('/assets/Borsa.png') }}" alt="{{ Auth::user()->userName }}" class="rounded-circle shadow-4-strong pl-5" width="100rem" height="100rem">
                                            </div><br>
                        {{ __('Client Name') }} : <strong> {{ $clients[0]->firstName }} {{ $clients[0]->middleName }}
                            {{ $clients[0]->lastName }}</strong><br>
                        {{ __('Key Distributor Name') }} : <strong> {{ $kd_name[0]->firstName }}  {{ $kd_name[0]->middleName }}
                            {{ $clients[0]->lastName  }}</strong><br><br>

                            {{-- <a href="/order/place" type="button" class="btn btn-primary">Start Ordering</a> --}}
<button type="submit" class="btn btn-primary "> {{__('Start Ordering')}}</button>
   </form>



                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
