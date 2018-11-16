@extends('layouts.master',['title'=>'View station'])

@section('main-container')
    <div>
        @if (count($station) > 0)
                    <div class="card my-2">
                        <div class="card-header d-inline-flex">
                            <h4 class="w-50 pull-left">{{$station->name}}</h4>
                            <div class="w-50 d-inline-flex">
                                <a class="w-25 btn btn-info pull-right" href="{{route('stations.edit',['id'=>$station->id])}}">Edit</a>
                                <form class="w-75 px-2" action="{{route('stations.destroy',['id'=>$station->id])}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class=" btn btn-danger pull-right" type="submit">Delete</button>

                                </form>

                            </div>
                        </div>
                        <div class="card-body">
                            @if(isset($station))
                                <ul class="list-group">

                                    <li class="list-group-item">
                                        <p>Latitude : {{$station->latitude}}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <p>Longitude : {{$station->longitude}}</p>
                                    </li>


                                </ul>
                            @endif

                            @if(isset($station->company))
                                <div class="card mt-2">
                                    <h5 class="card-header">
                                        Parent Company
                                    </h5>
                                    <div class="card-body">
                                        <a href="{{route('companies.show',['id'=>$station->company->id])}}"> {{$station->company->name}}</a>
                                    </div>
                                </div>
                            @endif


                        </div>

                    </div>
       @else
            <div class="alert alert-info mt-5">
                <h5>There are no stations currently</h5>
            </div>
        @endif



    </div>





@endsection