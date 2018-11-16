@extends('layouts.master',['title'=>'View all Companies'])

@section('main-container')


    <div>

        @if (count($companies)> 0)
        <ul class="list-group">

           @foreach($companies as $company)

                <a href="{{route('companies.show',['id'=>$company->id])}}">
                    <li class="card my-2">

                        <div class="card-body">
                            <h4>{{$company->name}}</h4>
                            <p>
                                @if(isset($company->parent))
                                    Parent Company : {{$company->getParent()->name}} |
                                @endif
                                @if(isset($company->station_count))
                                    Stations : {{$company->station_count}}
                                @endif
                            </p>
                        </div>

                    </li>
                </a>

               @endforeach

        </ul>

            {{ $companies->links() }}

        @else
            <div class="alert alert-info mt-5">
                <h5>There are no companies currently</h5>
            </div>
        @endif



    </div>





@endsection