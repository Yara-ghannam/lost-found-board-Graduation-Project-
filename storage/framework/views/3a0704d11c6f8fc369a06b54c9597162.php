<?php $__env->startSection('content'); ?>
    <div class="container py-5">

        <!-- ========== Your Found Items ========== -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2><i class="fas fa-hand-holding text-success me-2"></i>Your Found Items</h2>
            </div>
        </div>




        <div class="row" id="foundItemsGrid">
            <?php if(!empty($foundItems) && count($foundItems) > 0): ?>
                <?php $__currentLoopData = $foundItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm item-card">
                            <img src="<?php echo e($item->item->image_url); ?>" class="card-img-top"
                                style="object-fit: contain; width: 100%; height: 250px;" alt="Image">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0"><?php echo e($item->item->title); ?></h5>
                                    <span class="badge bg-success">Found</span>
                                </div>

                                <p class="card-text text-muted small mb-2">
                                    <i class="fas fa-tag me-1"></i><?php echo e($item->item->category->name ?? 'Unknown'); ?>

                                </p>

                                <p class="card-text"><?php echo e($item->item->description); ?></p>

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
                                </p>

                                <div class="text-muted small mb-2">
                                    <i class="fas fa-map-marker-alt me-1"></i>Found at <?php echo e($item->location->campus); ?>

                                    <?php if(!empty($item->location->building)): ?>
                                        , <?php echo e($item->location->building); ?>

                                    <?php endif; ?>
                                    <?php if(!empty($item->location->room)): ?>
                                        , <?php echo e($item->location->room); ?>

                                    <?php endif; ?>
                                </div>

                                <div class="text-muted small mb-3">
                                    <i class="fas fa-calendar me-1"></i>Found on
                                    <?php echo e(date('F d, Y h:i A', strtotime($item->created_at))); ?>

                                </div>

                                <div class="d-flex justify-content-between text-center gap-3">
                                    <a href="<?php echo e(route('posts.edit', $item->id)); ?>" class="btn btn-primary w-50">Edit</a>
                                    <form action="<?php echo e(route('posts.delete', $item->id)); ?>" method="POST" class="w-50">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="container text-center py-5">
                    <i class="fas fa-search text-muted display-1 mb-3"></i>
                    <h4 class="text-muted">No items found</h4>
                    <p class="text-muted">Try adjusting your search criteria or check back later.</p>
                    <a href="<?php echo e(route('report-found')); ?>" class="btn btn-success mt-3">
                        <i class="fas fa-plus me-2"></i>Report a Found Item
                    </a>
                </div>
            <?php endif; ?>
        </div>


        <hr>



        <!-- ========== Your Lost Items ========== -->


        <div class="row mb-4">
            <div class="col-lg-8">
                <h2><i class="fas fa-search-minus text-danger me-2"></i>Your Lost Items</h2>
            </div>
        </div>

        <div class="row" id="lostItemsGrid">
            <?php $__empty_1 = true; $__currentLoopData = $lostItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm item-card">
                        <img src="<?php echo e($item->item->image_url); ?>" class="card-img-top"
                            style="object-fit: contain; width: 100%; height: 250px;" alt="Image">

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0"><?php echo e($item->item->title); ?></h5>
                                <span class="badge bg-danger">Lost</span>
                            </div>

                            <p class="card-text text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i><?php echo e($item->item->category->name ?? 'Unknown'); ?>

                            </p>

                            <p class="card-text"><?php echo e($item->item->description); ?></p>


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
                            </p>


                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Lost at <?php echo e($item->location->campus); ?>

                                <?php if(!empty($item->location->building)): ?>
                                    , <?php echo e($item->location->building); ?>

                                <?php endif; ?>
                                <?php if(!empty($item->location->room)): ?>
                                    , <?php echo e($item->location->room); ?>

                                <?php endif; ?>
                            </div>

                            <div class="text-muted small mb-3">
                                <i class="fas fa-calendar me-1"></i>Lost on
                                <?php echo e(date('F d, Y h:i A', strtotime($item->created_at))); ?>

                            </div>

                            <div class="d-flex justify-content-between text-center gap-3">
                                <a href="<?php echo e(route('posts.edit', $item->id)); ?>" class="btn btn-primary w-50">Edit</a>
                                <form action="<?php echo e(route('posts.delete', $item->id)); ?>" method="POST" class="w-50">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger w-100">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="container text-center py-5">
                    <i class="fas fa-search text-muted display-1 mb-3"></i>
                    <h4 class="text-muted">No Lost Items Found</h4>
                    <p class="text-muted">Try adjusting your search criteria or check back later.</p>
                    <a href="<?php echo e(route('report-lost')); ?>" class="btn btn-danger mt-3">
                        <i class="fas fa-plus me-2"></i>Report a Lost Item
                    </a>
                </div>
            <?php endif; ?>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\Lost-Found-main\resources\views/item/my-posts.blade.php ENDPATH**/ ?>