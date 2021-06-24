@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg')  }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>{{ $refund->heading }}</h1>
           <p>{{ $refund->title }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Refund & Cancillation Policy</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      <div class="content-privacy">
        <div class="row">
          <div class="col-md-12">
            <h5>{{ $refund->heading }}</h5>
            {!! $refund->description !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection