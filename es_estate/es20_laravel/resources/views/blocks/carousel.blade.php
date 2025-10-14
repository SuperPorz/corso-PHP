<div class="row justify-content-md-center">
    <div class="col-md-auto"></div>

    <div class="col col-lg-10">
        <div id="carouselExampleAutoplaying" class="w-100 carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/carousel01.jpg') }}" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/carousel02.jpg') }}" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/carousel03.jpg') }}" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Third slide">
                </div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="col-md-auto"></div>
</div>