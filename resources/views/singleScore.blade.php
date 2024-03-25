@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header"></section>

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('/scores') }}" method="post">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {{ session('success') }}
                            </div>
                        @endif
                        @error('error')
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                {{ $message }}
                            </div>
                        @enderror
                        @csrf
                        <input type="hidden" name="mode" value="single">
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="club_1">Klub 1</label>
                                <select name="club_1" id="club_1" class="form-control">
                                    @if (old('club_1'))
                                        <option value="" disabled>Pilih Klub 1</option>
                                        @foreach ($clubs as $club)
                                            <option value="{{ $club->id }}"
                                                {{ $club->id == old('club_1') ? 'selected' : null }}>{{ $club->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" selected disabled>Pilih Klub 1</option>
                                        @foreach ($clubs as $club)
                                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('club_1')
                                    <div class="text-danger" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <label for="club_2">Klub 2</label>
                                <select name="club_2" id="club_2" class="form-control">
                                    @if (old('club_2'))
                                        <option value="" disabled>Pilih Klub 1</option>
                                        @foreach ($clubs as $club)
                                            <option value="{{ $club->id }}"
                                                {{ $club->id == old('club_2') ? 'selected' : null }}>{{ $club->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" selected disabled>Pilih Klub 1</option>
                                        @foreach ($clubs as $club)
                                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('club_2')
                                    <div class="text-danger" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <label for="score_1">Score 1</label>
                                <input type="number" id="score_1" class="form-control" value="{{ old('score_1') ?? 0 }}"
                                    name="score_1" min="0" autocomplete="off">
                            </div>
                            <div class="col-6 form-group">
                                <label for="score_2">Score 2</label>
                                <input type="number" id="score_2" name="score_2" class="form-control"
                                    value="{{ old('score_2') ?? 0 }}" min="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
