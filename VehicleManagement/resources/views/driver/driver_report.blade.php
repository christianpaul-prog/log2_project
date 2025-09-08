@extends('layouts.app')
@section('title', 'Drivers Reports')
@section('content')
<div class="container-fluid slide-up mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fa-solid fa-id-card-clip"></i> Driver Reports</h2>
        <a href="#" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Driver
        </a>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th><i class="fa-solid fa-user"></i> Name</th>
                            <th><i class="fa-solid fa-id-card"></i> License No.</th>
                            <th><i class="fa-solid fa-phone"></i> Contact</th>
                            <th><i class="fa-solid fa-road"></i> Trips Completed</th>
                            <th><i class="fa-solid fa-star"></i> Rating</th>
                            <th><i class="fa-solid fa-gear"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Juan Dela Cruz</td>
                            <td>DL-12345</td>
                            <td>0917-123-4567</td>
                            <td>120</td>
                            <td><span class="badge bg-success">4.8 ★</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pedro Santos</td>
                            <td>DL-67890</td>
                            <td>0918-555-1111</td>
                            <td>85</td>
                            <td><span class="badge bg-success">4.2 ★</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Maria Lopez</td>
                            <td>DL-44556</td>
                            <td>0920-222-3333</td>
                            <td>60</td>
                            <td><span class="badge bg-warning text-dark">3.9 ★</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection