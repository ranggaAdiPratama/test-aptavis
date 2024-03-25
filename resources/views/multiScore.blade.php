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
                    <form id="form">
                        <input type="hidden" name="mode" value="multiple">
                        <div class="row">
                            <div class="col-3 form-group">
                                <label for="club_11">Klub 1</label>
                                <select name="club_1[]" id="club_11" class="form-control">
                                    <option value="" selected disabled>Pilih Klub 1</option>
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <label for="club_21">Klub 2</label>
                                <select name="club_2[]" id="club_21" class="form-control">
                                    <option value="" selected disabled>Pilih Klub 2</option>
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <label for="score_11">Score 1</label>
                                <input type="number" id="score_11" class="form-control" value="0" name="score_1[]"
                                    min="0" autocomplete="off">
                            </div>
                            <div class="col-3 form-group">
                                <label for="score_21">Score 2</label>
                                <input type="number" id="score_21" name="score_2[]" class="form-control" value="0"
                                    min="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 form-group">
                                <label for="club_12">Klub 1</label>
                                <select name="club_1[]" id="club_12" class="form-control">
                                    <option value="" selected disabled>Pilih Klub 1</option>
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <label for="club_22">Klub 2</label>
                                <select name="club_2[]" id="club_22" class="form-control">
                                    <option value="" selected disabled>Pilih Klub 2</option>
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <label for="score_12">Score 1</label>
                                <input type="number" id="score_12" class="form-control" value="0" name="score_1[]"
                                    min="0" autocomplete="off">
                            </div>
                            <div class="col-3 form-group">
                                <label for="score_22">Score 2</label>
                                <input type="number" id="score_22" name="score_2[]" class="form-control" value="0"
                                    min="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3" id="createMultipleScoreContainer">
                            <div class="col-12">
                                <div class="btn-group float-end mb-2">
                                    <div id="buttonAddScore">
                                        <button type='button' class="create_add_score btn_xs btn btn-primary">
                                            <i class="bx bx-plus me-0"></i>
                                            Tambah Score
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 score_wrap" id="create_score_wrap">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary float-right" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection

@push('script')
    @include($script)
    @include('components.scripts.basic.sweetAlert')
@endpush
