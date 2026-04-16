<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->index+1); ?></td>
                        <td><?php echo e($ads->name); ?></td>
                        <td><?php echo e($ads->email); ?></td>
                        <td><?php echo e($ads->phone); ?></td>
                        <td>
                            <span class="badge bg-primary"><?php echo e($ads->role); ?></span>
                        </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <button class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye me-1"></i> View
                                    </button>

                                    <form action="<?php echo e(route('users.delete', $ads->id)); ?>" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                        class="m-0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->index+1); ?></td>
                        <td><?php echo e($u->name); ?></td>
                        <td><?php echo e($u->email); ?></td>
                        <td><?php echo e($u->phone); ?></td>
                        <td>
                            <span class="badge bg-secondary"><?php echo e($u->role); ?></span>
                        </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <button class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye me-1"></i> View
                                    </button>

                                    <form action="<?php echo e(route('users.delete', $u->id)); ?>" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                        class="m-0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\Lost-Found-main\resources\views/admin/Show-users.blade.php ENDPATH**/ ?>