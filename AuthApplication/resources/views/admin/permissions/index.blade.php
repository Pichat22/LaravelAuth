@extends('layouts.app')
@section('content')
<div class="d-flex">
    <h1>Permission</h1>
    <form action="{{route('permissions.store')}}" method="post">
        @csrf
    <input type="text" class="fomr-control" name="name">
    <button class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection