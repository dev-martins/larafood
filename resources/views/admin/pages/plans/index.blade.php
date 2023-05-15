@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
<h1>Planos </h1>
@stop

@php
$heads = [
'ID',
['label' => 'Nome', 'width' => 40],
['label' => 'Preço', 'no-export' => true, 'width' => 25],
['label' => 'Ações', 'no-export' => true, 'width' => 5],
];
@endphp

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>

        <a href="{{route('plans.create')}}" class="btn btn-primary">+</a>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th width="270">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                <tr>
                    <td>
                        {{ $plan->name }}
                    </td>
                    <td>
                        R$ {{ number_format($plan->price, 2, ',', '.') }}
                    </td>
                    <td style="width=10px;">
                        <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-primary">Detalhes</a>
                        <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">VER</a>
                        <a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-warning"><i class="fas fa-address-book"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">

        {!! $plans->links() !!}
        
    </div>
</div>

@stop
