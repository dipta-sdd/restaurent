<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bangla Tandoori Restauresnt') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin_style.css') }}" rel="stylesheet">
</head>
<body>
    @include('admin.header')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Items</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <div class="card mb-4 p-none" id="manage_item">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create New Item</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation">
                            @csrf
                            <div class="col-md-6">
                                <label for="subcategory_id" class="form-label">Subcategory <small class="text-danger">*</small></label>
                                <select id="subcategory_id" class="form-control" name="subcategory_id" required>
                                    <option value="">Select Subcategory</option>
                                    @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Item Name <small class="text-danger">*</small></label>
                                <input type="text" id="name" class="form-control" name="name" required />
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price <small class="text-danger">*</small></label>
                                <input type="number" id="price" class="form-control" name="price" step="0.01" required />
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" id="description" class="form-control" name="description" />
                            </div>
                            <div class="col-md-6">
                                <label for="allergens" class="form-label">Allergens</label>
                                <input type="text" id="allergens" class="form-control" name="allergens" />
                            </div>
                            <div class="col-md-6">
                                <label for="dietary_options" class="form-label">Dietary Options</label>
                                <input type="text" id="dietary_options" class="form-control" name="dietary_options" />
                            </div>
                            
                            <div class="col-md-12">
                                <label for="item_image" class="form-label">Item Image</label>
                                <div class="input-group">
                                    <input type="file" id="item_image" class="form-control" name="item_image" accept="image/*">
                                    <input type="hidden" id="cropped_image" name="cropped_image">
                                </div>
                                
                                <!-- Image Preview -->
                                <div id="image-preview-container" class="mt-2" style="display:none;">
                                    <img id="image-preview" src="" alt="Image Preview" class="img-fluid" style="max-height: 200px; cursor: pointer;">
                                </div>

                                <!-- Existing Image Display -->
                                <div id="existing-image-container" class="mt-2" style="display:none;">
                                    <h5>Existing Image:</h5>
                                    <img id="existing-image" src="" alt="Existing Image" class="img-fluid" style="max-height: 200px;">
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary save">
                                    <i class="fas fa-plus"></i> Add New
                                </button>
                                <button type="submit" class="btn btn-primary update d-none">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <select id="filter_subcategory" class="form-select">
                            <option value="">All</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Items List</h5>
                                
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subcategory</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Allergens</th>
                                                <th>Dietary Options</th>
                                                <th>Image</th>
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th>Updated By</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="items-table text-capitalize" id="itemsTbody">
                                            @foreach ($items as $item)
                                            <tr id="tr-{{ $item->id }}" >
                                                <td>{{ $item->id }}</td>
                                                <td data-val="{{ $item->subcategory_id }}">{{ $item->subcategory_name }}</td>
                                                <td onclick="window.location='{{ url('/admin/item/' . $item->id) }}'">{{ $item->name }}</td>
                                                <td>{{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->description ?? "N/A" }}</td>
                                                <td>{{ $item->allergens ?? "N/A" }}</td>
                                                <td>{{ $item->dietary_options ?? "N/A" }}</td>
                                                <td>
                                                    @if($item->image)
                                                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="img-thumbnail" style="max-width:100px;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_by ?? 'N/A' }}</td>
                                                <td>{{ $item->created_at ? $item->created_at->format('d M, Y, H:i') : 'N/A' }}</td>
                                                <td>{{ $item->updated_by ?? 'N/A' }}</td>
                                                <td>{{ $item->updated_at ? $item->updated_at->format('d M, Y, H:i') : 'N/A' }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete" data-id="{{ $item->id }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="imageCropModal" tabindex="-1" aria-labelledby="imageCropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageCropModalLabel">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="image-cropper"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="cropImageBtn">Crop and Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>

    <script>
    $(document).ready(function() {
        let imageCropper = null;

        // Image Upload and Preview
        $('#item_image').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#image-preview').attr('src', event.target.result);
                    $('#image-preview-container').show();

                    // Initialize Croppie
                    imageCropper = new Croppie(document.getElementById('image-cropper'), {
                        viewport: { width: 300, height: 300 , type : 'square'},
                        boundary: { width: 500, height: 500 },
                        showZoomer: true,
                        enableResize: false,
                        enableOrientation: true,
                        mouseWheelZoom: 'ctrl'
                    });

                    imageCropper.bind({
                        url: event.target.result
                    });
                };
                reader.readAsDataURL(file);
                const bootstrapModal = new bootstrap.Modal(document.getElementById('imageCropModal'));
            bootstrapModal.show();
            }
        });

        // Open Crop Modal on Image Preview Click
        $('#image-preview').on('click', function() {
            const bootstrapModal = new bootstrap.Modal(document.getElementById('imageCropModal'));
            bootstrapModal.show();
        });

        // Crop Image Button
        $('#cropImageBtn').on('click', function() {
            if (imageCropper) {
                imageCropper.result('blob').then(function(blob) {
                    // Create a URL for the blob
                    const croppedImageUrl = URL.createObjectURL(blob);
                    
                    // Set preview image
                    $('#image-preview').attr('src', croppedImageUrl);
                    
                    // Convert blob to base64 for form submission
                    const reader = new FileReader();
                    reader.onloadend = function() {
                        $('#cropped_image').val(reader.result);
                    }
                    reader.readAsDataURL(blob);

                    // Close modal
                    const bootstrapModal = bootstrap.Modal.getInstance(document.getElementById('imageCropModal'));
                    bootstrapModal.hide();
                });
            }
        });

        // Modify existing AJAX calls to include image
        $('#manage_item form .save').click(function(e) {
            e.preventDefault();
            let data = collectData('#manage_item form .form-control');
            
            // If image is cropped, add to data
            const croppedImage = $('#cropped_image').val();
            if (croppedImage) {
                data.image = croppedImage;
            }

            $.ajax({
                type: "post",
                url: "/api/admin/item",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(response) {
                    $('#itemsTbody').append(`
                        <tr id="tr-${response.id}">
                            <td>${response.id}</td>
                            <td data-val="${response.subcategory_id}">${response.subcategory_name}</td>
                            <td onclick="window.location='{{ url('/admin/item/') }}/${response.id}'">${response.name}</td>
                            <td>${parseFloat(response.price).toFixed(2)}</td>
                            <td>${response.description ?? "N/A"}</td>
                            <td>${response.allergens ?? "N/A"}</td>
                            <td>${response.dietary_options ?? "N/A"}</td>
                            <td>
                                ${response.image ? `<img src="${response.image}" alt="${response.name}" class="img-thumbnail" style="max-width:100px;">` : 'N/A'}
                            </td>
                            <td>${response.created_by}</td>
                            <td>${myDateFormat(response.created_at)}</td>
                            <td>${response.updated_by}</td>
                            <td>${myDateFormat(response.updated_at)}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete" data-id="${response.id}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    `);
                    // Reset form
                    $('#manage_item form .form-control').val('');
                    $('#image-preview-container').hide();
                    showToast('Item added successfully', 'success');
                },
                error: function(xhr) {
                    let res = xhr.responseJSON;
                    if (res.errors) {
                        labelErrors('#manage_item form .form-control', res.errors);
                    } else {
                        showToast('Internal server error', 'danger');
                    }
                }
            });
        });


        // Edit functionality
        $(document).on('click', '#itemsTbody .btn.btn-primary.edit', function(e) {
            e.preventDefault();
            const tr = $(this).closest('tr');
            const id = tr.find('td').eq(0).text().trim();
            const data = {
                subcategory_id: tr.find('td').eq(1).data('val'),
                name: tr.find('td').eq(2).text().trim(),
                price: tr.find('td').eq(3).text().trim(),
                description: tr.find('td').eq(4).text().trim() === 'N/A' ? '' : tr.find('td').eq(4).text().trim(),
                allergens: tr.find('td').eq(5).text().trim() === 'N/A' ? '' : tr.find('td').eq(5).text().trim(),
                dietary_options: tr.find('td').eq(7).text().trim() === 'N/A' ? '' : tr.find('td').eq(6).text().trim(),
                image: tr.find('td').eq(7).find('img').attr('src')
            };
            
            loadData('#manage_item form .form-control', data);
            $('#manage_item form .update').attr('data-id', id);
            $('#manage_item form button.save').addClass('d-none');
            $('#manage_item form button.update').removeClass('d-none');
            $('#manage_item .card-title').text('Update Item');

            // Set existing image
            if (data.image) {
                $('#existing-image').attr('src', data.image);
                $('#existing-image-container').show(); // Show existing image container
            } else {
                $('#existing-image-container').hide(); // Hide if no image
            }
        });

        // Update functionality
        $('#manage_item form .update').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let data = collectData('#manage_item form .form-control');

            $.ajax({
                type: "post",
                url: "/api/admin/item/" + id,
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(response) {
                    let $row = $('#tr-' + id);
                    $row.find('td').eq(1).text(response.subcategory_name);
                    $row.find('td').eq(2).text(response.name);
                    $row.find('td').eq(3).text(parseFloat(response.price).toFixed(2));
                    $row.find('td').eq(4).text(response.description ?? "N/A");
                    $row.find('td').eq(5).text(response.allergens ?? "N/A");
                    $row.find('td').eq(6).text(response.dietary_options ?? "N/A");
                    $row.find('td').eq(7).html(response.image ? `<img src="${response.image}" alt="${response.name}" class="img-thumbnail" style="max-width:100px;">` : 'N/A');
                    $row.find('td').eq(9).text(response.updated_by);
                    $row.find('td').eq(8).text(myDateFormat(response.updated_at));
                    
                    showToast('Item updated successfully', 'success');

                    // Clear all input fields
                    $('#manage_item form .form-control').val('');
                    $('#manage_item form input[type="file"]').val(''); // Clear file input
                    $('#image-preview-container').hide(); // Hide image preview
                    $('#existing-image-container').hide(); // Hide existing image container
                    $('#manage_item form button.save').removeClass('d-none');
                    $('#manage_item form button.update').addClass('d-none');
                    $('#manage_item .card-title').text('Create New Item');
                },
                error: function(xhr) {
                    let res = xhr.responseJSON;
                    if (res.errors) {
                        labelErrors('#manage_item form .form-control', res.errors);
                    } else {
                        showToast('Internal server error', 'danger');
                    }
                }
            });
        });

        $(document).on('click', '#itemsTbody .btn.btn-danger.delete', function(e) {
            e.preventDefault();
            const itemId = $(this).data('id');
            const row = $(this).closest('tr');

            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    type: "DELETE",
                    url: `/api/admin/item/${itemId}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        // Remove the row from the table
                        row.remove();
                        showToast('Item deleted successfully', 'success');
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON;
                        if (res.message) {
                            showToast(res.message, 'danger');
                        } else {
                            showToast('Internal server error', 'danger');
                        }
                    }
                });
            }
        });

        // Filter items by subcategory
        $('#filter_subcategory').change(function() {
            const subcategoryId = $(this).val();
            $.ajax({
                type: "GET",
                url: "/api/admin/items", // Update this URL to your API endpoint
                data: { subcategory_id: subcategoryId },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(response) {
                    // Clear the existing items
                    $('#itemsTbody').empty();
                    
                    // Append the filtered items
                    response.items.forEach(item => {
                        $('#itemsTbody').append(`
                            <tr id="tr-${item.id}">
                                <td>${item.id}</td>
                                <td data-val="${item.subcategory_id}">${item.subcategory_name}</td>
                                <td onclick="window.location='{{ url('/admin/item/') }}/${item.id}'">${item.name}</td>
                                <td>${parseFloat(item.price).toFixed(2)}</td>
                                <td>${item.description ?? "N/A"}</td>
                                <td>${item.allergens ?? "N/A"}</td>
                                <td>${item.dietary_options ?? "N/A"}</td>
                                <td>
                                    ${item.image ? `<img src="${item.image}" alt="${item.name}" class="img-thumbnail" style="max-width:100px;">` : 'N/A'}
                                </td>
                                <td>${item.created_by}</td>
                                <td>${myDateFormat(item.created_at)}</td>
                                <td>${item.updated_by}</td>
                                <td>${myDateFormat(item.updated_at)}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete" data-id="${item.id}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr) {
                    let res = xhr.responseJSON;
                    if (res.message) {
                        showToast(res.message, 'danger');
                    } else {
                        showToast('Internal server error', 'danger');
                    }
                }
            });
        });
    });
    </script>
</body>
</html>