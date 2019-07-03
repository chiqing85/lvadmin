@extends('home.layouts.base')
@section('contents')
    <div class="card-inner active" id="about-card">
        <div class="row card-container">
            <div class="card-wrap col col-m-12 col-t-12 col-d-12 col-d-lg-12" data-simplebar="init">
                <div class="content services post">
                    <div class="row service-items">
                        <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                            <div class="box-item article_info">
                                <div class="desc">
                                    <div class="category" id="testeditormdview">
                                        @if( !empty( $article ) )
                                        {!! $article->content !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection