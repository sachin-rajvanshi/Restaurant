@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>My Account</h1>
           <p>{{ \Auth::user()->about_me }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>My Account</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          @include('user.sidebar')
        </div>
        <div class="col-md-8">
          <div class="dashbaord-block-right">
            <div class="dashbaord-header">
              <h3>My Account</h3>
            </div>
            <div class="inner-block">
              <div class="myaccountrj">
                <div class="row">
                  <div class="col-md-4 col-sm-5">
                    <div class="accprofile">
                    	@if(Storage::exists(\Auth::user()->profile_photo))
			                <img src="{{ asset('storage') }}/{{ \Auth::user()->profile_photo }}">
			            @else
			                <img src="{{ asset('') }}assets/img/nopreview.jpg">
			            @endif
                    </div>
                    <div class="updatepro">
                      <a href="{{ route('user.editProfile') }}" class="btn btn-secondary mt-4 d-block">Edit Account Info</a>
                    </div>
                  </div>
                  <div class="col-md-8 col-sm-7">
                    <div class="accinfo">
                      <h4>Basic Info</h4>
                      <table class="table acctable">
                        <tbody>
                        <tr>
                          <td style="width:120px">Name:</td>
                          <td>{{ \Auth::user()->name }}</td>
                        </tr>
                        <tr>
                          <td>Email:</td>
                          <td>{{ \Auth::user()->email }}</td>
                        </tr>
                        <tr>
                          <td>Mobile:</td>
                          <td>+91 {{ \Auth::user()->mobile_number }}</td>
                        </tr>
                        <tr>
                          <td>Gender:</td>
                          <td>{{ \Auth::user()->gender }}</td>
                        </tr>
                        <tr>
                          <td>DOB:</td>
                          <td>{{ date('d M Y', strtotime(\Auth::user()->dob)) }}</td>
                        </tr>
                        <tr>
                          <td>Marital Status:</td>
                          <td>Married</td>
                        </tr>
                        <tr>
                          <td>Billing Address:</td>
                          <td>887 Cypress Rd. Garden Grove, CA 92840 · 9744 Glenlake St. Carson, California, USA</td>
                        </tr>
                        <tr>
                          <td>Shipping Address:</td>
                          <td>887 Cypress Rd. Garden Grove, CA 92840 · 9744 Glenlake St. Carson, California, USA</td>
                        </tr>
                        <tr>
                          <td>About me:</td>
                          <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection