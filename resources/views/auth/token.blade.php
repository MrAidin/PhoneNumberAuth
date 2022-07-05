@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Two Factor Authenticate</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('auth.phone.token')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="token" class="col-form-label">Token:</label>
                                <input type="text" name="token" class="form-control @error('token') is-invalid @enderror" placeholder="Enter your token">
                                @error('token')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" value="verify" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
