@extends('layouts.app')
@section('title', 'Mein Konto')
@section('content')
    <div class="row">
        <div class="col-md-8 my_account">
            <h5 class="mt-4 display-4 title">
                Mein Konto
            </h5>
        </div>

        <div class="col-md-4 text-right mt-4">
            <a href="#" data-toggle="collapse" data-target="#editForm">Daten bearbeiten</a>
        </div>

            
        <!-- Edit Details -->
        <div class="col-12">
            <div id="editForm" class="collapse">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit user Details</h5>
                        <div class="p-2 my-2 text-white bg-success" id="message"></div>

                        <form id="editUser" class="form-row">
                            <div class="form-group col-7">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-7">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group col-7">
                                <button class="btn btn-outline-primary" type="submit">Speichern</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Data -->
        <div class="col-md-6 mt-4">
            <h5>Subskriptionsstatus</h5>
            @if($user->hasValidSubscription())
                <div class="col-md-3  col-xs-5">
                    active
                    <img src="{{asset('icons/green-tick.png')}}" class="account_icon ml-2">
                </div>
            @else
                <div class="col-md-3 col-xs-5">
                    inactive
                    <img src="{{asset('icons/red-cross.png')}}" class="account_icon ml-2">
                </div>
            @endif
        </div>

        
        <!-- Users Orders -->
        <div class="col-sm-8">
            <h5 class="mt-5">Meine Bestellungen</h5>
            <table class="table table-striped mb-5">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Rechnungsdownload</th>
                </tr>
                </thead>
                <tbody>
                @forelse($user->invoices as $invoice)
                    <tr>
                        <th scope="row">{{ $invoice->id }}</th>
                        <td>{{ $invoice->created_at }}</td>
                        <td>{{ $invoice->title }}</td>
                        <td>{{ $invoice->price }} €</td>
                        <td>{{ $invoice->payment_status }}</td>
                        <td><a href="{{ action('ContentController@download', $invoice) }}">
                                <i class="fa fa-download accordion_hover"></i></a></td>

                    </tr>

                @empty
                    <tr><td colspan="6">Keine Bestellungen vorhanden</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <script>

        $(document).ready(function(){
            $('#message').hide();

            $('form#editUser').submit(function( event ) {
                event.preventDefault();
                
                $.ajax({
                    url: '/account',
                    dataType: 'json',
                    traditional: true,
                    type: 'post',
                    data: $( this ).serialize(),
                    success: function (data) {
                            $('#message').show();
                            $("#message").text('Your user details have been successfully updated!');
                    },
                    error: function (response) {
                        console.log(response.responseText);
                    }
                });

                return;
            });

        });
        

    </script>
@endsection