
@if(session()->has('simple-alert'))
	<div class="alert alert-simple alert-dismissible fade show" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	    <h5>{{ session()->get('simple-alert') }}</h5>
	</div>
@endif
@if(session()->has('success-alert'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	    <h5>{{ session()->get('success-alert') }}</h5>
	</div>
@endif
@if(session()->has('danger-alert'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	    <h5>{{ session()->get('danger-alert') }}</h5>
	</div>
@endif
@if(session()->has('warning-alert'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	    <h5>{{ session()->get('warning-alert') }}</h5>
	</div>
@endif

@if(count($errors) > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif