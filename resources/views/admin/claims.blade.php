@extends('layout.master')

@section('content')
    <div class="container py-4">

        <h3 class="mb-4">
            <i class="fas fa-clipboard-check text-primary me-2"></i>
            Claims Management
        </h3>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">

                <table class="table table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Owner</th>
                            <th>Claimer</th>

                            <th>Item/Post Data</th>
                            <th>Claim Data</th>
                            <th>Item Location</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($claims as $index => $claim)
                            <tr>
                                <!-- ID -->
                                <td>{{ $claim->id }}</td>



                                <!-- Owner Info -->
                                <td class="text-start">
                                    <strong>{{ $claim->post->user->name }}</strong><br>
                                    <small class="text-muted">{{ $claim->post->user->email }}</small><br>
                                    <small class="text-muted">{{ $claim->post->user->phone }}</small>
                                </td>

                                <!-- Claimer Info -->
                                <td class="text-start">
                                    <strong>{{ $claim->user->name }}</strong><br>
                                    <small class="text-muted">{{ $claim->user->email }}</small><br>
                                    <small class="text-muted">{{ $claim->user->phone }}</small>
                                </td>

                                <!-- Item and Post Data -->
                                <td class="text-start">
                                    <strong>Title:</strong><small> {{ $claim->post->item->title }}</small><br>
                                    <strong>Description:</strong><small>
                                        {{ Str::limit($claim->post->item->description, 50) }}
                                    </small><br>
                                    <strong>Color:</strong><small> {{ $claim->post->item->color ?? 'N/A' }}</small><br>
                                    <strong>Brand:</strong><small> {{ $claim->post->item->brand ?? 'N/A' }}</small><br>
                                    <strong>Serial_or_mark:</strong><small>
                                        {{ $claim->post->item->serial_or_mark ?? 'N/A' }}</small><br>

                                </td>
                                <td class="text-start">
                                    <strong>Description:</strong>
                                    <small>{{ $claim->claim_data['description'] ?? 'N/A' }}</small><br>
                                    <strong>Color:</strong> <small>{{ $claim->claim_data['color'] ?? 'N/A' }}</small><br>
                                    <strong>Brand:</strong> <small>{{ $claim->claim_data['brand'] ?? 'N/A' }}</small><br>
                                    <strong>Serial_or_mark:<small>
                                    </strong>{{ $claim->claim_data['serial_or_mark'] ?? 'N/A' }}</small><br>

                                </td>
                                <!-- Location -->
                                <td class="text-start">
                                    <strong>Campus:</strong> {{ $claim->post->location->campus ?? 'N/A' }}<br>
                                    <strong>Building:</strong> {{ $claim->post->location->building ?? 'N/A' }}<br>
                                    <strong>Room:</strong> {{ $claim->post->location->room ?? 'N/A' }}
                                </td>


                                <!-- Status -->
                                <td>
                                    @if ($claim->verification_status == 'pending_admin')
                                        <span class="badge bg-warning">pending_admin</span>
                                    @elseif($claim->verification_status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>

                                <td>{{$claim->created_at}}</td>
                                <!-- Actions -->
                                <td>
                                    @if ($claim->verification_status == 'pending_admin')
                                        <div class="d-flex justify-content-center gap-2">

                                            <form
                                                action="{{ route('admin.claims.approve', [$claim->id, $claim->user_id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <form
                                                action="{{ route('admin.claims.reject', [$claim->id, $claim->user_id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>


                                        </div>
                                    @else
                                        <span class="text-muted">No Actions</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted py-4">
                                    No claims found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
