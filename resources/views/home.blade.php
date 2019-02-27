@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div id='app'>  
        @if (Auth::user()->privileges == 'Gerente')
            <user-home> </user-home>
        @elseif (Auth::user()->privileges == 'Ventas')
            <seller-home> </seller-home>
        @elseif(Auth::user()->privileges == 'Cliente')
            <client-home> </client-home>
        @endif
    </div>
</div>
@endsection
