@extends('layout')

@section('title', 'Home Page')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh; ">
        <div style="width: 300px; margin-right: 20px; background-color: #e3f2fd;">
            <!-- First Card -->
            <div class="card h-100">
                <div class="card-header" style="background-color: #add8e6">
                    Container 1
                </div>
                <div class="card-body">
                    <!-- Content for Container 1 -->
                    <p>This is the content of the first container.</p>
                </div>
            </div>
        </div>
        <div style="width: 300px; background-color: #e3f2fd;">
            <!-- Second Card -->
            <div class="card h-100">
                <div class="card-header">
                    Container 2
                </div>
                <div class="card-body">
                    <!-- Content for Container 2 -->
                    <p></p>
                </div>
            </div>
        </div>
    </div>
@endsection
