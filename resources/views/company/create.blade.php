@extends('layouts.master',['title'=>'Create Company'])

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
                Create a Company
            </h2>
        </div>
        <div class="card-body">
            <form class="" method="POST" action="/companies">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="name">Name</label>
                    </div>
                    <input class="form-control" name="name" type="text">
                </div>

                @if(count($companies))
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="parent_company">Parent Company</label>
                    </div>
                    <select class="custom-select" name="parent_company">
                        <option selected>Select parent Company</option>
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>

                @endif
                <button class="btn btn-primary btn-block" type="submit" dusk="submit">Add</button>

            </form>


        </div>


    </div>



@endsection