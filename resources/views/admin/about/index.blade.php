@extends('admin.layouts.admin')

@section('title', 'Questions')

@section('lang_menu')
@include('admin.includes.menu', $langs)
@endsection

@section('content')

@include('admin.common.errors')
@include('admin.common.oneerror')
@include('admin.common.success')

<div class="about-section card">
    <h3 class="card-header text-secondary">About Us Management</h3>

    <div class="card-body">

        <div class="table-responsive-md">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Body</th>
                        <th scope="col">lang</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($abouts as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td style="width:50%"> <textarea cols="80" rows="5">{{$item->html_code}}</textarea></td>
                            <td>{{$item->lang->lng}}</td>
                            @if ($item->status === 0)
                                <td class="bg-warning">{{$item->status}}</td>
                            @else
                                <td>{{$item->status}}</td>
                            @endif

                            <td>
                            {{-- <div class="btn-group" role="group">

                                <a href="{{route('admin.about.edit', ['locale' => app()->getLocale(), $item])}}" class="btn btn-outline-primary btn-lg" role="button">
                                <i class="fas fa-pen-nib"></i> Edit</a>
                            </div> --}}

                                <form action="{{ route('admin.about.changeStatus', ['locale' => app()->getLocale(), $item ] )}}" method="POST">
                                    @csrf

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{route('admin.about.edit', ['locale' => app()->getLocale(), $item])}}" class="btn btn-outline-primary btn-lg" role="button" target="_blank">
                                        <i class="fas fa-pen-nib"></i> Edit</a>
                                        <input type="text" name="id" value="{{$item->id}}" hidden>
                                        @if ($item->status)
                                            <input type="text" name="status" value="0" hidden>
                                            <button type="submit" class="btn btn-warning border border-dark"><i class="far fa-eye-slash"></i> Hide</button>
                                        @else
                                            <input type="text" name="status" value="1" hidden>
                                            <button type="submit" class="btn btn-primary border border-dark"><i class="far fa-eye"></i> Show</button>
                                        @endif

                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- card-body -->
</div>


@endsection
