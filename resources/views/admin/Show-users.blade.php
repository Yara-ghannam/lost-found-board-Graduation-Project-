@extends('layout.master')
@section('content')
<div class="container mt-5">

<!--Admins-->
<div class="card shadow-sm mt-5">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Admin List</h5>
    </div>

    <div class="card-body">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($admins as $ads)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $ads->name }}</td>
                        <td>{{ $ads->email }}</td>
                        <td>{{ $ads->phone }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $ads->role }}</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <button class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye me-1"></i> View
                                    </button>

                                    <form action="{{ route('users.delete', $ads->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--Users-->
<div class="card shadow-sm mt-5">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">User List</h5>
    </div>

    <div class="card-body">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $u)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $u->role }}</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <button class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye me-1"></i> View
                                    </button>

                                    <form action="{{ route('users.delete', $u->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


</div>
@endsection
