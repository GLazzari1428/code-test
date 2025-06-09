@extends('layouts.main')
@section('title', 'Rusky Vet - A saúde do seu cão em primeiro lugar')
@section('content')
    <section class="py-6 border-bottom">
        <div class="container text-center">
            <h1>Olá {{ explode(' ', trim(auth()->User()->name))[0] }}!</h1>

            <div class="row mt-6 justify-content-center">
                <div class="col-md-3">
                    <p>
                        <img src="{{ asset('images/dog.jpg') }}" class="round" width="100">
                    </p>
                    <p class="lead mt-4">Cadastrar cachorro</p>
                    <p>
                        {{-- A rota original 'client.edit-patient' não existe. A forma de criar um paciente é agendando a primeira consulta. --}}
                        <a class="btn btn-primary" href="{{ route('appointment.create') }}" role="button">Cadastrar</a>
                    </p>
                </div>
                <div class="col-md-3">
                    <p>
                        <img src="{{ asset('images/appointment.jpg') }}" class="round" width="100">
                    </p>
                    <p class="lead mt-4">Agendar consulta</p>
                    <p>
                        {{-- A rota original 'client.create-appointment' foi mapeada para 'appointment.create' --}}
                        <a class="btn btn-primary" href="{{ route('appointment.create') }}" role="button">Agendar</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 border-bottom">
        <div class="container text-center">
            <h3>Minhas consultas</h3>
            <div class="row mt-5 justify-content-center">
                <div class="col-12 col-lg-10">
                <table class="table" style="width: 100%">
                    <thead>
                        <tr>
                            {{-- Mantidos os cabeçalhos originais --}}
                            <th>Status</th>
                            <th>Nome do cachorro</th>
                            <th>Data da consulta</th>
                            <th>Horário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patients as $consulta)
                        <tr>
                            {{-- Como a coluna 'status' não existe na DB, um valor fixo é usado para manter o layout. --}}
                            <td>AGENDADA</td>
                            <td>{{ $consulta->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($consulta->date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($consulta->hour)->format('H:i') }}</td>
                            <td>
                                {{-- Botões de ação funcionais adicionados aqui --}}
                                <a href="{{ route('appointment.edit', $consulta->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="{{ route('appointment.destroy', $consulta->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem a certeza que deseja excluir esta consulta?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma consulta agendada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 border-bottom" id="meus-pacientes">
        <div class="container text-center">
            <h3>Meus cachorros</h3>
            <div class="row mt-5 justify-content-center">
                <div class="col-12 col-lg-10">
                    @if($patients->isEmpty())
                        Você não tem nenhum cachorro cadastrado.
                    @else
                        <table class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    {{-- Colunas adaptadas para os dados existentes: Nome e Espécie --}}
                                    <th>Nome</th>
                                    <th>Espécie</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Usando unique() para não repetir pacientes --}}
                                @foreach ($patients->unique('name') as $patient)
                                    <tr>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->species }}</td>
                                        <td>
                                            {{-- Ação de editar paciente adicionada --}}
                                            <a href="{{ route('patient.edit', $patient->id) }}" class="mx-2" title="Editar">✏️</a>
                                            {{-- A rota de remoção de paciente não foi pedida no README. O ícone é mantido mas sem ação para evitar erros. --}}
                                            <a href="#" class="mx-2" title="Remover" onclick="alert('Funcionalidade de remover paciente não implementada.'); return false;">❌</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
