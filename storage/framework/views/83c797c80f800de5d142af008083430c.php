<?php $__env->startSection('content'); ?>
    <?php
        use App\Models\Claim;
        use App\Models\User;
    ?>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2><i class="fas fa-search-minus text-danger me-2"></i>Lost Items</h2>
                <p class="text-muted">Help us reunite these items with their owners. If you've found any of these items,
                    please contact the owner.</p>
            </div>
            <div class="col-lg-4 text-end">
                <a href=<?php echo e(route('report-lost')); ?> class="btn btn-danger">
                    <i class="fas fa-plus me-2"></i>Report Lost Item
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
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
        <div class="row" id="lostItemsGrid">
            <?php $__currentLoopData = $lostItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- Lost Item 6 -->

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm item-card" data-title="<?php echo e(strtolower($item->item->title)); ?>"
                        data-category="<?php echo e($item->item->category->id); ?>"
                        data-location="<?php echo e(strtolower($item->location->campus)); ?>"
                        data-date="<?php echo e($item->created_at->format('Y-m-d')); ?>">

                        <img src="<?php echo e($item->item->image_url); ?>" class="card-img-top" alt="Image"
                            style="object-fit: contain; width: 100%; height: 250px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0"><?php echo e($item->item->title); ?></h5>
                                <span class="badge bg-danger"><?php echo e($item->post_type); ?></span>
                            </div>
                            <p class="card-text text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i><?php echo e($item->item->category->name); ?>

                            </p>
                            <!-- color and brand and serial number
                                                <p>
                                                    <?php if(!empty($item->item->color)): ?>
    <strong>Color:</strong> <?php echo e($item->item->color); ?> <br>
    <?php endif; ?>

                                                    <?php if(!empty($item->item->brand)): ?>
    <strong>Brand:</strong> <?php echo e($item->item->brand); ?> <br>
    <?php endif; ?>

                                                    <?php if(!empty($item->item->serial_or_mark)): ?>
    <strong>Serial/Mark:</strong> <?php echo e($item->item->serial_or_mark); ?><br>
    <?php endif; ?>
                                                </p>-->
                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Lost at <?php echo e($item->location->campus); ?>

                                <?php if(!empty($item->location->building)): ?>
                                    <?php echo e(',' . $item->location->building ?? 'Unknown'); ?>

                                <?php endif; ?>
                                <?php if(!@empty($item->location->room)): ?>
                                    <?php echo e(',' . $item->location->room ?? 'Unknown'); ?>

                                <?php endif; ?>

                            </div>
                            <div class="text-muted small mb-3">
                                <i class="fas fa-calendar me-1"></i>Lost on
                                <?php echo e(date('F d, Y h:i A', strtotime($item->created_at))); ?>

                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#claimModal"
                                    onclick="setClaimInfo(<?php echo e($item->id); ?>)">
                                    <i class="fas fa-hand-paper me-2"></i>Claim Item
                                </button>


                                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#commentsModal" onclick="openComments(<?php echo e($item->id); ?>)">
                                    <i class="fas fa-comments me-2"></i>Comments
                                </button>


                                <?php
                                    $claim = Claim::where('user_id', Session::get('user_id'))
                                        ->where('post_id', $item->id)
                                        ->latest()
                                        ->first(); // get the latest claim

                                    $user_info = $item->user;

                                    //$claim && Session::get('claim_access_' . $claim->id)

                                ?>

                                <?php if(optional($claim)->verification_status === 'auto_approved'): ?>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#contactModal"
                                        onclick="setContactInfo(
                                            '<?php echo e($item->item->title); ?>',
                                            '<?php echo e($item->user->name); ?>',
                                            '<?php echo e($item->user->email); ?>',
                                            '<?php echo e($item->user->phone ?? 'Not provided'); ?>'
                                        )">
                                        <i class="fas fa-envelope me-2"></i>Contact Owner
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" disabled
                                        title="You need to claim this item first to see owner's contact">
                                        <i class="fas fa-envelope me-2"></i>Contact Owner
                                    </button>
                                <?php endif; ?>





                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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




                    <form id="claimForm" method="POST" action="<?php echo e(route('claim.store')); ?>">
                        <?php echo csrf_field(); ?>
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


                    </div>

                    <!-- Add Comment -->
                    <h6 class="fw-bold mb-2">Add a Comment</h6>
                    <form method="POST" action="<?php echo e(route('comments.store')); ?>">
                        <?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>
<script>


    ///// create and show comment /////////
    function openComments(postId) {
        document.getElementById('commentPostId').value = postId;

        let commentsHtml = '';
        let comments = <?php echo json_encode($lostItems, 15, 512) ?>; // Make sure this is your data source

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
            return past.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            });
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
        document.getElementById('claimPostId').value = postId;
        document.getElementById('proofText').value = '';
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
            noResults.style.display = (visibleCount === 0) ? "block" : "none";
        }
        searchInput.addEventListener("input", filterItems);
        categoryFilter.addEventListener("change", filterItems);
        locationFilter.addEventListener("input", filterItems);
        dateFilter.addEventListener("input", filterItems);
    });
    ////////////////////// End search and filter ////////////////////

</script>

<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\Lost-Found-main\resources\views/item/lost-items.blade.php ENDPATH**/ ?>