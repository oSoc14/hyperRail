@extends('layouts.default')
@section('header')
    @parent
@stop
@section('content')
    <div class="wrapper">
        <div id="main">
            @include('core.navigation-iframe')
            <div class="container">
                <div class="row login">
                    <div class="col-md-12">
                          <div class="panel">
                            <div class="panel-heading"><p class="h3">Please login</p></div>
                            <div class="panel-body">
                                <div style="margin-bottom: 30px;">
                                    <a href={{ $twitter_url }} class="btn btn-info btn-lg btn-block"><i class="fa fa-twitter"></i> | Sign in with Twitter</a>
                                </div>

                                {{ Form::open(array('url' => $url )) }}
                                @if($errors->has('login'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        {{ $errors->first('login', ':message') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    {{ Form::label('email', 'Email Address') }}
                                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password', 'Password') }}
                                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::submit('Login', array('class' => 'btn btn-success')) }}
                                    {{ HTML::link('/', 'Cancel', array('class' => 'btn btn-danger')) }}
                                </div>
                                {{ Form::close() }}
                                <span>{{Lang::get('client.noAccount')}}? <a href="{{ URL::to('register') }}" ng-click="resetplanner($event)">{{Lang::get('client.register')}}</a></span>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop