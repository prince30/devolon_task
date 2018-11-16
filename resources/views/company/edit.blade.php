@extends('layouts.master',['title'=>'Edit '.$company->name || 'Edit Company Details'])

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
                Update Company
            </h2>
        </div>
        <div class="card-body">
            <form class="" method="POST" action="/companies/{{$company->id}}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="name">Name</label>
                    </div>
                    <input class="form-control" name="name" type="text" value="{{$company->name}}">
                </div>

                <button class="btn btn-primary btn-block" type="submit">Update</button>

            </form>


        </div>


    </div>



@endsection