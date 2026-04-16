@extends('layout.master')
@section('content')
    <div class="container py-5">

        <!-- ========== Your Found Items ========== -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2><i class="fas fa-hand-holding text-success me-2"></i>Your Found Items</h2>
            </div>
        </div>




        <div class="row" id="foundItemsGrid">
            @if (!empty($foundItems) && count($foundItems) > 0)
                @foreach ($foundItems as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm item-card">
                            <img src="{{ $item->item->image_url }}" class="card-img-top"
                                style="object-fit: contain; width: 100%; height: 250px;" alt="Image">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $item->item->title }}</h5>
                                    <span class="badge bg-success">Found</span>
                                </div>

                                <p class="card-text text-muted small mb-2">
                                    <i class="fas fa-tag me-1"></i>{{ $item->item->category->name ?? 'Unknown' }}
                                </p>

                                <p class="card-text">{{ $item->item->description }}</p>

                                <p>
                                    @if (!empty($item->item->color))
                                        <strong>Color:</strong> {{ $item->item->color }} <br>
                                    @endif
                                    @if (!empty($item->item->brand))
                                        <strong>Brand:</strong> {{ $item->item->brand }} <br>
                                    @endif
                                    @if (!empty($item->item->serial_or_mark))
                                        <strong>Serial/Mark:</strong> {{ $item->item->serial_or_mark }}<br>
                                    @endif
                                </p>

                                <div class="text-muted small mb-2">
                                    <i class="fas fa-map-marker-alt me-1"></i>Found at {{ $item->location->campus }}
                                    @if (!empty($item->location->building))
                                        , {{ $item->location->building }}
                                    @endif
                                    @if (!empty($item->location->room))
                                        , {{ $item->location->room }}
                                    @endif
                                </div>

                                <div class="text-muted small mb-3">
                                    <i class="fas fa-calendar me-1"></i>Found on
                                    {{ date('F d, Y h:i A', strtotime($item->created_at)) }}
                                </div>

                                <div class="d-flex justify-content-between text-center gap-3">
                                    <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-primary w-50">Edit</a>
                                    <form action="{{ route('posts.delete', $item->id) }}" method="POST" class="w-50">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container text-center py-5">
                    <i class="fas fa-search text-muted display-1 mb-3"></i>
                    <h4 class="text-muted">No items found</h4>
                    <p class="text-muted">Try adjusting your search criteria or check back later.</p>
                    <a href="{{ route('report-found') }}" class="btn btn-success mt-3">
                        <i class="fas fa-plus me-2"></i>Report a Found Item
                    </a>
                </div>
            @endif
        </div>


        <hr>



        <!-- ========== Your Lost Items ========== -->


        <div class="row mb-4">
            <div class="col-lg-8">
                <h2><i class="fas fa-search-minus text-danger me-2"></i>Your Lost Items</h2>
            </div>
        </div>

        <div class="row" id="lostItemsGrid">
            @forelse ($lostItems as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm item-card">
                        <img src="{{ $item->item->image_url }}" class="card-img-top"
                            style="object-fit: contain; width: 100%; height: 250px;" alt="Image">

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $item->item->title }}</h5>
                                <span class="badge bg-danger">Lost</span>
                            </div>

                            <p class="card-text text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i>{{ $item->item->category->name ?? 'Unknown' }}
                            </p>

                            <p class="card-text">{{ $item->item->description }}</p>


                            <p>
                                @if (!empty($item->item->color))
                                    <strong>Color:</strong> {{ $item->item->color }} <br>
                                @endif

                                @if (!empty($item->item->brand))
                                    <strong>Brand:</strong> {{ $item->item->brand }} <br>
                                @endif

                                @if (!empty($item->item->serial_or_mark))
                                    <strong>Serial/Mark:</strong> {{ $item->item->serial_or_mark }}<br>
                                @endif
                            </p>


                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Lost at {{ $item->location->campus }}
                                @if (!empty($item->location->building))
                                    , {{ $item->location->building }}
                                @endif
                                @if (!empty($item->location->room))
                                    , {{ $item->location->room }}
                                @endif
                            </div>

                            <div class="text-muted small mb-3">
                                <i class="fas fa-calendar me-1"></i>Lost on
                                {{ date('F d, Y h:i A', strtotime($item->created_at)) }}
                            </div>

                            <div class="d-flex justify-content-between text-center gap-3">
                                <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-primary w-50">Edit</a>
                                <form action="{{ route('posts.delete', $item->id) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="container text-center py-5">
                    <i class="fas fa-search text-muted display-1 mb-3"></i>
                    <h4 class="text-muted">No Lost Items Found</h4>
                    <p class="text-muted">Try adjusting your search criteria or check back later.</p>
                    <a href="{{ route('report-lost') }}" class="btn btn-danger mt-3">
                        <i class="fas fa-plus me-2"></i>Report a Lost Item
                    </a>
                </div>
            @endforelse
        </div>


    </div>
@endsection
