@extends('layouts.master',['title'=>'Find Nearest Stations'])

@section('main-container')
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card mt-5">


        <div class="card-header">
            <h2 class="card-header-title">
                Find Nearest Stations
            </h2>
        </div>
        <div class="card-body">
            <form class="" method="POST" action="/nearest-stations">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="name">Distance</label>
                    </div>
                    <input class="form-control" name="distance" type="number" required value="{{old('distance')}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="latitude">Latitude</label>
                    </div>
                    <input class="form-control" name="latitude" type="text" required value="{{old('latitude')}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="longitude">Longitude</label>
                    </div>
                    <input class="form-control" name="longitude" type="text" required value="{{old('longitude')}}">
                </div>


                <button class="btn btn-primary btn-block" type="submit">Find</button>

            </form>


        </div>


    </div>



@endsection