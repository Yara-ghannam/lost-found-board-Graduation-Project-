<?php $__env->startSection('content'); ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $claims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $claim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <!-- ID -->
                                <td><?php echo e($claim->id); ?></td>



                                <!-- Owner Info -->
                                <td class="text-start">
                                    <strong><?php echo e($claim->post->user->name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($claim->post->user->email); ?></small><br>
                                    <small class="text-muted"><?php echo e($claim->post->user->phone); ?></small>
                                </td>

                                <!-- Claimer Info -->
                                <td class="text-start">
                                    <strong><?php echo e($claim->user->name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($claim->user->email); ?></small><br>
                                    <small class="text-muted"><?php echo e($claim->user->phone); ?></small>
                                </td>

                                <!-- Item and Post Data -->
                                <td class="text-start">
                                    <strong>Title:</strong><small> <?php echo e($claim->post->item->title); ?></small><br>
                                    <strong>Description:</strong><small>
                                        <?php echo e(Str::limit($claim->post->item->description, 50)); ?>

                                    </small><br>
                                    <strong>Color:</strong><small> <?php echo e($claim->post->item->color ?? 'N/A'); ?></small><br>
                                    <strong>Brand:</strong><small> <?php echo e($claim->post->item->brand ?? 'N/A'); ?></small><br>
                                    <strong>Serial_or_mark:</strong><small>
                                        <?php echo e($claim->post->item->serial_or_mark ?? 'N/A'); ?></small><br>

                                </td>
                                <td class="text-start">
                                    <strong>Description:</strong>
                                    <small><?php echo e($claim->claim_data['description'] ?? 'N/A'); ?></small><br>
                                    <strong>Color:</strong> <small><?php echo e($claim->claim_data['color'] ?? 'N/A'); ?></small><br>
                                    <strong>Brand:</strong> <small><?php echo e($claim->claim_data['brand'] ?? 'N/A'); ?></small><br>
                                    <strong>Serial_or_mark:<small>
                                    </strong><?php echo e($claim->claim_data['serial_or_mark'] ?? 'N/A'); ?></small><br>

                                </td>
                                <!-- Location -->
                                <td class="text-start">
                                    <strong>Campus:</strong> <?php echo e($claim->post->location->campus ?? 'N/A'); ?><br>
                                    <strong>Building:</strong> <?php echo e($claim->post->location->building ?? 'N/A'); ?><br>
                                    <strong>Room:</strong> <?php echo e($claim->post->location->room ?? 'N/A'); ?>

                                </td>


                                <!-- Status -->
                                <td>
                                    <?php if($claim->verification_status == 'pending_admin'): ?>
                                        <span class="badge bg-warning">pending_admin</span>
                                    <?php elseif($claim->verification_status == 'approved'): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo e($claim->created_at); ?></td>
                                <!-- Actions -->
                                <td>
                                    <?php if($claim->verification_status == 'pending_admin'): ?>
                                        <div class="d-flex justify-content-center gap-2">

                                            <form
                                                action="<?php echo e(route('admin.claims.approve', [$claim->id, $claim->user_id])); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <form
                                                action="<?php echo e(route('admin.claims.reject', [$claim->id, $claim->user_id])); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>


                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">No Actions</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-muted py-4">
                                    No claims found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\Lost-Found-main\resources\views/admin/claims.blade.php ENDPATH**/ ?>