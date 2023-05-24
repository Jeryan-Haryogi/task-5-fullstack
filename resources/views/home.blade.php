@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
    @foreach($data as $d)
      <div class="col-sm-3">
      <div class="card mt-2">
            <img src="images/{{$d->image}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$d->title}}</h5>
                
                
                <a href="{{url('/Artikel')}}/{{$d->id}}" class="btn btn-primary">Lihat</a>
            </div>
            </div>
      </div>
      
      @endforeach
    </div>

{{ $data->links('pagination::bootstrap-4') }}
</div>



@endsection
