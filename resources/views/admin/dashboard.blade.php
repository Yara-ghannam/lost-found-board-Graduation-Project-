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
            @foreach ($foundItems as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm item-card bg-light pt-3 pb-3">
                        <img src="{{ $item->item->image_url }}" class="card-img-top"
                            style="object-fit: contain; width: 100%; height: 250px;" alt="Image">

                        <div class="card-body ">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $item->item->title }}</h5>
                                <span class="badge bg-success">Found</span>
                            </div>

                            <p class="card-text text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i>{{ $item->item->category->name ?? 'Unknown' }}
                            </p>

                            <p class="card-text">{{ $item->item->description }}</p>
                            <!-- color and brand and serial number -->
                            <p>
                                @if (!empty($item->item->color))
                                    <strong>Color:</strong> {{ $item->item->color }} <br>
                                @else
                                    <br>
                                @endif


                                @if (!empty($item->item->brand))
                                    <strong>Brand:</strong> {{ $item->item->brand }} <br>
                                @else
                                    <br>
                                @endif

                                @if (!empty($item->item->serial_or_mark))
                                    <strong>Serial/Mark:</strong> {{ $item->item->serial_or_mark }}<br>
                                @else
                                    <br>
                                @endif
                            </p>
                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Found at {{ $item->location->campus }}
                                @if (!empty($item->location->building))
                                    {{ ',' . $item->location->building }}
                                @else
                                    <br>
                                @endif
                                @if (!@empty($item->location->room))
                                    {{ ',' . $item->location->room }}
                                @endif

                            </div>

                            <div class="text-muted small mb-3">
                                <i class="fas fa-calendar me-1"></i>Found on
                                {{ date('F d, Y h:i A', strtotime($item->created_at)) }}


                            </div>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <!-- Toggle Status Switch -->
                                    <form action="{{ route('posts.toggleStatus', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <label class="switch m-0">
                                            <input type="checkbox" onchange="this.form.submit()"
                                                {{ $item->case_status === 'open' ? 'checked' : '' }}>
                                            <span class="slider">
                                                <span class="on">Open</span>
                                                <span class="off">Close</span>
                                            </span>
                                        </label>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('posts.delete', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <!-- ========== Your Lost Items ========== -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2><i class="fas fa-hand-holding text-danger me-2"></i>Your Lost Items</h2>
            </div>
        </div>

        <div class="row" id="lostItemsGrid">
            @foreach ($lostItems as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm item-card bg-light pt-3 pb-3">
                        <img src="{{ $item->item->image_url }}" class="card-img-top"
                            style="object-fit: contain; width: 100%; height: 250px;" alt="Image">

                        <div class="card-body ">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $item->item->title }}</h5>
                                <span class="badge bg-danger">Lost</span>
                            </div>

                            <p class="card-text text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i>{{ $item->item->category->name ?? 'Unknown' }}
                            </p>

                            <p class="card-text">{{ $item->item->description }}</p>

                            <!-- color and brand and serial number -->
                            <p>
                                @if (!empty($item->item->color))
                                    <strong>Color:</strong> {{ $item->item->color }} <br>
                                @else
                                    <br>
                                @endif

                                @if (!empty($item->item->brand))
                                    <strong>Brand:</strong> {{ $item->item->brand }} <br>
                                @else
                                    <br>
                                @endif

                                @if (!empty($item->item->serial_or_mark))
                                    <strong>Serial/Mark:</strong> {{ $item->item->serial_or_mark }}<br>
                                @else
                                    <br>
                                @endif
                            </p>

                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Lost at {{ $item->location->campus }}
                                @if (!empty($item->location->building))
                                    {{ ',' . $item->location->building }}
                                @else
                                    <br>
                                @endif
                                @if (!@empty($item->location->room))
                                    {{ ',' . $item->location->room }}
                                @endif

                            </div>

                            <div class="text-muted small mb-3">
                                <i class="fas fa-calendar me-1"></i>Lost on
                                {{ date('F d, Y h:i A', strtotime($item->created_at)) }}
                            </div>

                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <!-- Toggle Status Switch -->
                                    <form action="{{ route('posts.toggleStatus', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <label class="switch m-0">
                                            <input type="checkbox" onchange="this.form.submit()"
                                                {{ $item->case_status === 'open' ? 'checked' : '' }}>
                                            <span class="slider">
                                                <span class="on">Open</span>
                                                <span class="off">Close</span>
                                            </span>
                                        </label>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('posts.delete', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection


<script>
    function toggleSwitch(el) {
        if (el.checked) {
            console.log("Comments Enabled");
            // document.getElementById('commentsSection').style.display = 'block';
        } else {
            console.log("Comments Disabled");
            // document.getElementById('commentsSection').style.display = 'none';
        }
    }
</script>
