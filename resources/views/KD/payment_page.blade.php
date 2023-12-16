<style>
    body {
        background: #eee;
    }

    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: 1rem;
    }

    .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.5rem 1.5rem;
    }
</style>

@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">



            <div class="container">
                <h1 class="h3 mb-5">Payment</h1>
                <form class="form-sample" action="/kd/process/payment/"method="POST"
                            enctype="multipart/form-data">
                            @csrf
                <div class="row">
                         <input type="hidden" {{$cbe_customer=" "}}/>
                    <input type="hidden" {{$hibret_customer=" "}}/>
                    <input type="hidden" {{$amhara_customer=" "}}/>
                    <!-- Left -->


                    <div class="col-lg-8">
                        <div class="accordion" id="accordionPayment">
                            <!-- Credit card -->
                            <div class="accordion-item mb-3">
                                <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
                                    <div class="form-check w-100 collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseCC" aria-expanded="false">
                                        <input class="form-check-input" type="radio" name="payment" id="payment1">
                                        <label class="form-check-label pt-1" for="payment1">
                                            Digital
                                        </label>
                                    </div>
                                    <span>
                                        <i class="mdi mdi-cellphone me-3 icon-lg text-success"></i>
                                    </span>
                                </h2>
                                <div id="collapseCC" class="accordion-collapse collapse" data-bs-parent="#accordionPayment"
                                    style="">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="provider">Please Select Provider</label>
                                                <select id="provider" name="provider"
                                                    class="form-control @error('provider') is-invalid @enderror">
                                                    <option value=""></option>
                                                    <option value="cbe_birr">CBE BIRR</option>
                                                    <option value="tila">TILA LOAN ACCOUNT</option>
                                                    <option value="other">OTHER</option>

                                                </select>

                                                @error('provider')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-md-6" id="tila-info" style="display:none;">
                                                <label class="form-label " for="tila">Please Select loan
                                                    provider</label>
                                                <select id="tila" name="tila"
                                                    class="form-control @error('tila') is-invalid @enderror">

                                                    <option value=""></option>
                                                    <option value="Hebret_Bank">
                                                        Hebret Bank</option>
                                                    <option value="Amhara_Bank">
                                                        Amhara Bank</option>
                                                    <option value="Other">Other
                                                    </option>










                                                </select>
                                                @error('tila')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="from_bank_account">FROM</label>

                                                        <input type="text"class="form-control" id="from_bank_account"
                                                            name="from_bank_account" readonly>


                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="to_bank_account">TO</label>
                                                        <input type="text"class="form-control" id="to_bank_account"
                                                            name="to_bank_account" readonly>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- PayPal -->
                            <div class="accordion-item mb-3 border">
                                <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
                                    <div class="form-check w-100 collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePP" aria-expanded="false">
                                        <input class="form-check-input" type="radio" name="payment" id="payment2">
                                        <label class="form-check-label pt-1" for="payment2">
                                            Cash
                                        </label>
                                    </div>
                                    <span>
                                        <i class="mdi mdi-cash-multiple me-3 icon-lg text-success"></i>

                                    </span>
                                </h2>
                                <div id="collapsePP" class="accordion-collapse collapse" data-bs-parent="#accordionPayment"
                                    style="">
                                    <div class="accordion-body ">
                                        <div class="px-2 col-lg-6 mb-3 ">
                                            {{-- <label class="form-label">Email address</label>
                                                <input type="email" class="form-control"> --}}
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" value="Unilever_client" name="flexRadioDefault"
                                                    id="flexRadioDefault1" />
                                                <label class="form-check-label" for="flexRadioDefault1"> Unilever client
                                                </label>
                                            </div>

                                            <!-- Default checked radio -->

                                            <div class="form-check ">
                                                <input class="form-check-input " type="radio" value="Other"name="flexRadioDefault" value
                                                    id="flexRadioDefault2" />
                                                <label class="form-check-label" for="flexRadioDefault2"> Other

                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right -->
                    <div class="col-lg-4">

                            <div class="card position-sticky top-0">
                                <div class="p-3 bg-light bg-opacity-10">

                                    <h6 class="card-title mb-3">Payment Summary</h6>

                                               @php
                                        $totalSum = 0;
                                    @endphp


{{-- @endforeach --}}
                                    @foreach ($orderedProducts as $p)
                                    {{-- {{$p->order_id}} --}}


                                        <div class="d-flex justify-content-between mb-1 small">
                                            <input type="hidden" vlaue="{{$cbe=$p->CBEBank_Account_Number}}"/>


                                            <input type="hidden" vlaue="{{$hibret=$p->HibretBank_Account_Number}}"/>
                                            <input type="hidden" vlaue="{{$amhara=$p->AmharaBank_Account_Number}}"/>
                                            @if ($p->Bank_name == "cbe_birr")
                                            <input type="hidden" {{$cbe_customer=$p->Bank_Account_Number}}/>

                                            @elseif ($p->Bank_name == "hibret_bank")
                                            <input type="hidden" {{$hibret_customer=$p->Bank_Account_Number}}/>

                                            @elseif ($p->Bank_name == "amhara_bank")
                                            <input type="hidden" {{$amhara_customer=$p->Bank_Account_Number}}/>
                                            @endif
                                            @if ($p->kd_adjusted_quantity == 0)
                                                <span>{{ $p->name }}</span> <span><strong
                                                        class="text-dark">{{ $p->ordered_quantity * $p->price }}
                                                        Birr</strong></span>
                                                @php
                                                   $totalSum += $p->ordered_quantity * $p->price;
                                                @endphp
                                            @elseif ($p->kd_adjusted_quantity !== 0)
                                                <span>{{ $p->name }}</span> <span><strong
                                                        class="text-dark">{{ $p->kd_adjusted_quantity * $p->price }}
                                                        Birr</strong></span>
                                                @php
                                                    $totalSum += $p->kd_adjusted_quantity * $p->price;
                                                @endphp
                                            @endif

                                        </div>

                                        {{-- <div class="d-flex justify-content-between mb-1 small">
                                    <span>Shipping</span> <span>$20.00</span>
                                </div> --}}
                                        {{-- <div class="d-flex justify-content-between mb-1 small">
                                    <span>Coupon (Code: NEWYEAR)</span> <span class="text-danger">-$10.00</span>
                                </div> --}}


{{-- <div class="form-check mb-1 small">
                                    <input class="form-check-input" type="checkbox" value="" id="tnc">
                                    <label class="form-check-label" for="tnc">
                                        I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div> --}}
                                        {{-- <div class="form-check mb-3 small">
                                    <input class="form-check-input" type="checkbox" value="" id="subscribe">
                                    <label class="form-check-label" for="subscribe">
                                        Get emails about product updates and events. If you change your mind, you can
                                        unsubscribe at any time. <a href="#">Privacy Policy</a>
                                    </label>
                                </div> --}}
                                    @endforeach
                                    <hr>
                                    {{-- {{$p->order_id}} --}}

                                    <input type="hidden" value="{{$p->order_id}}" name="order_id"/>
                                    <input type="hidden" value="{{$p->createdDate}}" name="createdDate"/>

                                    <input type="hidden" value="{{$totalSum}}" name="total_price"/>



                                    <div class="d-flex justify-content-between mb-4 small">
                                        <span>TOTAL</span> <strong class="text-dark">{{ $totalSum }} Birr</strong>
                                    </div>

                                    <button type="submit"class="btn btn-primary w-100 mt-2">PAY</button>

                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>


                </form>

            </div>


        </div>


    </div>


 <script>
        const providerSelect = document.getElementById('provider');
        const tilaSelect = document.getElementById('tila');
        const fromSelect = document.getElementById('from_bank_account');
        const toSelect = document.getElementById('to_bank_account');
        const tilaInfoDiv = document.getElementById('tila-info');
        let cbe='{{$cbe}}';
        let hibret='{{$hibret}}';
        let amhara='{{$amhara}}';
        let cbe_customer='{{$cbe_customer}}';
        let hibret_customer='{{$hibret_customer}}';
        let amhara_customer='{{$amhara_customer}}';



        providerSelect.addEventListener('change', () => {
            // Hide bank and loan info divs
            tilaInfoDiv.style.display = 'none';

            tilaSelect.value = '';
            fromSelect.value = '';
            toSelect.value = '';


            if (providerSelect.value === 'tila') {
                tilaInfoDiv.style.display = 'block';

            } else if (providerSelect.value === 'cbe_birr') {

                fromSelect.value = cbe_customer;
                toSelect.value=cbe;

            }

        });

        tilaSelect.addEventListener('change', () => {
            // Autofill bank account number based on selected bank
            if (tilaSelect.value === 'Hebret_Bank') {
                fromSelect.value = hibret_customer;

                toSelect.value=hibret;
                // Replace with actual bank account number
            } else if (tilaSelect.value === 'Amhara_Bank') {
                //  fetch(/get-bank-account/${tilaSelect.value})
                //       .then(response => response.json())
                //       .then(accountNumber => {
                //         bankAccountInput.value = accountNumber;
                //       });


fromSelect.value =  amhara_customer;
                toSelect.value=amhara;

                // Replace with actual bank account number
            } else if (tilaSelect.value === 'Other') {
                fromSelect.value = '5555555555';
                toSelect.value = '5555555555'; // Replace with actual bank account number
                // Replace with actual bank account number
            }
        });




        function yesnoCheck() {
            if (document.getElementById('cash').checked) {
                document.getElementById('ifYes').style.visibility = 'visible';
            } else document.getElementById('ifYes').style.visibility = 'hidden';
        }
        if (document.getElementById('ifYesdigital').checked) {
            document.getElementById('ifYes').style.visibility = 'visible';
        } else document.getElementById('ifYes').style.visibility = 'hidden';
    </script>
@endsection
