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
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Klub</th>
                            <th>Ma</th>
                            <th>Me</th>
                            <th>S</th>
                            <th>K</th>
                            <th>GM</th>
                            <th>GK</th>
                            <th>Point</th>
                        </thead>
                        <tbody>
                            @if (count($results) > 0)
                                @for ($i = 0; $i < count($results); $i++)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $results[$i]['club'] }}</td>
                                        <td>{{ $results[$i]['ma'] }}</td>
                                        <td>{{ $results[$i]['me'] }}</td>
                                        <td>{{ $results[$i]['s'] }}</td>
                                        <td>{{ $results[$i]['k'] }}</td>
                                        <td>{{ $results[$i]['gm'] }}</td>
                                        <td>{{ $results[$i]['gk'] }}</td>
                                        <td>{{ $results[$i]['point'] }}</td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
