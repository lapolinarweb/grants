@extends('layouts.app')

@section('title') Grants @stop
@section('banner')
    <div class="header-banner bg-theme-grad has-ovm">
        <div class="nk-banner">
            <div class="banner banner-page">
                <div class="banner-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-9">
                                <div class="banner-caption cpn tc-light text-center">
                                    <div class="cpn-head">
                                        <h2 class="title ttu">Grants Application</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-banner -->
        <div class="nk-ovm shape-a-sm"></div>
    </div>
@stop

@section('content')
    <div class="user-content">
        <div class="user-kyc">
            <div class="from-step">
                <grants-index></grants-index>
            </div><!-- .from-step -->
        </div>
    </div>
@stop('content')
