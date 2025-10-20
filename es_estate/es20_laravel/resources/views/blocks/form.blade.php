<section class="vh-100">
  <div class="container py-5 h-75">
    <div class="row d-flex justify-content-center align-items-center h-50">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{ asset('img/login.jpg') }}" alt="login form" class="img-fluid img-form"
                style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="{{ url("/{$pagina}") }}" method="POST">
                  @csrf

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">{{ $h1 }}</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">{{ $h3 }}</h5>

                  @if ($azione == 'registra')
                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Nome Utente</label>
                    <input type="text" id="form2Example17" class="form-control form-control-lg" name="name" required />
                  </div>
                  @endif

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Email</label>
                    <input type="email" id="form2Example17" class="form-control form-control-lg" name="email"
                      required />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Password</label>
                    <input type="password" id="form2Example27" class="form-control form-control-lg" name="password"
                      required />
                  </div>

                  @if ($azione == 'login')
                  <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block"
                      type="submit">Login</button>
                  </div>
                  @endif

                  @if($azione == 'login')
                    <div class="pt-1 mb-4">
                        <a type="button" class="btn btn-dark btn-lg btn-block" href="{{ route('usreg') }}">Registrati</a>
                    </div>
                  @else
                    <div class="pt-1 mb-4">
                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block"
                        type="submit">Registrati</button>
                    </div>
                  @endif

                  <a class="small text-muted" href="#!">Password dimenticata?</a><br>
                  <a href="#!" class="small text-muted">Termini del servizio</a><span> / </span>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>