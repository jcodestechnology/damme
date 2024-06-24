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
                <h5 class="card-title typing-effect">Welcome, {{ Auth::user()->name }}, to the Visual Reality Tourism System</h5>
                <p class="card-text fade-in">Experience new destinations like never before. Dive into the world of virtual reality and explore from the comfort of your home.</p>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<style>
    .welcome-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
        padding: 20px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .welcome-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    }

    .card-body {
        display: flex;
        flex-direction: column;
        align-items: start;
    }

    .card-title {
        font-size: 24px;
        color: #333333;
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    .card-text {
        font-size: 16px;
        color: #666666;
        margin-top: 10px;
        opacity: 0;
        animation: fadeIn 2s forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }

    @keyframes blink {
        0%, 100% { border-right-color: transparent; }
        50% { border-right-color: black; }
    }

    .typing-effect {
        display: inline-block;
        font-size: 24px;
        white-space: nowrap;
        overflow: hidden;
        border-right: 2px solid black;
        animation: typing 4s steps(40, end), blink 0.75s step-end infinite;
    }

    .typing-effect.typing-done {
        border-right: none;
    }

    .fade-in {
        animation: fadeIn 2s forwards;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.querySelector('.typing-effect').classList.add('typing-done');
        }, 4000); // Match this duration with your typing animation duration
    });
</script>
@endsection
