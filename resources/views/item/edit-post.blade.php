@extends('layout.master')
@section('content')
    <div class="container p-5 mt-5 mb-5">

        <div class="row justify-content-center">
                    <!-- Back to My Posts Button -->
        <div class="mb-4">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Back to My Posts
            </a>
        </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">

                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-hand-holding me-2"></i>Edit Post</h3>
                    </div>
                    <div class="card-body p-5">
                        <form action={{ route('posts.update', $post->id) }} method="POST" enctype="multipart/form-data"
                            id="foundItemForm">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="itemName" class="form-label">Item Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="itemName" required
                                        placeholder="e.g. iPhone 13 Pro" value="{{ $post->item->title }}">
                                </div>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Category <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="category_id" id="category" required>
                                        <option value="{{ $post->item->category->id }}" selected>
                                            {{ $post->item->category->name }}
                                        </option>
                                        @foreach ($categories as $cat)
                                            @if ($cat->id != $post->item->category->id)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Detailed Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" rows="4" required
                                    placeholder="Provide as much detail as possible - brand, color, size, distinctive features, etc.">{{ $post->item->description }}</textarea>
                            </div>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror


                            <div class="row mb-4">
                                <!--color-->
                                <div class="col-md-4">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" name="color" class="form-control" id="color"
                                        placeholder="e.g. Black" value="{{ $post->item->color }}">
                                </div>
                                @error('color')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <!--brand-->
                                <div class="col-md-4">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" name="brand" class="form-control" id="brand"
                                        placeholder="e.g. Apple" value="{{ $post->item->brand }}">
                                </div>
                                @error('brand')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <!--serial or mark-->
                                <div class="col-md-4">
                                    <label for="serialNumber" class="form-label">Serial Number For Products</label>
                                    <input type="text" name="serial_or_mark" class="form-control" id="serialNumber"
                                        placeholder="e.g. SN123456789" value="{{ $post->item->serial_or_mark }}">
                                </div>
                                @error('serial_or_mark')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <hr class="my-4">

                            <h5 class="mb-3">Location</h5>
                            <div class="row mb-4"><!--Location Details-->
                                <div class="col-md-4">
                                    <label for="Campus" class="form-label">Campus<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="campus" class="form-control" id="Campus" required
                                        placeholder="e.g. Sequare F, Between Building A and B"
                                        value="{{ $post->location->campus }}">
                                </div>
                                @error('campus')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="col-md-4">
                                    <label for="Building" class="form-label">Building</label>
                                    <input type="text" name="building" class="form-control" id="city"
                                        placeholder="e.g. A Building, B Building" value="{{ $post->location->building }}">
                                </div>
                                @error('building')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                                <div class="col-md-4">
                                    <label for="Room" class="form-label">Room</label>
                                    <input type="text" name="room" class="form-control" id="Room"
                                        placeholder="e.g. E201, Library" value="{{ $post->location->room }}">
                                </div>
                                @error('room')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-4">
                                <label for="NoteForLocation" class="form-label">Note For Location</label>
                                <textarea class="form-control" name="notes" id="NoteForLocation" rows="3"
                                    placeholder="Any other relevant location details">{{ $post->location->notes }}</textarea>
                            </div>
                            @error('notes')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror


                            <div class="mb-4">
                                <label for="photo" class="form-label">Photo (if available)</label>
                                <input type="file" name="image_url" class="form-control" id="photo"
                                    accept="image/*">
                                <div class="form-text">Upload a photo of the item if you have one</div>
                            </div>
                            @error('image_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror




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
                                <a href={{ route('home') }} class="btn btn-outline-secondary me-md-2">Cancel</a>
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
@endsection
