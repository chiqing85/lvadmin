@extends('home.layouts.base')
@section('indexs')
    <style>
        .bottom {
            position: absolute;
            bottom: 5px;
            left: 0;
            padding: 0 5px;
            width: 100%;
            font-size: 13px;
        }
        .bl {
            float: left;
        }
        .br {
            float: right;
        }
    </style>
    <div class="slide" style="background-image: url({{ $bg }});"></div>
    <div class="centrize full-width">
        <div class="vertical-center">
            <div class="title">
                {{ $cofig['title'] }}
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
        <div class="bottom">
            <div class="bl">
                {{ $cofig['copy'] }}
            </div>
            <div class="br">
                {{ $cofig['Record'] }}
            </div>
        </div>
    </div>
@endsection