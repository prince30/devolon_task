@extends('layouts.master',['title'=>'Create station'])

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
                Create a Station
            </h2>
        </div>
        <div class="card-body">
            <form class="" method="POST" action="/stations">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="name">Name</label>
                    </div>
                    <input class="form-control" name="name" type="text" required value="{{old('name')}}">
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

                @if(count($companies)>0)
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="parent_company">Parent Company</label>
                        </div>
                        <select class="custom-select" name="parent_company" required>
                            <option>Select parent Company</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>

                @endif
                <button class="btn btn-primary btn-block" type="submit">Add</button>

            </form>


        </div>


    </div>



@endsection