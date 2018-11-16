@extends('layouts.master',['title'=>$company->name || 'View Details'])

@section('main-container')

    <div class="row">
        <div class="col-md-8">
            <div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (count($company) > 0)
                    <div class="card my-2">
                        <div class="card-header d-inline-flex">
                            <h4 class="w-50 pull-left">{{$company->name}}</h4>
                            <div class="w-50 d-inline-flex">
                                <a class="w-25 btn btn-info pull-right" href="{{route('companies.edit',['id'=>$company->id])}}">Edit</a>

                                <form class="w-75 px-2" action="{{route('companies.destroy',['id'=>$company->id])}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class=" btn btn-danger pull-right" type="submit">Delete</button>

                                </form>

                            </div>
                        </div>
                        @if($company->getParent()!=null||($company->hasChildren()))
                            <div class="card-body">
                                @if(isset($company->parent))
                                    <div class="card">
                                       <div class="card-header">
                                           <h5 class="">
                                               Parent Company
                                           </h5>
                                           <a href="{{route('companies.show',['id'=>$company->parent->id])}}"> {{$company->parent->name}}</a>
                                       </div>
                                    </div>
                                @endif

                                @if(count($child_companies)>0)
                                    <div class="card mt-2">
                                        <h5 class="card-header">

                                            Child Companies

                                        </h5>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @foreach($child_companies as $child_company)
                                                    <li class="list-group-item">
                                                        <a href="{{route('companies.show',['id'=>$child_company->id])}}"> {{$child_company->name}}</a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        @endif

                    </div>
                @else
                    <div class="alert alert-info mt-5">
                        <h5>There are no companies currently</h5>
                    </div>
                @endif



            </div>
        </div>
        <div class="col-md-4">
           <div class="card my-2">
               <div class="card-header">
                   <h4>Stations</h4>
               </div>
               <div class="card-body">
                   @if (count($company->stations)> 0)
                       <ul class="list-group list-group-flush">

                           @foreach($company->stations as $station)
                               <li class="list-group-item py-1 ">
                                   <a href="{{route('stations.show',['id'=>$station->id])}}">
                                          {{$station->name}}
                                   </a>
                               </li>
                           @endforeach
                           @foreach($child_companies as $child_company)
                              @foreach($child_company->stations as $station)
                                   <li class="list-group-item">
                                       <a href="{{route('stations.show',['id'=>$station->id])}}">
                                           {{$station->name}}
                                       </a>
                                   </li>
                               @endforeach
                           @endforeach

                       </ul>
                   @else
                       <div class="alert alert-info mt-5">
                           <h5>There are no stations currently</h5>
                       </div>
                   @endif
               </div>
           </div>
        </div>
    </div>






@endsection