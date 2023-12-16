@extends('layouts.mainlayout')
@section('content')

<div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                    <h2>{{ Auth::user()->firstName }} {{ Auth::user()->middleName }} </h2>
                    <p class="mb-md-0">dashboard </p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>

                  </div>
                </div>

              </div>
            </div>
          </div>



        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © Elebat solution<a
                        href="https://Elebatsolution.com/" target="_blank">Elebatsolution.com </a>2023</span>

            </div>
        </footer>
        <!-- partial -->
      </div>







@endsection
