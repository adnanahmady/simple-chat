@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Let's Chat</div>

                <div class="card-body">
                    <chat-component :user="{{ auth()->user() }}"></chat-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
