@extends('layouts.dashboard')

@section('title')

    <title>Products</title>

@endsection

@section('breadcrumb')

    <div class="navbar-breadcrumb">
        <h5 class="mb-0">Products</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ul>
        </nav>
    </div>

@endsection

@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Products</h4>
                            </div>
                            <button class="btn btn-primary" onclick="create()">New Product</button>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="modalTitle">Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-product">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="form-group row align-items-center">
                            <div class="col-md-12 text-center">
                                <div class="profile-img-edit">
                                    <img class="profile-pic" src="/assets/images/user/11.png" alt="profile-pic" id="product-image">
                                    <div class="p-image">
                                        <i class="ri-pencil-line upload-button"></i>
                                    </div>
                                    <input class="file-upload" type="file" accept="image/*" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control mb-0" name="category_id" id="category_id">
                                <option value hidden>Enter category</option>
                            </select>
                        </div>
                        <div class="form-group">
                           <label for="name">Product Name</label>
                           <input type="text" class="form-control mb-0" name="name" id="name" placeholder="Enter name">
                       </div>
                        <div class="d-inline-block mt-2 w-100">
                            <button type="submit" class="btn btn-primary btn-lg float-right" id="form-btn">
                                <span class="spinner-border spinner-border-sm mr-1" id="spinner"></span> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        var access_token = localStorage.getItem('access_token');

        var default_image = $('.profile-pic')[0].src;

        var products = [];

        var categories = [];

        function create() {

            if (categories.length == 0) {

                swal2Show({
                    icon: 'warning',
                    message: 'register categories before',
                    confirmButtonText: 'Go to categories',
                    onConfirm: () => {
                        window.location.href = '/categories';
                    }
                });

                return;

            }

            $('#modalTitle').text('New Product');

            $('#productModal').modal('show');

            $('.profile-pic')[0].src = default_image;

            $('.file-upload').val('');

            $('#name').val('');

            $('#category_id').val('');

            $('#form-product').data('validator').settings.submitHandler = (form, event) => {
                event.preventDefault();

                if ($('.profile-pic')[0].src == default_image) {

                    swal2Toast({
                        icon: 'error',
                        message: 'Please enter your product image'
                    });

                    return;
                }

                $('#spinner').show();
                
                const data = Object.fromEntries(new FormData(form).entries());

                data.image = $('.profile-pic')[0].src;

                $.ajax({
                    type: 'POST',
                    url: '/api/product',
                    contentType: 'application/json',
                    headers: {
                        'Authorization': `Bearer ${access_token}`
                    },
                    data: JSON.stringify(data),
                }).done(res => {

                    products.push(res.data);
                    
                    $('#datatable').DataTable().row.add(res.data).draw();

                    $('#productModal').modal('hide');

                    $('#spinner').hide();

                    swal2Toast({
                        icon: 'success',
                        message: 'Successfully created'
                    });

                }).fail(err => {
                    
                    $('#spinner').hide();

                    const message = err.responseJSON.message;

                    const key = Object.keys(message)[0]

                    swal2Toast({
                        icon: 'error',
                        message: message[key][0]
                    });

                });
                    
            };
                
        }

        function edit(index) {

            const product = products[index];

            $('.profile-pic')[0].src = product.image;

            $('.file-upload').val('');

            $('#name').val(product.name);

            $('#category_id').val(product.category_id);

            $('#modalTitle').text('Edit Product');

            $('#productModal').modal('show');

            $('#form-product').data('validator').settings.submitHandler = (form, event) => {

                event.preventDefault();

                $('#spinner').show();

                const data = Object.fromEntries(new FormData(form).entries());

                const src = $('.profile-pic')[0].src;

                if (src && src != product.image)
                    data.image = src;

                $.ajax({
                    type: 'PUT',
                    url: `/api/product/${product.id}`,
                    contentType: 'application/json',
                    headers: {
                        'Authorization': `Bearer ${access_token}`
                    },
                    data: JSON.stringify(data),
                }).done(res => {

                    products[index] = res.data;
                    
                    $('#datatable').dataTable().fnUpdate(res.data, index);

                    $('#productModal').modal('hide');

                    $('#spinner').hide();

                    swal2Toast({
                        icon: 'success',
                        message: 'Successfully updated'
                    });

                }).fail(err => {
                    
                    $('#spinner').hide();

                    const message = err.responseJSON.message;

                    const key = Object.keys(message)[0]

                    swal2Toast({
                        icon: 'error',
                        message: message[key][0]
                    });

                });

            };
            
        }

        function destroy(index) {

            const product = products[index];

            swal2Show({
                icon: 'warning',
                message: `This will permanently delete the product "${product.name}". Continue?`,
                onConfirm: () => {

                    $.ajax({
                        type: 'DELETE',
                        url: `/api/product/${product.id}`,
                        contentType: 'application/json',
                        headers: {
                            'Authorization': `Bearer ${access_token}`
                        }
                    }).done(res => {

                        products = products.splice(index, 1);
                        
                        $('#datatable').dataTable().fnDeleteRow(index);

                        swal2Toast({
                            icon: 'success',
                            message: 'Successfully deleted'
                        });

                    }).fail(err => {
                        
                        $('#spinner').hide();

                        const message = err.responseJSON.message;

                        const key = Object.keys(message)[0]

                        swal2Toast({
                            icon: 'error',
                            message: message[key][0]
                        });

                    });

                }
            });

        }

        $(function() {

            $('#spinner').hide();

            $('#form-product').validate({
                rules: {
                    category_id: {
                        required: true
                    },
                    name: {
                        required: true
                    }
                },
                messages: {
                    category_id: {
                        required: 'Please enter your product category'
                    },
                    name: {
                        required: 'Please enter your product name'
                    }
                }
            });

            $.ajax({
                type: 'GET',
                url: '/api/product',
                contentType: 'application/json',
                headers: {
                    'Authorization': `Bearer ${access_token}`
                }
            }).done(res => {

                products = res.data;

                $('#datatable').dataTable({
                    responsive: true,
                    data: products,
                    columns: [
                        {
                            data: 'image',
                            class: 'align-middle',
                            orderable: false,
                            render: function(data) {
                                return `<a href="${data}" target="_blank"><img src="${data}" height="50px" /></a>`;
                            }
                        },
                        {
                            data: 'name',
                            class: 'align-middle'
                        },
                        {
                            data: 'category.name',
                            class: 'align-middle'
                        },
                        {
                            data: 'id',
                            class: 'align-middle text-right',
                            orderable: false,
                            width: '150px',
                            render: function(data, type, row, meta) {
                                return `
                                    <button class="btn btn-link" onclick="edit(${meta.row})">
                                        <i class="ri-edit-box-line"></i>
                                    </button>
                                    <button class="btn btn-link" onclick="destroy(${meta.row})">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                `;
                            }
                        }
                    ]
                });

            });

            $.ajax({
                type: 'GET',
                url: '/api/category',
                contentType: 'application/json',
                headers: {
                    'Authorization': `Bearer ${access_token}`
                }
            }).done(res => {

                categories = res.data;

                categories.forEach(category => {
                    $('#category_id').append(`
                        <option value="${category.id}">${category.name}</option>
                    `)
                });

            });

        });

    </script>

@endsection
