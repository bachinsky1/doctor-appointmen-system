@extends('layouts.app')
@auth
@section('content')

<h2>{{__('My Profile')}}</h2>

<form class="row g-3">
    <div class="col-md-6">
        <label for="firstname" class="form-label">Firstname</label>
        <input type="text" class="form-control" id="firstname">

    </div>
    <div class="col-md-6">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" class="form-control" id="lastname">
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email">
    </div>
    <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password">
    </div>
    <div class="col-12">
        <label for="address1" class="form-label">Address</label>
        <input type="text" class="form-control" id="address1" placeholder="1234 Main St">
    </div>
    <div class="col-12">
        <label for="address2" class="form-label">Address 2</label>
        <input type="text" class="form-control" id="address2" placeholder="Apartment, studio, or floor">
    </div>
    <div class="col-md-6">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control" id="city">
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">State</label>
        <select id="inputState" class="form-select">
            <option selected>Choose...</option>
            <option>...</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="inputZip" class="form-label">Zip</label>
        <input type="text" class="form-control" id="inputZip">
    </div> 
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

@endauth
@endsection
