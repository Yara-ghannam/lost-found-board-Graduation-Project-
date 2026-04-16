<?php $__env->startSection('content'); ?>
    <div class="container p-5 mt-5 mb-5">

        <div class="row justify-content-center">
                    <!-- Back to My Posts Button -->
        <div class="mb-4">
            <a href="<?php echo e(route('posts.index')); ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Back to My Posts
            </a>
        </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">

                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-hand-holding me-2"></i>Edit Post</h3>
                    </div>
                    <div class="card-body p-5">
                        <form action=<?php echo e(route('posts.update', $post->id)); ?> method="POST" enctype="multipart/form-data"
                            id="foundItemForm">
                            <?php echo csrf_field(); ?>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="itemName" class="form-label">Item Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="itemName" required
                                        placeholder="e.g. iPhone 13 Pro" value="<?php echo e($post->item->title); ?>">
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
                                        <option value="<?php echo e($post->item->category->id); ?>" selected>
                                            <?php echo e($post->item->category->name); ?>

                                        </option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($cat->id != $post->item->category->id): ?>
                                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                            <?php endif; ?>
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
                                    placeholder="Provide as much detail as possible - brand, color, size, distinctive features, etc."><?php echo e($post->item->description); ?></textarea>
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
                                        placeholder="e.g. Black" value="<?php echo e($post->item->color); ?>">
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
                                        placeholder="e.g. Apple" value="<?php echo e($post->item->brand); ?>">
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
                                        placeholder="e.g. SN123456789" value="<?php echo e($post->item->serial_or_mark); ?>">
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
                                        placeholder="e.g. Sequare F, Between Building A and B"
                                        value="<?php echo e($post->location->campus); ?>">
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
                                        placeholder="e.g. A Building, B Building" value="<?php echo e($post->location->building); ?>">
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
                                        placeholder="e.g. E201, Library" value="<?php echo e($post->location->room); ?>">
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
                                    placeholder="Any other relevant location details"><?php echo e($post->location->notes); ?></textarea>
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
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-save me-2"></i>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\Lost-Found-main\resources\views/item/edit-post.blade.php ENDPATH**/ ?>