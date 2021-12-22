@extends('layouts.app')

@section('content')
    <!-- HERO -->
    <section class="hero d-flex flex-column justify-content-center align-items-center" id="home">

            <div class="bg-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-md-10 mx-auto col-12">
                        <div class="hero-text mt-5 text-center">

                            <h6 data-aos="fade-up" data-aos-delay="300">nova forma de construir um estilo de vida saudável</h6>

                            <h1 class="text-white" data-aos="fade-up" data-aos-delay="500">Nossa luta é manter seu corpo em dia</h1>
                            
                            @auth
                                <a href="#controles" class="btn custom-btn mt-3" data-aos="fade-up" data-aos-delay="600">Meus treinos</a>
                            @else 
                                <a href="#feature" class="btn custom-btn mt-3" data-aos="fade-up" data-aos-delay="600">Comece agora</a>

                                <a href="#" data-toggle="modal" data-target="#modalLogin" class="btn custom-btn bordered mt-3" data-aos="fade-up" data-aos-delay="700">Sou membro</a>
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
    </section>

    @auth
        @if(Auth::user()->user_type == 'teacher')<!-- Se tipo de usuário for igual a professor exbimos as opções administrativas para o mesmo -->
            <section class="schedule section" id="controles">
                <div class="container">
                    <div class="row">
    
                        <div class="col-lg-12 col-12 text-center">
                            <h6 data-aos="fade-up">nossos horários semanais</h6>
    
                            <h2 class="text-white" data-aos="fade-up" data-aos-delay="200">Horário de treino</h2>
                        </div>
    
                        <div class="col-lg-12 py-5 col-md-12 col-12">
                            <table class="table table-bordered table-responsive schedule-table" data-aos="fade-up" data-aos-delay="300">
    
                                <thead class="thead-light">
                                    <th>
                                        <i class="fa fa-calendar"></i>
                                    </th>
                                    <th>Horário</th>
                                    <th>Aula</th>
                                    <th>Professor</th>
                                    <th>Max. Alunos</th>
                                    <th>Fizeram check-in</th>
                                    <th>Disponibilidade</th>
                                </thead>
    
                                <!-- Lista calendário de treinos -->
                                <tbody>
                                    <tr>
                                        <td><small>01/01/22</small></td>
                                        <td>
                                            <span>8:00 am - 9:00 am</span>
                                        </td>
                                        <td>
                                            <strong>Karatê Fit</strong>
                                        </td>
                                        <td>
                                            <strong>Jorge</strong>
                                        </td>
                                        <td>
                                            <strong>20</strong>
                                        </td>
                                        <td>
                                            <strong>10</strong>
                                        </td>
                                        <td>
                                            <strong>Reservar</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        @else <!-- Se tipo de usuário for igual a aluno exbimos as opções de interações com as aulas e listagem de aulas do aluno -->
            <section class="schedule section" id="controles">
                <div class="container">
                    <div class="container">
                        <div class="row">
        
                            <div class="col-lg-12 col-12 text-center">
                                <h6 data-aos="fade-up">nossos horários semanais</h6>
        
                                <h2 class="text-white" data-aos="fade-up" data-aos-delay="200">Horário de treino</h2>
                            </div>
        
                            <div class="col-lg-12 py-5 col-md-12 col-12">
                                <table class="table table-bordered table-responsive schedule-table" data-aos="fade-up" data-aos-delay="300">
        
                                    <thead class="thead-light">
                                        <th>
                                            <i class="fa fa-calendar"></i>
                                        </th>
                                        <th>Horário</th>
                                        <th>Aula</th>
                                        <th>Professor</th>
                                        <th>Max. Alunos</th>
                                        <th>Fizeram check-in</th>
                                        <th>Disponibilidade</th>
                                    </thead>
        
                                    <!-- Lista calendário de treinos -->
                                    <tbody>
                                        <tr>
                                            <td><small>01/01/22</small></td>
                                            <td>
                                                <span>8:00 am - 9:00 am</span>
                                            </td>
                                            <td>
                                                <strong>Karatê Fit</strong>
                                            </td>
                                            <td>
                                                <strong>Jorge</strong>
                                            </td>
                                            <td>
                                                <strong>20</strong>
                                            </td>
                                            <td>
                                                <strong>10</strong>
                                            </td>
                                            <td>
                                                <strong>Reservar</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @else <!-- SEM USÚARIO LOGADO ENTÃO OFERECEMOS A LANDING-PAGE -->
        <section class="feature" id="feature">
            <div class="container">
                <div class="row">
                    <div class="d-flex flex-column justify-content-center ml-lg-auto mr-lg-5 col-lg-5 col-md-6 col-12">
                        <h2 class="mb-3 text-white" data-aos="fade-up">Novo na karate system?</h2>

                        <h6 class="mb-4 text-white" data-aos="fade-up">Torne-se membro e ganhe uma semana de aulas experimentais</h6>

                        <p data-aos="fade-up" data-aos-delay="200">Nosso objetivo é disseminar a cultura do karatê pelo mundo.</p>

                        <a href="#" class="btn custom-btn bg-color mt-3" data-aos="fade-up" data-aos-delay="300" data-toggle="modal" data-target="#membershipForm">Torne-se membro agora</a>
                    </div>

                    <div class="mr-lg-auto mt-3 col-lg-4 col-md-6 col-12">
                        <div class="about-working-hours">
                            <div>

                                <h2 class="mb-4 text-white" data-aos="fade-up" data-aos-delay="500">Próximas aulas</h2>

                                <!-- LISTA 3 aulas MAIS PRÓXIMAS -->
                                <strong class="d-block" data-aos="fade-up" data-aos-delay="600">Sunday : Closed</strong>

                                <strong class="mt-3 d-block" data-aos="fade-up" data-aos-delay="700">Monday - Friday</strong>

                                <p data-aos="fade-up" data-aos-delay="800">7:00 AM - 10:00 PM</p>

                                <strong class="mt-3 d-block" data-aos="fade-up" data-aos-delay="700">Saturday</strong>

                                <p data-aos="fade-up" data-aos-delay="800">6:00 AM - 4:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ABOUT -->
        <section class="about section" id="about">
            <div class="container">
                <div class="row">
                    <div class="mt-lg-5 mb-lg-0 mb-4 col-lg-5 col-md-10 mx-auto col-12">
                        <h2 class="mb-4" data-aos="fade-up" data-aos-delay="300">Olá, somos a Karatê System</h2>

                        <p data-aos="fade-up" data-aos-delay="400">Uma nova fórmula divertida e inspiradora de manter seu corpo, saúde e defesa pessoal em dia por meio do Karatê.</p>
                        <p data-aos="fade-up" data-aos-delay="400">Venha fazer parte da academia de karatê que mais cresce no mundo.</p>

                    </div>

                    <!-- LISTA DOIS PROFESSORES ALEATÓRIAMENTE -->
                    <div class="ml-lg-auto col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="700">
                        <div class="team-thumb">
                            <img src="images/team/team-image.jpg" class="img-fluid" alt="Trainer">

                            <div class="team-info d-flex flex-column">

                                <h3>Mary Yan</h3>
                                <span>Yoga Instructor</span>

                                <ul class="social-icon mt-3">
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mr-lg-auto mt-5 mt-lg-0 mt-md-0 col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="800">
                        <div class="team-thumb">
                            <img src="images/team/team-image01.jpg" class="img-fluid" alt="Trainer">

                            <div class="team-info d-flex flex-column">

                                <h3>Catherina</h3>
                                <span>Body trainer</span>

                                <ul class="social-icon mt-3">
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- SCHEDULE -->
        <section class="schedule section" id="schedule">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 text-center">
                        <h6 data-aos="fade-up">nossos horários semanais</h6>

                        <h2 class="text-white" data-aos="fade-up" data-aos-delay="200">Horário de treino</h2>
                    </div>

                    <div class="col-lg-12 py-5 col-md-12 col-12">
                        <table class="table table-bordered table-responsive schedule-table" data-aos="fade-up" data-aos-delay="300">

                            <thead class="thead-light">
                                <th>
                                    <i class="fa fa-calendar"></i>
                                </th>
                                <th>Horário</th>
                                <th>Aula</th>
                                <th>Professor</th>
                                <th>Max. Alunos</th>
                                <th>Fizeram check-in</th>
                                <th>Disponibilidade</th>
                            </thead>

                            <!-- Lista calendário de treinos -->
                            <tbody>
                                <tr>
                                    <td><small>01/01/22</small></td>
                                    <td>
                                        <span>8:00 am - 9:00 am</span>
                                    </td>
                                    <td>
                                        <strong>Karatê Fit</strong>
                                    </td>
                                    <td>
                                        <strong>Jorge</strong>
                                    </td>
                                    <td>
                                        <strong>20</strong>
                                    </td>
                                    <td>
                                        <strong>10</strong>
                                    </td>
                                    <td>
                                        <strong>Reservar</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>


        <!-- CONTACT -->
        <section class="contact section" id="contact">
            <div class="container">
                <div class="row">

                    <div class="ml-auto col-lg-5 col-md-6 col-12">
                        <h2 class="mb-4 pb-2" data-aos="fade-up" data-aos-delay="200">Entre em contato</h2>

                        <form action="#" method="post" class="contact-form webform" data-aos="fade-up" data-aos-delay="400" role="form">
                            <input type="text" class="form-control" name="cf-name" placeholder="Nome">

                            <input type="email" class="form-control" name="cf-email" placeholder="Email">

                            <textarea class="form-control" rows="5" name="cf-message" placeholder="Mensagem"></textarea>

                            <button type="submit" class="form-control" id="submit-button" name="submit">Enviar</button>
                        </form>
                    </div>

                    <div class="mx-auto mt-4 mt-lg-0 mt-md-0 col-lg-5 col-md-6 col-12">
                        <h2 class="mb-4" data-aos="fade-up" data-aos-delay="600">Onde estamos</h2>

                        <p data-aos="fade-up" data-aos-delay="800"><i class="fa fa-map-marker mr-1"></i> 37470-000 São Lourenço - Estado de Minas Gerais, Brasil</p>

                        <div class="google-map" data-aos="fade-up" data-aos-delay="900">
                        <iframe src="https://maps.google.com/maps?q=Av.+Lúcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed" width="1920" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                    </div>
                        
                </div>
            </div>
        </section>
    @endauth

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">

                    <div class="ml-auto col-lg-4 col-md-5">
                        <p class="copyright-text">Copyright &copy; 2021 Karatê System.
                        
                        <br>Design: <a href="https://www.linkedin.com/company/my-system-labs/">My System Labs</a></p>
                    </div>

                    <div class="d-flex justify-content-center mx-auto col-lg-5 col-md-7 col-12">
                        <p class="mr-4">
                            <i class="fa fa-envelope-o mr-1"></i>
                            <a href="#">pedrozwpiper@gmail.com</a>
                        </p>

                        <p><i class="fa fa-phone mr-1"></i> (35)9 9867-5272</p>
                    </div>
                    
            </div>
        </div>
    </footer>

    <!-- Modal Registro -->
    <div class="modal fade" id="membershipForm" tabindex="-1" role="dialog" aria-labelledby="membershipFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">

                    <h2 class="modal-title" id="membershipFormLabel">Registrar</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- NOME DO ALUNO -->
                        <div class="row mb-12">
                            <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Name') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- EMAIL PARA LOGIN -->
                        <div class="row mb-12">
                            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- IDADE -->
                        <div class="row mb-12">
                            <label for="age" class="col-md-12 col-form-label text-md-left">{{ __('Idade') }}</label>

                            <div class="col-md-12">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Gênero -->
                        <div class="row mb-12">
                            <label for="gender" class="col-md-12 col-form-label text-md-left">{{ __('Gênero') }}</label>

                            <div class="col-md-12">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required>
                                    <option value="male">Masculino</option>
                                    <option value="female">Feminino</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- GRADUAÇÃO NA ARTE MARCIAL -->
                        <div class="row mb-12">
                            <label for="graduate" class="col-md-12 col-form-label text-md-left">{{ __('Graduação') }}</label>

                            <div class="col-md-12">
                                <input id="graduate" type="text" class="form-control @error('graduate') is-invalid @enderror" name="graduate" value="{{ old('graduate') }}" required autocomplete="graduate">

                                @error('graduate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-12">
                            <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-12">
                            <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer"></div>

            </div>
        </div>
    </div>

    <!-- Modal Login -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">

                    <h2 class="modal-title" id="modalLoginLabel">Entrar</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-12">
                            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-12">
                            <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-12">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer"></div>

            </div>
        </div>
    </div>
@endsection
