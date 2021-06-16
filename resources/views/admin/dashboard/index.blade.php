@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fa fa-book-open text-white fa-2x">
                        </i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Berita</h4>
                        </div>
                        <div class="card-body">
                            {{ $post_count ?? '0' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <i class="fa fa-bell text-white fa-2x">
                        </i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Agenda</h4>
                        </div>
                        <div class="card-body">
                            {{ $event_count ?? '0' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fa fa-tags text-white fa-2x">
                        </i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tag</h4>
                        </div>
                        <div class="card-body">
                            {{ $tag_count ?? '0' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fa fa-users text-white fa-2x">
                        </i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Users</h4>
                        </div>
                        <div class="card-body">
                            {{ $user_count ?? '0' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
