<?php
@extends('layouts.header')

@section('content')

    <section class="top_section">
        <div class="container">
            <header>
                <div class="my_row">
                    <img src={{asset('images/logo.png')}} alt="" />
                    <a class="button red" href="/chat">Chat Home</a>
                </div>
            </header>
        </div>
    </section>

    <section>
        <div class="container">
            <div id="content"></div>
        </div>
    </section>


@endsection
