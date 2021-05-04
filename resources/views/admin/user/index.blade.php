@extends('admin.layouts.admin')

@section('title', 'Users')

@section('lang_menu')
@include('admin.includes.menu', $langs)
@endsection

@section('content')

@include('admin.common.errors')
@include('admin.common.oneerror')
@include('admin.common.success')

<div class="user-list-section card">
    <h3 class="card-header">User Management</h3>

    <div class="card-body">
        <div class="table-responsive-md">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Verified</th>
                        <th scope="col">Status</th>
                        <th scope="col">Role</th>
                        <th scope="col">Provider</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th scope="row" class="align-middle">{{$user->id}}</th>
                            <td class="align-middle">{{$user->email?$user->email:' "----" '}}</td>
                            <td class="align-middle">
                                @if ($user->email_verified_at)
                                    <span class="bg-success p-2 text-white"><strong>{{$user->email_verified_at}}</strong></span>
                                @else
                                <span class="border border-danger p-2 text-danger"><strong>not verified</strong></span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if ($user->status)
                                <span class="border border-success p-2 text-dark"><strong> Active </strong></span>
                                @else
                                <span class="border border-danger p-2 text-danger"><strong> Baned </strong></span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if ($user->roles[0]['name'] !== 'i_admin')
                                    <strong>User</strong>
                                @else
                                <strong class="border border-primary px-2 py-1" style="display:block"><i class="fas fa-users-cog"></i> Admin</strong>
                                @endif
                                {{-- @dump($user->roles[0]['name']) --}}
                            </td>
                            <td class="align-middle">

                                @if ($user->identities()->exists())
                                    {{-- @dump($user->identities[0]['provider_name']) --}}

                                    @if ($user->identities[0]['provider_name'] ==='facebook')
                                        <div class="text-dark bg-primary p-1">
                                            <span class="bg-white px-2 py-1 rounded-circle"><i class="fab fa-facebook-f"></i></span>
                                        </div>
                                    @endif
                                @else
                                    <strong style="font-size:20px" class="text-info"><i class="fas fa-globe"></i></strong>
                                @endif
                            </td>

                            <td class="align-middle">
                                @if ($user->identities()->exists())
                                    <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thumbnail w-25">
                                @else
                                <img src="/storage/profiles/default.png" alt="{{$user->name}}" class="img-thumbnail w-25">
                                @endif
                            </td>

                            <td id="actions" class="align-middle">
                            <form action="{{ route('admin.user.changeStatus', ['locale'=> app()->getLocale(), 'id'=>$user->id]) }}" method="POST">
                                @csrf
                                @method('put')

                                <div class="btn-group">
                                    @if ($user->status)
                                        <input type="text" name="status" value="0" hidden>
                                        @if ($user->roles[0]['name'] !== 'i_admin')
                                            <button class="btn btn-outline-danger">Block</button>
                                        @else
                                        <button class="btn btn-outline-dark" onclick="return false">
                                            <i class="fas fa-user-secret" style="font-size:20px"></i>
                                        </button>
                                        @endif
                                    @else
                                        <input type="text" name="status" value="1" hidden>
                                        <button class="btn btn-outline-info">Activate</button>
                                    @endif
                                    <a href="{{route('admin.email.compose',['locale'=>app()->getLocale(), $user->id])}}" role="button" class="btn btn-outline-secondary">
                                        <i class="far fa-envelope"></i> Send Mail
                                    </a>
                                </div>
                            </form>
                            </td>
                        </tr>
                    @empty

                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            {{$users->links()}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

@endsection
