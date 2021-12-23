@extends('layouts.app')

@section('content')
    <!-- HERO -->
    <section class="hero d-flex flex-column justify-content-center align-items-center" id="home">
        @auth
            @if(Auth::user()->user_type == 'teacher')<!-- Se tipo de usuário for igual a professor exbimos as opções administrativas para o mesmo -->
                <div class="bg-overlay"></div>

                <div class="container">
                    <div class="row">
        
                        <div class="col-lg-12 col-12 text-center">
                            <h6 data-aos="fade-up">alguns dos seus alunos</h6>

                            <h2 class="text-white" data-aos="fade-up" data-aos-delay="200">Alunos confirmados no treino</h2>
                            
                            <a class="btn btn-primary" data-aos="fade-up" data-aos-delay="200" href="/home">
                                Voltar
                            </a>
                        </div>
                
                        <div class="col-lg-12 py-5 col-md-12 col-12">
                            <table class="table table-bordered table-responsive schedule-table" data-aos="fade-up" data-aos-delay="300">

                                <thead class="thead-light">
                                    <th>Nome</th>
                                    <th>Contato</th>
                                    <th>Idade</th>
                                    <th>Genêro</th>
                                    <th>Graduação</th>
                                </thead>

                                <!-- Lista calendário de treinos -->
                                <tbody>
                                    @foreach ($students as $item)
                                        @foreach($item['users'] as $student)
                                            <tr>      
                                                <td><small>{{$student->name}}</small></td>
                                                <td>
                                                    <span>{{$student->email}}</span>
                                                </td>
                                                <td>
                                                    <strong>{{$student->age}}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{$student->gender}}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{$student->graduate}}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </section>
        
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