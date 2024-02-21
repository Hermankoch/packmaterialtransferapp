@extends('layouts.app')
@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            height: calc(2.25rem + 2px);
            line-height: 2.25rem;
            padding: 0.375rem 0.75rem;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px);
        }

        .select2-container--default .select2-selection--single:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .select2-container--open .select2-dropdown--below {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .select2-dropdown {
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0;
        }
    </style>
    @if(session('success'))
        <div class="alert alert-success mx-3 my-1">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($orderId))
        <livewire:order-form :orderId="$orderId"/>
    @else
        <livewire:order-form/>
    @endif
@endsection



