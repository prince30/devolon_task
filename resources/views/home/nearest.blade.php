@extends('layouts.master',['title'=>'Nearest Stations'])

@section('main-container')


    <div>
        @if (count($nearestStationsList)> 0)
            <ul class="list-group">

                @foreach($nearestStationsList as $station)


                    <li class="list-group-item my-2 py-0 px-1">
                        <a href="{{route('stations.show',['id'=>$station->id])}}">
                            <div class="">
                                <h4>{{$station->name}}</h4>
                                <p>Distance: {{$station->distance}} | Latitude: {{$station->latitude}} | Longitude: {{$station->longitude}}</p>
                                @if(isset($station->company))
                                    <p>Company : {{$station->company->name}}</p>
                                @endif
                            </div>
                        </a>

                    </li>


                @endforeach

            </ul>
        @else
            <div class="alert alert-info mt-5">
                <h5>There are no stations in this range. Try to increase the distance</h5>
                <a href="{{route('nearest.index')}}" class="btn btn-primary">Find Again</a>
            </div>
        @endif



    </div>





@endsection