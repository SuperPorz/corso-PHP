<section class="vh-100">
  <div class="container py-5 h-75">
    <div class="row d-flex justify-content-center align-items-center h-50">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{ asset('img/search.jpg') }}" alt="login form" class="img-fluid img-form"
                style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                @if (!isset($pagina) || $pagina == 'admin/homepage'){{-- rimuovere 2a cond. dopo fine debug --}}
                    <form action="{{ url('/admin/insert-book') }}" method="POST">
                @elseif ($pagina == 'modifica')
                    <form action="{{ url('/admin/edit-book') }}" method="POST">
                @elseif ($pagina == 'users/search')
                    <form id="cerca-libro" action="{{ url('/users/search') }}" method="POST">
                @endif
                    @csrf

                        <input type="hidden" name="idl" @if (!empty($libro_mod)) value="{{ $libro_mod['idl'] }}"@endif @if ($pagina == 'admin/homepage') required @endif>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="titolo">Titolo</label>
                            <input class="form-control form-control-lg" type="text" name="titolo" @if (!empty($libro_mod)) value="{{ $libro_mod['titolo'] }}"@endif @if ($pagina == 'admin/homepage') required @endif>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="autore">Autore</label>
                            <input class="form-control form-control-lg" type="text" name="autore" @if (!empty($libro_mod)) value="{{ $libro_mod['autore'] }}"@endif @if ($pagina == 'admin/homepage') required @endif>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="genere">Genere</label>
                            <input class="form-control form-control-lg" type="text" name="genere" @if (!empty($libro_mod)) value="{{ $libro_mod['genere'] }}"@endif @if ($pagina == 'admin/homepage') required @endif>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="dewey">Class. Dewey</label>
                            <input class="form-control form-control-lg" type="text" name="dewey" @if (!empty($libro_mod)) value="{{ $libro_mod['dewey'] }}"@endif @if ($pagina == 'admin/homepage') required @endif>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="collocazione">Collocazione</label>
                            <input class="form-control form-control-lg" type="text" name="collocazione" @if (!empty($libro_mod)) value="{{ $libro_mod['collocazione'] }}"@endif @if ($pagina == 'admin/homepage') required @endif>
                        </div>

                        <div class="pt-1 mb-4">
                            <input data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block"
                            type="submit" value="CERCA LIBRI">
                        </div>
                    </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>