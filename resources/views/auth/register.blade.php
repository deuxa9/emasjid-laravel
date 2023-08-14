@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
          
          @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
      
          @if (session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
      
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                  <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                      <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="https://plus.unsplash.com/premium_photo-1678563876224-dbb520ffef17?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=464&q=80"
                          alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                      </div>
                      <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
          
                          <form action="/register" method="post">
                            @csrf
                            <div class="d-flex align-items-center mb-3 pb-1">
                              <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                              <span class="h1 fw-bold mb-0">E-Masjid</span>
                            </div>
          
                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login into your account</h5>
          
                            <div class="form-floating mb-3">
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" 
                              autofocus required value="{{ old ('name') }}">
                              <label for="name">Name</label>
                              @error('name')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                              @enderror
                            </div>
      
                            <div class="form-floating mb-3">
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" 
                              autofocus required value="{{ old ('email') }}">
                              <label for="email">Email address</label>
                              @error('email')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                              @enderror
                            </div>
                    
                            <div class="form-floating mb-3">
                              <input type="password" name="password" class="form-control" id="password" required>
                              <label for="password">Password</label>
                              @error('password')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                              @enderror
                            </div>

                            <div class="form-floating mb-3">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            </div>
      
                            <button class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                            <small><p class="mb-5 pb-lg-2" style="color: #393f81;">Have an account? <a href="/login"
                              style="color: #393f81;">Login here</a></p></small>
                          </form>
      
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
</div>
@endsection
