@extends('home.layouts.base')
@section('indexs')
    <div class="slide" style="background-image: url({{ $bg }});"></div>
    <div class="centrize full-width">
        <div class="vertical-center">
            <div class="title">
                {{ $title }}
            </div>
            <div class="subtitle">
                I am
                <div class="typing-title">
                    <p>a <strong>program engineer.</strong></p>
                    <p>a <strong>blogger.</strong></p>
                </div>
                <span class="typed-title"></span>
            </div>
        </div>
    </div>
@endsection