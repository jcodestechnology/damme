@extends('layoutdash.userdashboard')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card welcome-card">
            <div class="card-body">
                <h5 class="card-title">Welcome to the Visual Reality Tourism System</h5>
                <p class="card-text">Experience new destinations like never before. Dive into the world of virtual reality and explore from the comfort of your home.</p>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<style>
    .welcome-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    padding: 20px;
}

.card-body {
    display: flex;
    flex-direction: column;
    align-items: start;
}

.card-title {
    font-size: 24px;
    color: #333333;
}

.card-text {
    font-size: 16px;
    color: #666666;
    margin-top: 10px;
}

    </style>
@endsection
