<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-danger text-white">
                        <h3 class="mb-0"><i class="fas fa-search-minus me-2"></i>Report Lost Item</h3>
                    </div>
                    <div class="card-body p-5">
                        <form action=<?php echo e(route('store-report-lost')); ?> method="POST" enctype="multipart/form-data"
                            id="lostItemForm">
                            <?php echo csrf_field(); ?>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="itemName" class="form-label">Item Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="itemName" required
                                        placeholder="e.g. iPhone 13 Pro">
                                </div>
                                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Category <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="category_id" id="category" required>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($items->id); ?>"><?php echo e($items->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Detailed Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" rows="4" required
                                    placeholder="Provide as much detail as possible - brand, color, size, distinctive features, etc."></textarea>
                            </div>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                            <div class="row mb-4">
                                <!--color-->
                                <div class="col-md-4">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" name="color" class="form-control" id="color"
                                        placeholder="e.g. Black">
                                </div>
                                <?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <!--brand-->
                                <div class="col-md-4">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" name="brand" class="form-control" id="brand"
                                        placeholder="e.g. Apple">
                                </div>
                                <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <!--serial or mark-->
                                <div class="col-md-4">
                                    <label for="serialNumber" class="form-label">Serial Number For Products</label>
                                    <input type="text" name="serial_or_mark" class="form-control" id="serialNumber"
                                        placeholder="e.g. SN123456789">
                                </div>
                                <?php $__errorArgs = ['serial_or_mark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                            <hr class="my-4">

                            <h5 class="mb-3">Location</h5>
                            <div class="row mb-4"><!--Location Details-->
                                <div class="col-md-4">
                                    <label for="Campus" class="form-label">Campus<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="campus" class="form-control" id="Campus" required
                                        placeholder="e.g. Sequare F, Between Building A and B">
                                </div>
                                <?php $__errorArgs = ['campus'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <div class="col-md-4">
                                    <label for="Building" class="form-label">Building</label>
                                    <input type="text" name="building" class="form-control" id="city"
                                        placeholder="e.g. A Building, B Building">
                                </div>
                                <?php $__errorArgs = ['building'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                                <div class="col-md-4">
                                    <label for="Room" class="form-label">Room</label>
                                    <input type="text" name="room" class="form-control" id="Room"
                                        placeholder="e.g. E201, Library">
                                </div>
                                <?php $__errorArgs = ['room'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>

                            <div class="mb-4">
                                <label for="NoteForLocation" class="form-label">Note For Location</label>
                                <textarea class="form-control" name="notes" id="NoteForLocation" rows="3"
                                    placeholder="Any other relevant location details"></textarea>
                            </div>
                            <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                            <div class="mb-4">
                                <label for="photo" class="form-label">Photo (if available)</label>
                                <input type="file" name="image_url" class="form-control" id="photo"
                                    accept="image/*">
                                <div class="form-text">Upload a photo of the item if you have one</div>
                            </div>
                            <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>




                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="privacy" required>
                                    <label class="form-check-label" for="privacy">
                                        I agree to the privacy policy and terms of service <span
                                            class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href=<?php echo e(route('home')); ?> class="btn btn-outline-secondary me-md-2">Cancel</a>
                                <button type="submit" class="btn btn-danger btn-lg">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Report Lost Item
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle me-2"></i>Item Reported Successfully
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Your lost item has been reported successfully. We've sent a confirmation email to your provided
                        address.</p>
                    <p><strong>What happens next?</strong></p>
                    <ul>
                        <li>Your item will be visible in our lost items database</li>
                        <li>People who find similar items will be able to contact you</li>
                        <li>You'll receive email notifications for potential matches</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href=<?php echo e(route('lost-items')); ?> class="btn btn-primary">View Lost Items</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\Lost-Found-main\resources\views/item/report-lost.blade.php ENDPATH**/ ?>