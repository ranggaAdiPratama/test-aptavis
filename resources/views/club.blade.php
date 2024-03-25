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
                    <form action="{{ url('/clubs') }}" method="post">
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
                        <div class="form-group">
                            <label for="name">Nama Klub</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control" autocomplete="off">
                            @error('name')
                                <div class="text-danger" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">Kota Klub</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}"
                                class="form-control" autocomplete="off">
                            @error('city')
                                <div class="text-danger" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
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
