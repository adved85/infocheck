@extends('admin.layouts.admin')

@section('title', 'Questions')

@section('lang_menu')
@include('admin.includes.menu', $langs)
@endsection

@section('content')

@include('admin.common.errors')
@include('admin.common.oneerror')
@include('admin.common.success')

{{-- <a href="{{route('admin.subscribe.prepareToSend', app()->getLocale())}}">test fill</a> --}}
    <div class="card my-5">
        <h4 class="card-header text-secondary">Preapre Post to Mailing.</h4>

        <form action="{{route('admin.subscribe.prepareToSend', [app()->getLocale()]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="subs-post-id" class="col-sm-3 col-form-label col-form-label-lg">Last 10 Posts</label>
                    <div class="col-sm-9">
                        <select name="post_id" id="subs-post-id" class="form-control">
                            @foreach ($posts as $item)
                            <option value="{{$item->id}}">№-{{$item->id}} | {{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-lg">Prepare</button>
            </div>
        </form>
        <div class="card-footer">
            <h5>You have to click on the button for <span class="badge badge-pill badge-success">{{ceil($times)}}</span> times.</h5>

                @if (ceil($times) == 0)
                <button class="btn btn-primary btn-lg my-3">Select the post before mailing to subscribers</button>
                @else
                <a href="{{route('admin.subscribe.mailing', app()->getLocale())}}" class="btn btn-primary btn-lg my-3">30 mail per click</a>
                @endif

            <p class="mt-2"> Or call the <code> {{config('app.url')}}/am/admin/subscribe/mailing </code> link from URL </p>
        </div>

    </div>

<div class="subs-list-section card">
    <h3 class="py-3 text-secondary card-header">Subscriber Management.
        <span class="badge badge-pill badge-primary">{{$subscribers->count()}}</span>
    </h3>


    <div class="card-body">


        <div class="table-responsive-md">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Is_verified/Is_active</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($subscribers as $item)
                        <tr @if (! $item->is_verified) style="background-color:silver" @endif>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->email}}</td>
                            <td>{{$item->is_verified}}</td>
                            <td>
                            <div class="btn-group">
                                <form action="{{route('admin.subscribe.changeStatus', ['locale'=>app()->getLocale(), $item])}}" method="POST">
                                    @csrf
                                    <input type="text" name="id" value="{{$item->id}}" hidden>

                                        @if ($item->is_verified)
                                        <input type="text" name="is_verified" value="0" hidden>
                                        {{-- <a href="" class="btn btn-warning border border-dark">disable</a> --}}
                                        <button type="submit" class="btn btn-warning border border-dark">disable</button>
                                        @else
                                        <div class="btn-group">
                                        <input type="text" name="is_verified" value="1" hidden>
                                        {{-- <a href="" class="btn btn-primary border border-dark">enable</a> --}}
                                        <button type="submit" class="btn btn-primary border border-dark">enable</button>
                                        <a href="{{route('admin.subscribe.resend', ['locale'=>app()->getLocale(), $item])}}" role="button" class="btn btn-info border border-dark" title="Resend activation code"><i class="far fa-envelope"></i> Resend</a>
                                        </div>
                                        @endif
                                </form>

                                <form action="{{route('admin.subscribe.destroy', ['locale'=>app()->getLocale(), $item])}}" method="POST" onclick="return confirm('Do You really want to delete this subscriber?')?true:false">
                                    @csrf
                                    @method('DELETE')
                                    <input type="text" name="id" value="{{$item->id}}" hidden>
                                    <button type="submit" class="btn btn-danger border border-dark">
                                        <i class="fas fa-trash-alt"></i>
                                        delete</button>
                                </form>
                            </div>
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div><!-- card-body -->
</div>

@endsection
