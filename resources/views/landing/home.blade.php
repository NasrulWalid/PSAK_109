
@include('landing.layouts.app')

<!-- Carousel Start -->
<div class="header-carousel owl-carousel">
    <div class="header-carousel-item bg-primary">
        <div class="carousel-caption">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7 animated fadeInLeft">
                        <div class="text-sm-center text-md-start">
                            <h4 class="text-white text-uppercase fw-bold mb-4">Selamat Datang di PSAK71</h4>
                            <h1 class="display-1 text-white mb-4">Memahami Keuangan dengan Standar Terpercaya</h1>
                            <p class="mb-5 fs-5">Di dunia yang terus berubah, pengelolaan keuangan yang tepat dan transparan adalah kunci keberhasilan. PSak hadir sebagai panduan utama bagi para profesional dan praktisi akuntansi di Indonesia, membantu Anda menavigasi kompleksitas laporan keuangan sesuai dengan standar yang berlaku.</p>
                            <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="{{ route('under') }}"><i class="fas fa-play-circle me-2"></i> Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 animated fadeInRight">
                        <div class="carousel-img" style="object-fit: cover;">
                            <img src="{{ asset('landing/img/carousel-2.png') }}" class="img-fluid w-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

       <!-- Feature Start -->
       <div class="container-fluid feature bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h1 class="display-4 mb-4">Mengapa PSAK71?</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="feature-item p-4 pt-0">
                        <div class="feature-icon p-4 mb-4">
                            <i class="far fa-handshake fa-3x"></i>
                        </div>
                        <h4 class="mb-4">Terpercaya</h4>
                        <p class="mb-4">Standar yang diakui secara nasional dan dirancang untuk memastikan konsistensi dan kejelasan dalam pelaporan keuangan.<br><br><br>
                        </p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('under') }}">Lihat Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="feature-item p-4 pt-0">
                        <div class="feature-icon p-4 mb-4">
                            <i class="fa fa-dollar-sign fa-3x"></i>
                        </div>
                        <h4 class="mb-4">Akurasi dan Transparansi</h4>
                        <p class="mb-4">PSAK memberikan panduan yang jelas dan rinci, sehingga setiap laporan keuangan yang dihasilkan dapat dipercaya dan dipahami oleh semua pihak yang berkepentingan.

                        </p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('under') }}">Lihat Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="feature-item p-4 pt-0">
                        <div class="feature-icon p-4 mb-4">
                            <i class="fa fa-bullseye fa-3x"></i>
                        </div>
                        <h4 class="mb-4">Mudah Diakses </h4>
                        <p class="mb-4">Semua dokumen dan sumber daya PSak tersedia dalam satu platform yang mudah diakses kapan saja dan di mana saja, mendukung kebutuhan profesional Anda secara real-time.
                        </p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('under') }}">Lihat Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="feature-item p-4 pt-0">
                        <div class="feature-icon p-4 mb-4">
                            <i class="fa fa-headphones fa-3x"></i>
                        </div>
                        <h4 class="mb-4">Pembaruan Berkala</h4>
                        <p class="mb-4">PSAK selalu diperbarui dengan perkembangan terbaru dalam dunia akuntansi dan regulasi keuangan, memastikan Anda selalu selangkah lebih maju.<br><br>
                        </p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('under') }}">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

 <!-- FAQs Start -->
 <div class="container-fluid faq-section bg-light py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="h-100">
                    <div class="mb-5">
                        <h4 class="text-primary">Beberapa Pertanyaan Penting
                        </h4>
                        <h1 class="display-4 mb-0">Pertanyaan yang Sering Diajukan</h1>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Pertanyaan: Apa itu PSAK?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body rounded">
                                    Jawaban: PSAK (Pernyataan Standar Akuntansi Keuangan) adalah standar yang ditetapkan oleh Ikatan Akuntan Indonesia (IAI) yang mengatur bagaimana laporan keuangan harus disusun dan disajikan di Indonesia. PSak dirancang untuk memastikan transparansi, konsistensi, dan akurasi dalam pelaporan keuangan.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Pertanyaan:  Mengapa PSAK penting?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Jawaban: PSAK penting karena memastikan bahwa laporan keuangan yang dibuat oleh perusahaan di Indonesia mengikuti standar yang diakui secara nasional. Ini membantu dalam meningkatkan kepercayaan pemangku kepentingan, seperti investor, kreditur, dan pihak berwenang, terhadap informasi keuangan yang disajikan.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Pertanyaan: Siapa yang harus mematuhi PSAK?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Jawaban: PSAK berlaku untuk semua entitas yang beroperasi di Indonesia, termasuk perusahaan publik dan swasta, lembaga non-profit, serta entitas pemerintah. Setiap entitas yang diwajibkan untuk menyusun laporan keuangan harus mematuhi PSak.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                <img src="{{ asset('landing/img/carousel-2.png') }}" class="img-fluid w-100" alt="">
            </div>
        </div>
    </div>
</div>
<!-- FAQs End -->

<!-- Contact Start -->
<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Kontak Kami</h4>
            <h1 class="display-4 mb-4">Jika Anda memiliki pertanyaan jangan ragu untuk menghubungi kami.</h1>
        </div>
        <div class="row g-5">
            <div class="col-12">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                            </div>
                            <div>
                                <h4>Alamat</h4>
                                <p class="mb-0">Menara Kuningan 30th floor, Jl. H.R. Rasuna Said Kav.5.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fas fa-envelope fa-2x"></i>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <p class="mb-0">cs@pramatech.id</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fa fa-phone-alt fa-2x"></i>
                            </div>
                            <div>
                                <h4>Telephone</h4>
                                <p class="mb-0">+62 21 2949 0560</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fa fa-mobile fa-2x"></i>
                            </div>
                            <div>
                                <h4>Mobile</h4>
                                <p class="mb-0">+62 856 151 2634</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="rounded">
                    <iframe class="rounded w-100"
                    style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19811.29817825043!2d106.83146492912765!3d-6.213291566056866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6e8e9307c79%3A0x73aa626d81fa6a9f!2sMenara%20Kuningan!5e0!3m2!1sen!2sid!4v1694555139190!5m2!1sen!2sid" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


@include('landing.layouts.footer')
