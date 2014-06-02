<!DOCTYPE html>
<html lang="{{Config::get('app.locale');}}" ng-app="irailapp" ng-controller="StationLiveboardCtrl">
@include('core.head')
<body>
<div class="wrapper">
    <div id="main">
        @include('core.navigation')
        <div class="container">
            <div class="row loading" ng-show="loading">
                <div class="col-md-12 col-sm-12">
                    <div class="loader">Loading...</div>
                    <h4 class="center lg">{{Lang::get('client.loadingHeader')}}</h4>
                    <p class="small center">{{Lang::get('client.loadingSub')}}</p>
                </div>
            </div>
            <div class="row results" ng-show="results">
                <div class="col-md-12 col-sm-12">
                    <p class="h1">Liveboard {{Lang::get('client.station')}} <strong>@{{liveboardData.station}}</strong></p>
                    <p>{{Lang::get('client.liveboardDescription')}}</p>
                    <hr/>
                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="dep in liveboardData.departures.departure">
                              <span class="container33 liveboard-list">
                                    <span class="platform-left" ng-if="dep.platform">
                                        <span class="badge">@{{dep.platform}}</span>
                                    </span>
                                    <span class="platform-left" ng-if="!dep.platform">
                                        <span class="badge">?</span>
                                    </span>
                                    <span class="station-middle">
                                        <strong>
                                            @{{dep.station}}
                                        </strong>
                                    </span>
                                    <span class="time-right">
                                        @{{dep.time*1000 | date:'HH:mm' }}

                                    </span>
                                  <span class="delay-right">
                                    <span class="delay" ng-if="dep.delay > 0">
                                        &nbsp;&nbsp;+@{{dep.delay/60}}
                                    </span>
                                  </span>

                                </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row max-w5" ng-show="error" >
                <div class="col-md-12 col-sm-12">
                    <div class="well">
                        <h1 class="center"><i class="fa fa-support fa-3x center"></i>
                        </h1>
                        <h3>{{Lang::get('client.error')}} <strong>{{Lang::get('client.errorNoLiveboard')}}</strong></h3>
                        <p>{{Lang::get('client.errorExplanation')}} <a href="mailto:iRail@list.iRail.be">{{Lang::get('client.errorMail')}}</a>.</p>
                        <br/>
                        <a href="/stations" class="btn btn-danger btn-lg btn-wide"><i class="fa fa-chevron-left"></i> {{Lang::get('client.errorReturnLiveboard')}}</a>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('core.footer')
</body>
</html>