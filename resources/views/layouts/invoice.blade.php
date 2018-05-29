<!DOCTYPE html>

<html>

<head>
    <title>Invoice #{{ $invoice->id }}</title>
</head>

<body style="font-family: Tahoma, Helvetica, Arial">

<div class="container">
    <div class="row">
        <div class="col md 12" style="margin-top: 1.2rem;">
            <img src="{{asset('images/Logo_Elternbildung.png')}}" style="width: 55%;" class="mb-4">
        </div>
    </div>
    <div class="row">
        <div class="col md 12" style="margin-top: 2rem;">
            <h3 class="mt-5" style="margin-left: 1.5rem;">Meine Bestellung</h3>
            <div><strong>Rechnung #{{ $invoice->id }}</strong></div>
            <div><strong>Date: </strong>{{ $invoice->created_at }}</div>
            <div><strong>Title: </strong>{{ $invoice->title }}</div>
            <div><strong>Amount: </strong>{{ $invoice->price }} €</div>
            <div><strong>Payment Status: </strong>{{ $invoice->payment_status }}</div>
        </div>
    </div>
</div>
</body>