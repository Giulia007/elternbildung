@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h5 class="mt-4 display-4 title">
                Mitglied werden
            </h5>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="title mt-4 mb-4 title_small">
                    <h5>Vorteile für AbonnentInnen</h5>
                </div>
                <div class="vorteile">
                    <div class="mb-md-4"><img src="{{asset('icons/green-tick.png')}}"
                                              class="account_icon"> Laufend über Updates informiert
                    </div>
                    <div class="mb-md-4"><img src="{{asset('icons/green-tick.png')}}"
                                              class="account_icon"> Ein Jahr voller Zugriff
                    </div>
                    <div class="mb-md-4"><img src="{{asset('icons/green-tick.png')}}"
                                              class="account_icon"> Download und Sicherung des gesamten
                        Inhalts jederzeit möglich
                    </div>
                    <div class="mb-md-4"><img src="{{asset('icons/green-tick.png')}}"
                                              class="account_icon"> Druckoption
                    </div>
                    <div class="mb-md-4"><img src="{{asset('icons/green-tick.png')}}"
                                              class="account_icon"> Möglichkeit mit anderen ExpertInnen zu
                        den Inhalten auszutauschen
                    </div>
                    <div class="mb-md-4"><img src="{{asset('icons/green-tick.png')}}"
                                              class="account_icon"> Zugriff auf weiterführende Informationen
                        und Links
                    </div>
                </div>
            </div>
            <div class="col-md-5 display-4 mt-5 card">

                @if(Auth::check())

                    <div class="title_small pt-4">Jahresmitgliedschaft für 29€ bekommen mit</div>
                    <div class="row">
                        <div class="mt-3 ml-4" id="">
                            <a href="#"><img src="{{ asset('') }}" class="p-2"></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="btn mt-4 ml-3" id="transfer">
                            <h5><em><strong><a href="" class="no_decoration" data-toggle="modal"
                                               data-target="#transferModal">Banküberweisung</a></strong></em></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="btn mt-4 ml-3" id="voucher">
                            <h5><em><strong><a href="" class="no_decoration" data-toggle="modal"
                                               data-target="#voucherModal">Gutshein</a></strong></em></h5>
                        </div>
                    </div>
                @else

                    <div id="register_on_membership">

                        <h4 class="mb-4">Registrierung</h4>


                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Addresse</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Passwort</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Passwort
                                    wiederholen</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Anmelden
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        @include('includes/bank_transfer_modal')
        @include('includes/gutshein_modal')
    </div>

@endsection