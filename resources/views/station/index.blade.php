@extends('layouts.master',['title'=>'View Stations'])

@section('main-container')
    <div>
        @if (count($stations)> 0)
        <ul class="list-group">

           @foreach($stations as $station)


                    <li class="card my-2">
                        <div class="card-body">
                            <a href="{{route('stations.show',['id'=>$station->id])}}">

                                    <h4>{{$station->name}}</h4>
                                    <p>Latitude: {{$station->latitude}} | Longitude: {{$station->longitude}}
                                    @if(isset($station->company))
                                      | Parent Company : {{$station->company->name}}
                                    @endif
                                    </p>

                            </a>
                            <form class="" action="{{route('stations.destroy',['id'=>$station->id])}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class=" btn btn-danger pull-right" type="submit">Delete</button>

                            </form>
                        </div>
                    </li>


               @endforeach

        </ul>
        @else
            <div class="alert alert-info mt-5">
                <h5>There are no stations currently</h5>
            </div>
        @endif



    </div>





@endsection