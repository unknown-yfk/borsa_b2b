<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
 @include('layout.partials.head')
 

</head>
<body>
   {{-- @if(Session::has('message'))
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    toastr.success("{{Session::get('message')}}");
    </script>
@endif --}}
 @include('sweetalert::alert')


 @if(Auth::user()->userType=="agent")
@include('layout.partials.usertype.agent.agent-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.agent.agent-sidebar')




  @elseif(Auth::user()->userType=="RSP")
    @include('layout.partials.usertype.rsp.rsp-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.rsp.rsp-sidebar')




   @elseif(Auth::user()->userType=="client")
    @include('layout.partials.usertype.client.client-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.client.client-sidebar')




   @elseif(Auth::user()->userType=="ROM")

    @include('layout.partials.usertype.rom.rom-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.rom.rom-sidebar')



   @elseif(Auth::user()->userType=="TM")
@include('layout.partials.usertype.tm.tm-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.tm.tm-sidebar')


   @elseif(Auth::user()->userType=="key distributor")
@include('layout.partials.usertype.kd.kd-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.kd.kd-sidebar')













   @elseif(Auth::user()->userType=="admin")

@include('layout.partials.nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.sidebar')


@elseif(Auth::user()->userType=="HO")

@include('layout.partials.usertype.ho.ho-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.ho.ho-sidebar')





@elseif(Auth::user()->userType=="officer")

@include('layout.partials.usertype.officer.officer-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.officer.officer-sidebar')


@elseif(Auth::user()->userType=="analyist")
@include('layout.partials.usertype.analyist.analyist-nav')
 <div class="container-fluid page-body-wrapper">
@include('layout.partials.usertype.analyist.analyist-sidebar')

 @endif
@yield('content')

@include('layout.partials.footer-scripts')




</body>

</html>

