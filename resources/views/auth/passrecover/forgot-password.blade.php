<x-guest-layout>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6 text-center" style="color:#4a59a4!important;" >Olvidaste tu Contraseña?</h3>
                                    <p class="mb-0 text-center" style="color:#4a59a4!important;">Ingresa tu Correo Electrónico!</p>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger text-sm" role="alert">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                @if (session('status'))
                                    <div class="alert alert-info text-sm" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger text-sm" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="card-body">
                                    <form role="form" action="/forgot-password" method="POST">
                                        {{ csrf_field() }}
                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Email"
                                                aria-label="Email" id="email" name="email"
                                                value="{{ old('email') }}" required autofocus>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="my-4 mb-2 btn btn-dark btn-lg w-100" style="background-color:#84be51!important; border-color:#84be51; " >Recuperar mi contraseña</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                style="background-image:url('../assets/img/logoVertical.png');background-position:center; background-size:100%; background-repeat: no-repeat; ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>
