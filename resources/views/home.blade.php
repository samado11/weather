@extends('layouts.app')
<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    // console.log(navigator.geolocation.watchPosition())
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {

  let pos=position.coords.latitude+"_"+position.coords.longitude;
  console.log(pos);
  let url = "{{ route('index', ':pos') }}";    
      url = url.replace(':pos', pos);
      // url2 = url.replace(':lat', position.coords.latitude);
     document.location.href = url;
    //  document.href="http://localhost:8000/"+url1 +"/"+url2;


}


getLocation();
</script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
