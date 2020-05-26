@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Select a tool:</p>

                    <ul class="list-unstyled">
                        <li><a href="/dpl">DPL Generator</a></li>
                        @can('update-screens')
                            <li><a href="/button-updates">Button Updates</a></li>
                        @endcan
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
