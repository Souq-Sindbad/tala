@extends('dashboard.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $data['title'] }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="row">
                @if (auth()->user()->hasPermission('features-read'))
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far @lang('icons.features')"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.features')</span>
                                <span class="info-box-number">{{ $data['counter']['features'] }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (auth()->user()->hasPermission('benefits-read'))
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far @lang('icons.benefits')"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.benefits')</span>
                                <span class="info-box-number">{{ $data['counter']['benefits'] }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (auth()->user()->hasPermission('partners-read'))
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far @lang('icons.partners')"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.partners')</span>
                                <span class="info-box-number">{{ $data['counter']['partners'] }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (auth()->user()->hasPermission('projects-read'))
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far @lang('icons.projects')"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.projects')</span>
                                <span class="info-box-number">{{ $data['counter']['projects'] }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (auth()->user()->hasPermission('statistics-read'))
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far @lang('icons.statistics')"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.statistics')</span>
                                <span class="info-box-number">{{ $data['counter']['statistics'] }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </section>

    </div>
@endsection

