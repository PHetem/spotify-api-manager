@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    <form method="post" action="{{ route('users.update', $user->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put" />

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if (Auth::user()->isAdmin)
                            <div class="row mb-3">
                                <label for="is_admin" class="col-md-4 col-form-label text-md-end">{{ ('Is Admin?') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input switch" type="checkbox" id="is_admin" name="is_admin" {{ $user->isAdmin ? 'checked' : ''}}>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ ('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
