@extends('admin.layouts.admin')

@section('title', 'Categories')

@section('lang_menu')
@include('admin.includes.menu', $langs)
@endsection

@section('content')

@include('admin.common.errors')
@include('admin.common.success')

@if ($susan = Session::get('susan'))
<div class="alert alert-success alert-block fade show">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <php?  var_dump($susan);die; ?>
</div>
@endif

{{-- {{dd($sorted)}} --}}

<div class="cat-sort-section card">
    <h2 class="py-3 text-secondary card-header">Sorting Menu Items</h2>
    <div class="card-body">
        <div class="cat-sort-wrapper d-flex flex-row align-items-center">

            <ul id="sortable" class="list-group cat-sort-list">
                @foreach ($sorted as $item)
                <li class="list-group-item" id="{{$item->item_id}}">
                    item_id- {{$item->item_id}}
                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    {{$item->name}} || position - {{$item->position}}
                </li>
                @endforeach

                {{-- <li class="list-group-item"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
                <li class="list-group-item"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
                <li class="list-group-item"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
                <li class="list-group-item"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
                <li class="list-group-item"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
                <li class="list-group-item"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li> --}}
            </ul>

            <div class="cat-sort-description">
                <div class="card-body bg-light ml-3">

                    <div class="alert alert-success" role="alert" id="pos_alert_success">
                        Positions of Menu-items was successfuly updated.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger" role="alert" id="pos_alert_danger">
                        Woops! Positions was not updated.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p class="card-text">
                        Here you can change the position of the Menu items.
                        After that just click the "Save" button.
                    </p>
                    <button type="button" class="btn btn-outline-dark" id="save-cat-positions">Save Items Position</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="cat-crud-section card">
        <div class="table-responsive-md">
                <h2 class="py-3 text-secondary card-header">Menu Item Management</h2>
                <div class="container">
                    <div class="row card-body justify-content-end">
                        <h5 style="margin-top:8px;">Click the button to create a new Menu-item (Category).</h5>
                        <div class="col-3">
                        <a type="button" class="btn btn-outline-primary" href="{{ route('admin.category.create', app()->getLocale()) }}" target="_blank">Create New</a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">

                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">Item ID </br>multilang</th>
                          <th scope="col">ID </br>{{app()->getLocale()}}</th>
                          <th scope="col">Name</th>
                          <th scope="col">Position</th>
                          <th scope="col">Layout</th>
                          <th scope="col">Status</th>
                          <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $item)
                            <tr>
                                <th scope="row">{{$item->item_id}}</th>
                                <td>{{$item->id}}</td>

                                <td>{{$item->name}}</td>
                                <td>{{$item->position}}</td>
                                <td>{{$item->layout}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    <form action="{{ route('admin.category.destroy', ['locale' => app()->getLocale(), $item ] )}}" method="POST"
                                        onsubmit="if(confirm('Are you shure you want to delete it?')){ return true } else {return false}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <!-- translate button START -->
                                        @if (app\Category::where('item_id', $item->item_id)->count() !== count($langs))

                                        <div class="btn-group" role="group">
                                            <button id="btnGroupTrans" type="button" class="btn btn-outline-primary px-1 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-globe"></i>
                                            </button>
                                            <div class="dropdown-menu py-0" aria-labelledby="btnGroupTrans">
                                            <div class="list-group shadow-lg">
                                                @foreach ($langs as $lezu)

                                                    @if (!app\Category::where('item_id', $item->item_id)->where('lang_id', $lezu->id)->first())
                                                        <a href="{{route('admin.category.translate',['locale' =>$lezu->lng,'id'=>$item->id])}}" class="text-center py-1" target="_blank">
                                                            {{$lezu->lng_name}}
                                                        </a>
                                                    @endif

                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        @endif
                                        <!-- translate button END -->




                                        <a role="button" class="btn btn-primary" id="cat-edit" href="{{route('admin.category.edit',['locale' => app()->getLocale(),$item])}}" target="_blank">Edit</a>
                                        <button role="button" type="submit" class="btn btn-danger" id="cat-delete">Delete</button>
                                    </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-info">
                                        No data to show.
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
        </div>
</div>


@endsection



