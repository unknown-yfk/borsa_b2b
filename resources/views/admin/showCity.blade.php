@extends('layouts.mainlayout')
@section('content')
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List of Cities</h4>

                        <p class="card-description">
                            <code>Cities</code>
                        </p>
                        <div class="table-responsive pt-3">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Region</th>
                                        <th>Action</th>
                                    </tr>
                                <tbody id="result">
                                    @if (!empty($city) && $city->count())
                                        @foreach ($city as $cities)
                                            <tr>
                                                <td>{{ $cities->id }}</td>
                                                <td>{{ $cities->name }}</td>
                                                <td>{{ $cities->region }}</td>
                                                <td>
                                                    <a href="{{ url('admin/edit/city', $cities->id) }}">
                                                        <button class="btn btn-outline-success">
                                                            {{ __('Edit') }}
                                                        </button>
                                                    </a>
                                                </td>


                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
