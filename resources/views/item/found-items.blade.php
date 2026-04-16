@extends('layout.master')
@section('content')
    @php
        use App\Models\Claim;
        use App\Models\User;
    @endphp
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2><i class="fas fa-hand-holding text-success me-2"></i>Found Items</h2>
                <p class="text-muted">These items are looking for their owners. If you recognize any of these items as yours,
                    please contact the finder.</p>
            </div>
            <div class="col-lg-4 text-end">
                <a href={{ route('report-found') }} class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Report Found Item
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Search items..." id="searchText">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterCategory">
                            <option value="">All Categories</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Location" id="filterLocation">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="e.g., 2025-12-12" id="filterdaterange">
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Grid -->
        <div class="row" id="foundItemsGrid">
            <!-- Found Item 1 -->
            @foreach ($foundItems as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm item-card" data-title="{{ strtolower($item->item->title) }}"
                        data-category="{{ $item->item->category->id }}"
                        data-location="{{ strtolower($item->location->campus) }}"
                        data-date="{{ $item->created_at->format('Y-m-d') }}"> <img src="{{ $item->item->image_url }}"
                            class="card-img-top" alt="Image" style="object-fit: contain; width: 100%; height: 250px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $item->item->title }}</h5>
                                <span class="badge bg-success">{{ $item->post_type }}</span>
                            </div>
                            <p class="card-text text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i>{{ $item->item->category->name }}
                            </p>
                            <!-- color and brand and serial number
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
                                                    </p>-->
                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Found at {{ $item->location->campus }}
                                @if (!empty($item->location->building))
                                    {{ ',' . $item->location->building ?? 'Unknown' }}
                                @endif
                                @if (!@empty($item->location->room))
                                    {{ ',' . $item->location->room ?? 'Unknown' }}
                                @endif

                            </div>
                            <div class="text-muted small mb-3">
                                <i class="fas fa-calendar me-1"></i>Found on
                                {{ date('F d, Y h:i A', strtotime($item->created_at)) }}

                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex gap-2">

                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#claimModal"
                                    onclick="setClaimInfo({{ $item->id }})">
                                    <i class="fas fa-hand-paper me-2"></i>Claim Item
                                </button>

                                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#commentsModal" onclick="openComments({{ $item->id }})">
                                    <i class="fas fa-comments me-2"></i>Comments
                                </button>

                                @php
                                    $claim = Claim::where('user_id', Session::get('user_id'))
                                        ->where('post_id', $item->id)
                                        ->latest()
                                        ->first(); // get the latest claim

                                    $user_info = $item->user;

                                 //   $user_id = Session::get('user_id');
                                @endphp

                                @if (optional($claim)->verification_status === 'auto_approved')
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#contactModal"
                                        onclick="setContactInfo(
                                            '{{ $item->item->title }}',
                                            '{{ $item->user->name }}',
                                            '{{ $item->user->email }}',
                                            '{{ $item->user->phone ?? 'Not provided' }}'
                                        )">
                                        <i class="fas fa-envelope me-2"></i>Contact Owner
                                    </button>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled
                                        title="You need to claim this item first to see owner's contact">
                                        <i class="fas fa-envelope me-2"></i>Contact Owner
                                    </button>
                                @endif


                            </div>
                        </div>

                    </div>
                </div>
            @endforeach


        </div>

        <!-- No Results -->
        <div id="noResults" class="text-center py-5" style="display: none;">
            <i class="fas fa-search text-muted display-1 mb-3"></i>
            <h4 class="text-muted">No items found</h4>
            <p class="text-muted">Try adjusting your search criteria or check back later.</p>
        </div>
    </div>

    <!-- Claim Modal -->
    <div class="modal fade" id="claimModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-hand-paper me-2"></i>Claim Item
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Proof of Ownership Required:</strong> Be prepared to provide proof that this item belongs to
                        you. The finder may ask for specific details about the item.

                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Safety Reminder:</strong> Always meet in a public place when claiming items.
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Please review your claim details carefully. Correct information will give you temporary access
                        (1 hour)
                        to the owner's contact details. Incorrect claims will be sent to the admin for review.
                    </div>




                    <form id="claimForm" method="POST" action="{{ route('claim.store') }}">
                        @csrf
                        <input type="hidden" name="post_id" id="claimPostId">

                        <div class="mb-3">
                            <label for="proofText" class="form-label">Describe the Item <span
                                    class="text-danger">*</span> </label>
                            <textarea class="form-control" id="proofText" name="description" rows="3" placeholder="Describe the item"
                                required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" name="color" id="color" class="form-control"
                                placeholder="Enter item color">
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" name="brand" id="brand" class="form-control"
                                placeholder="Enter item brand">
                        </div>

                        <div class="mb-3">
                            <label for="serial_or_mark" class="form-label">Serial/Mark</label>
                            <input type="text" name="serial_or_mark" id="serial_or_mark" class="form-control"
                                placeholder="Enter serial number or mark">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit Claim</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
    <!-- Comments Modal -->
    <div class="modal fade" id="commentsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-comments me-2"></i>Comments</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">


                    <!-- Comments List -->
                    <div id="commentsList" class="mb-4">

                        <!-- Example Comment 1 -->
                        <div class="d-flex mb-3">
                            <img src="https://i.pravatar.cc/50?img=12" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-1">John Doe <small class="text-muted">• 2 hours ago</small></h6>
                                <p class="mb-0">I think someone asked about this item earlier.</p>
                            </div>
                        </div>

                        <!-- Example Comment 2 -->
                        <div class="d-flex mb-3">
                            <img src="https://i.pravatar.cc/50?img=25" class="rounded-circle me-3" width="50">
                            <div>
                                <h6 class="mb-1">Emily Rose <small class="text-muted">• Yesterday</small></h6>
                                <p class="mb-0">Is there any mark on the item?</p>
                            </div>
                        </div>

                    </div>

                    <!-- Add Comment -->
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" name="post_id" id="commentPostId">
                        <div class="mb-3">
                            <label class="form-label">Your Comment</label>
                            <textarea class="form-control" name="comment_text" rows="3" placeholder="Write your comment..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-paper-plane me-2"></i>Post Comment
                        </button>
                    </form>


                </div>

            </div>
        </div>
    </div>
    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-envelope me-2"></i> Contact Owner
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">



                    <!-- Owner Name -->
                    <div class="mb-3">
                        <strong>Owner:</strong>
                        <span id="modalOwnerName" class="mt-1"></span>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <span id="modalOwnerEmail" class="mt-1"></span>
                    </div>

                    <div class="mb-3">
                        <strong>Phone:</strong>
                        <span id="modalOwnerPhone" class="mt-1"></span>
                    </div>



                    <!-- Reminder -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Safety Reminder:</strong>
                        Always meet in a public place when exchanging items and verify ownership before handing over the
                        item.
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
<script>
    ///// create and show comment /////////
function openComments(postId) {
    document.getElementById('commentPostId').value = postId;

    let commentsHtml = '';
    let comments = @json($foundItems); // Make sure this is your data source

    let post = comments.find(p => p.id === postId);
    if (!post || !post.comments || post.comments.length === 0) {
        document.getElementById('commentsList').innerHTML = '<p class="text-muted">No comments yet.</p>';
        return;
    }

    // Helper function for relative time
    function timeAgo(date) {
        const now = new Date();
        const past = new Date(date);
        const diff = Math.floor((now - past) / 1000); // seconds

        if (diff < 60) return `${diff} seconds ago`;
        if (diff < 3600) return `${Math.floor(diff / 60)} minutes ago`;
        if (diff < 86400) return `${Math.floor(diff / 3600)} hours ago`;
        if (diff < 2592000) return `${Math.floor(diff / 86400)} days ago`;
        return past.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: '2-digit' });
    }

    post.comments.forEach(c => {
        let username = c.user ? c.user.name : 'Anonymous';
        let commentText = c.comment_text || '';
        let createdAt = c.created_at ? timeAgo(c.created_at) : 'just now';

        commentsHtml += `
        <div class="d-flex mb-3">
            <img src="https://media.istockphoto.com/id/1209654046/vector/user-avatar-profile-icon-black-vector-illustration.jpg?s=612x612&w=0&k=20&c=EOYXACjtZmZQ5IsZ0UUp1iNmZ9q2xl1BD1VvN6tZ2UI="
                 class="rounded-circle me-2 img-fluid"
                 style="max-width: 55px; width: 100%; height: auto;">
            <div>
                <strong>${username}</strong>
                <small class="text-muted"> • ${createdAt}</small>
                <p class="mb-0">${commentText}</p>
            </div>
        </div>
        `;
    });

    document.getElementById('commentsList').innerHTML = commentsHtml;
}
////////////////// end comment section ////////////////



    function setClaimInfo(postId) {
        document.getElementById('claimPostId').value = postId; // يضع الـ post_id في الفورم
        document.getElementById('proofText').value = ''; // يفرغ حقل الوصف
    }

    function setContactInfo(itemName, ownerName, ownerEmail, ownerPhone) {
        document.getElementById("modalOwnerName").innerText = ownerName;
        document.getElementById("modalOwnerEmail").innerText = ownerEmail;
        document.getElementById("modalOwnerPhone").innerText = ownerPhone;
    }


    ///////////////////search and filter ///////////////////////////////

    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchText");
        const categoryFilter = document.getElementById("filterCategory");
        const locationFilter = document.getElementById("filterLocation");
        const dateFilter = document.getElementById("filterdaterange");

        const cards = document.querySelectorAll(".item-card");
        const noResults = document.getElementById("noResults");

        function filterItems() {
            let searchVal = searchInput.value.toLowerCase();
            let categoryVal = categoryFilter.value;
            let locationVal = locationFilter.value.toLowerCase();
            let dateVal = dateFilter.value;

            let visibleCount = 0;

            cards.forEach(card => {
                let title = card.dataset.title;
                let category = card.dataset.category;
                let location = card.dataset.location;
                let date = card.dataset.date;

                let matchSearch = title.includes(searchVal);
                let matchCategory = categoryVal === "" || category === categoryVal;
                let matchLocation = location.includes(locationVal);
                let matchDate = dateVal === "" || date.includes(dateVal);

                if (matchSearch && matchCategory && matchLocation && matchDate) {
                    card.parentElement.style.display = "block";
                    visibleCount++;
                } else {
                    card.parentElement.style.display = "none";
                }
            });

            // إظهار رسالة "No Results" إذا ما في نتائج
            noResults.style.display = (visibleCount === 0) ? "block" : "none";
        }

        searchInput.addEventListener("input", filterItems);
        categoryFilter.addEventListener("change", filterItems);
        locationFilter.addEventListener("input", filterItems);
        dateFilter.addEventListener("input", filterItems);
    });
    ////////////////////// end search and filter ////////////////////
</script>
