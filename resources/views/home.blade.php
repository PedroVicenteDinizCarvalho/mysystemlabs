@extends('layouts.user')

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
                            <h6 data-aos="fade-up">Olá professor</h6>
    
                            <h2 class="text-white" data-aos="fade-up" data-aos-delay="200">Controle suas aulas</h2>

                            <button class="btn btn-primary" data-aos="fade-up" data-aos-delay="200" data-toggle="modal" data-target="#modalRegisterTraining">
                                Cadastrar Aula
                            </button>

                            <!-- Modal Cadastrar Treino -->
                            <div class="modal fade" id="modalRegisterTraining" tabindex="-1" role="dialog" aria-labelledby="modalRegisterLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">

                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h2 class="modal-title" id="modalRegisterLabel">Cadastrar treino</h2>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('criar_treino') }}">
                                                @csrf
                                                <input type="hidden" name="teacher_name" value="{{Auth::user()->name}}">
                                                <input type="hidden" name="teacher_id" value="{{Auth::user()->id}}">

                                                <div class="row mb-12">
                                                    <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Nome do Treino') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-12">
                                                    <label for="maximum_students" class="col-md-12 col-form-label text-md-left">{{ __('Número máximo de alunos') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="maximum_students" type="number" class="form-control @error('maximum_students') is-invalid @enderror" name="maximum_students" value="{{ old('maximum_students') }}" required autocomplete="maximum_students">

                                                        @error('maximum_students')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-12">
                                                    <label for="date_and_time" class="col-md-12 col-form-label text-md-left">{{ __('Inicio da aula') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="date_and_time" type="datetime-local" class="form-control @error('date_and_time') is-invalid @enderror" name="date_and_time" value="{{ old('date_and_time') }}" required autocomplete="date_and_time">

                                                        @error('date_and_time')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-12">
                                                    <label for="end_training" class="col-md-12 col-form-label text-md-left">{{ __('Final da Aula') }}</label>

                                                    <div class="col-md-12">
                                                        <input id="end_training" type="datetime-local" class="form-control @error('end_training') is-invalid @enderror" name="end_training" value="{{ old('end_training') }}" required autocomplete="end_training">

                                                        @error('end_training')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-0">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Salvar') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer"></div>
                                    </div>
                                </div>
                            </div> <!-- / Modal cadastro de treino -->
                        </div> 
    
                        <div class="col-lg-12 py-5 col-md-12 col-12">
                            <table class="table table-bordered table-responsive schedule-table" data-aos="fade-up" data-aos-delay="300">
    
                                <thead class="thead-light">
                                    <th>
                                        <i class="fa fa-calendar"></i>
                                    </th>
                                    <th>Horário</th>
                                    <th>Nome</th>
                                    <th>Max. Alunos</th>
                                    <th>Fizeram check-in</th>
                                    <th>Detalhe</th>
                                    <th>Editar</th>
                                    <th>Deletar</th>
                                </thead>
    
                                <!-- Lista calendário de treinos -->
                                <tbody>
                                    @foreach ($teachertraining as $item)
                                        <tr>
                                            <td><small>{{ date( 'd/m/Y', strtotime($item->date_and_time)) }}</small></td>
                                            <td>
                                                <span>{{ date( 'H:i', strtotime($item->date_and_time)) }} - {{ date( 'H:i', strtotime($item->end_training)) }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $item->name }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $item->maximum_students }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $item->total_students }}</strong>
                                            </td>

                                            <!-- Ações do professor sobre seus treinos -->
                                            <td>
                                                <a href="{{route('treino_usuarios', ['id' => $item->id])}}">
                                                    <strong><i class="fa fa-users"></i></strong>
                                                </a> 
                                            </td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#modalEditTraining{{$item->id}}">
                                                    <strong><i class="fa fa-cog"></i></strong>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#modalDeleteTraining{{$item->id}}">
                                                    <strong><i class="fa fa-trash"></i></strong>
                                                </a>
                                            </td>
                                        </tr> 

                                        <!-- Modal Editar Treino -->
                                        <div class="modal fade" id="modalEditTraining{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h2 class="modal-title" id="modalEditLabel">Editar treino</h2>

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('editar_treino', ['id' => $item->id]) }}">
                                                            @csrf
                                                            <input type="hidden" name="teacher_name" value="{{Auth::user()->name}}">
                                                            <input type="hidden" name="teacher_id" value="{{Auth::user()->id}}">

                                                            <div class="row mb-12">
                                                                <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Nome do Treino') }}</label>

                                                                <div class="col-md-12">
                                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$item->name}}" required autocomplete="name" autofocus>

                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-12">
                                                                <label for="maximum_students" class="col-md-12 col-form-label text-md-left">{{ __('Número máximo de alunos') }}</label>

                                                                <div class="col-md-12">
                                                                    <input id="maximum_students" type="number" class="form-control @error('maximum_students') is-invalid @enderror" name="maximum_students" value="{{$item->maximum_students}}" required autocomplete="maximum_students">

                                                                    @error('maximum_students')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-12">
                                                                <label for="date_and_time" class="col-md-12 col-form-label text-md-left">{{ __('Inicio da aula') }}</label>

                                                                <div class="col-md-12">
                                                                    <input id="date_and_time" type="datetime-local" class="form-control @error('date_and_time') is-invalid @enderror" name="date_and_time" value="{{ str_replace(' ','T', $item->date_and_time) }}" required autocomplete="date_and_time">

                                                                    @error('date_and_time')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-12">
                                                                <label for="end_training" class="col-md-12 col-form-label text-md-left">{{ __('Final da Aula') }}</label>

                                                                <div class="col-md-12">
                                                                    <input id="end_training" type="datetime-local" class="form-control @error('end_training') is-invalid @enderror" name="end_training" value="{{ str_replace(' ','T', $item->end_training) }}" required autocomplete="end_training">

                                                                    @error('end_training')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-0">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Salvar') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="modal-footer"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Excluir Treino -->
                                        <div class="modal fade" id="modalDeleteTraining{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h2 class="modal-title" id="modalDeleteLabel">Excluir treino</h2>
                                                        
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <h3>Tem certeza de que deseja cancelar o treino ?</h3>
                                                        
                                                        <a href="{{ route('excluir_treino', ['id' => $item->id]) }}" class="btn btn-danger">{{ __('Cancelar Treino') }}</a>
                                                    </div>

                                                    <div class="modal-footer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                        <!-- AULAS RESERVADAS PELO ALUNO -->
                        <div class="row">
        
                            <div class="col-lg-12 col-12 text-center">
                                <h6 data-aos="fade-up">treinos reservados</h6>
                                <h2 class="text-white" data-aos="fade-up" data-aos-delay="200">Sua agenda</h2>
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
                                        <th>Fizeram Check-in</th>
                                        <th>Desistir da Aula</th>
                                    </thead>
        
                                    <!-- Lista calendário de treinos com check-in do usuário -->
                                    <tbody>
                                        @foreach ($studentTraining as $item)
                                            <tr>
                                                <td><small>{{ date( 'd/m/Y', strtotime($item->date_and_time)) }}</small></td>
                                                <td>
                                                    <span>{{ date( 'H:i', strtotime($item->date_and_time)) }} - {{ date( 'H:i', strtotime($item->end_training)) }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->name }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->teacher_name }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->maximum_students }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ count($item->users) }}</strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('cancelar_treino', ['id' => $item->id]) }}" class="btn btn-sucess">
                                                        <strong>Cancelar</strong>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- AULAS DO DIA ATUAL -->
                        <div class="row">
        
                            <div class="col-lg-12 col-12 text-center">
                                <h6 data-aos="fade-up">vamos treinar hoje?</h6>
                                <h2 class="text-white" data-aos="fade-up" data-aos-delay="200">Próximos horários</h2>
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
                                        <th>Vagas restantes</th>
                                        <th>Disponibilidade</th>
                                    </thead>
        
                                    <!-- Lista calendário de treinos da  -->
                                    <tbody>
                                        @foreach ($trainingToday as $item)
                                            <tr>
                                                <td><small>{{ date( 'd/m/Y', strtotime($item->date_and_time)) }}</small></td>
                                                <td>
                                                    <span>{{ date( 'H:i', strtotime($item->date_and_time)) }} - {{ date( 'H:i', strtotime($item->end_training)) }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->name }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->teacher_name }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->maximum_students }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->total_students }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->maximum_students - $item->total_students }}</strong>
                                                </td>
                                                @if($item->maximum_students > $item->total_students)
                                                    <td>
                                                        <a href="{{ route('reservar_treino', ['id' => $item->id]) }}" class="btn btn-sucess">
                                                            <strong>Reservar</strong>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <strong>Sem Vagas</strong>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- AULAS Do MÊS ATUAL -->
                        <div class="row">
        
                            <div class="col-lg-12 col-12 text-center">
                                <h6 data-aos="fade-up">vamos treinar este mês?</h6>
                                <h2 class="text-white" data-aos="fade-up" data-aos-delay="200">Próximas aulas neste mês</h2>
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
                                        <th>Vagas restantes</th>
                                        <th>Disponibilidade</th>
                                    </thead>
        
                                    <!-- Lista calendário de treinos da  -->
                                    <tbody>
                                        @foreach ($trainingWeek as $item)
                                            <tr>
                                                <td><small>{{ date( 'd/m/Y', strtotime($item->date_and_time)) }}</small></td>
                                                <td>
                                                    <span>{{ date( 'H:i', strtotime($item->date_and_time)) }} - {{ date( 'H:i', strtotime($item->end_training)) }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->name }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->teacher_name }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->maximum_students }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->total_students }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->maximum_students - $item->total_students }}</strong>
                                                </td>
                                                @if($item->maximum_students > $item->total_students)
                                                    <td>
                                                        <a href="{{ route('reservar_treino', ['id' => $item->id]) }}" class="btn btn-sucess">
                                                            <strong>Reservar</strong>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <strong>Sem Vagas</strong>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @else <!-- SEM USÚARIO LOGADO ENTÃO OFERECEMOS A LANDING-PAGE -->
        
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