@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mx-3 my-1">
            {{ session('success') }}
        </div>
    @endif

    <div class="card m-3 p-3">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="inventoryId">Inventory Id</label>
                <input type="text" class="form-control" id="inventoryId" name="inventoryId" placeholder="Inventory Id">
            </div>
            <div class="form-group pt-2">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                       placeholder="Description">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>

@endsection
