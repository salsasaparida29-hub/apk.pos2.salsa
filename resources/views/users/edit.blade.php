@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="d-flex flex-column align-items-center">
    <h4 class="w-100" style="max-width: 600px;">Edit User</h4>

    <form action="{{ route('admin.users.update', $user)}}" method="post" class="w-100" style="max-width: 600px;">
        @include('users._form')
    </form>
</div>
@endsection