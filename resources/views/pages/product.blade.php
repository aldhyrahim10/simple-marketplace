@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Produk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                            Tambah Data
                        </button>
                        <table class="myTable table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


{{-- Modal Tambah Data --}}
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalAddLabel">Tambah Data</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="formAddProduct" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="product_name" id="product_name"
                                    placeholder="Masukkan Nama Produk">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kategori Produk</label>
                                <select name="category_id" id="category_id" class="form-control category_id_add">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="Masukkan Harga">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock"
                                    placeholder="Masukkan Stock">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Gambar Produk</label>
                                <input type="file" class="form-control" name="product_image" id="product_image">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <textarea name="product_description" id="product_description" cols="30" rows="5"
                                    class="form-control" placeholder="Masukkan Deskripsi Produk"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCloseModalAdd" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Edit Data --}}
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalEditLabel">Edit Data</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="formEditProduct" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="hidden" class="form-control" name="product_id" id="product_id">
                                <input type="text" class="form-control" name="product_name" id="product_name"
                                    placeholder="Masukkan Nama Produk">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kategori Produk</label>
                                <select name="category_id" id="category_id" class="form-control category_id">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="Masukkan Harga">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock"
                                    placeholder="Masukkan Stock">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Gambar Produk</label>
                                <input type="file" class="form-control" name="product_image" id="product_image">
                                <small>gambar sebelumnya</small>
                                <br>
                                <img class="product_image" width="100px" src="" alt="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <textarea name="product_description" id="product_description" cols="30" rows="5"
                                    class="form-control" placeholder="Masukkan Deskripsi Produk"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCloseModalEdit" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function fetchCategory() {
        $.ajax({
            url: "{{ route('get-category') }}",
            type: "GET",
            success: function (response) {

                let categoryOptions = '<option value="">Pilih Kategori</option>';
                response.forEach(category => {
                    categoryOptions +=
                        `<option value="${category.id}">${category.category_name}</option>`;
                });

                $(".category_id_add").html(categoryOptions);
            },
            error: function (xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        })
    }

    function fetchProducts() {

        $.ajax({
            url: "{{ route('get-product') }}",
            type: "GET",
            success: function (response) {
                let rows = "";
                response.forEach(product => {
                    rows += `
                    <tr class="text-center content-item">
                        <td>
                            <input type="hidden" value="${product.id}" class="hdnProductID">
                            ${product.id}</td>
                        <td>${product.product_name}</td>
                        <td>${product.category ? product.category.category_name : 'Tidak Ada Kategori'}</td>
                        <td>Rp ${product.price.toLocaleString()}</td>
                        <td>${product.product_description}</td>
                        <td><img src="${product.product_image}" width="100" alt="${product.product_name}"></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-edit-data" data-toggle="modal" data-target="#modalEdit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-delete-data">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
                });

                $("#productTableBody").empty().append(rows);
            },
            error: function (xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        });
    }

    $(document).ready(function () {

        fetchProducts();

        fetchCategory();


        $("#formAddProduct").submit(function (e) {
            e.preventDefault();

            var productName = $(this).find("#product_name").val();
            var productCategory = $(this).find("#category_id").val();
            var productPrice = $(this).find("#price").val();
            var productStock = $(this).find("#stock").val();
            var productDesc = $(this).find("#product_description").val();
            var productImage = $(this).find("#product_image")[0].files[0];

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            if (!productImage) {
                alert("belum ada gambar");
            } else {
                let formData = new FormData();
                formData.append('image', productImage);
                formData.append('_token', csrfToken);

                $.ajax({
                    url: "{{ route('upload-image') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {

                        var imgUrl = data.image_url

                        $.ajax({
                            url: "{{ route('store-product') }}",
                            type: "POST",
                            data: {
                                '_token': csrfToken,
                                'category_id': productCategory,
                                'product_name': productName,
                                'price': productPrice,
                                'stock': productStock,
                                'product_image': imgUrl,
                                'product_description': productDesc
                            },
                            success: function (data2) {
                                alert("Data Berhasil Ditambahkan");

                                fetchProducts();

                                $('input').val("");

                                $("#btnCloseModalAdd").click();
                            },
                            error: function (data2) {
                                console.log("gagal");
                            }
                        })

                    },
                    error: function (data) {
                        console.log("Upload gagal", data);
                    }
                });
            }
        });

        $("#formEditProduct").submit(function (e) {
            e.preventDefault();

            var productID = $(this).find("#product_id").val();
            var productName = $(this).find("#product_name").val();
            var productCategory = $(this).find("#category_id").val();
            var productPrice = $(this).find("#price").val();
            var productStock = $(this).find("#stock").val();
            var productDesc = $(this).find("#product_description").val();
            var productImage = $(this).find("#product_image")[0].files[0];

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            if (!productImage) {
                $.ajax({
                    url: "{{ route('update-product', '') }}/" +
                        productID,
                    type: "PATCH",
                    data: {
                        '_token': csrfToken,
                        'category_id': productCategory,
                        'product_name': productName,
                        'price': productPrice,
                        'stock': productStock,
                        'product_description': productDesc
                    },
                    success: function (data) {
                        alert("Data Berhasil DiUbah");

                        fetchProducts();

                        $("#btnCloseModalEdit").click();
                    },
                    error: function (data) {
                        console.log("gagal");
                    }
                })

            } else {
                let formData = new FormData();
                formData.append('image', productImage);
                formData.append('_token', csrfToken);

                $.ajax({
                    url: "{{ route('upload-image') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {

                        var imgUrl = data.image_url

                        $.ajax({
                            url: "{{ route('update-product', '') }}/" +
                                productID,
                            type: "PATCH",
                            data: {
                                '_token': csrfToken,
                                'category_id': productCategory,
                                'product_name': productName,
                                'price': productPrice,
                                'stock': productStock,
                                'product_image': imgUrl,
                                'product_description': productDesc
                            },
                            success: function (data2) {
                                alert("Data Berhasil Diubah");

                                fetchProducts();

                                $("#btnCloseModalEdit").click();
                            },
                            error: function (data2) {
                                console.log("gagal");
                            }
                        })

                    },
                    error: function (data) {
                        console.log("Upload gagal", data);
                    }
                });
            }
        });



    });

    $(document).on("click", ".btn-edit-data", function () {
        var itemContent = $(this).closest(".content-item");

        var productID = itemContent.find(".hdnProductID").val();

        $.ajax({
            url: "{{ route('get-one-product') }}",
            type: "GET",
            data: {
                'query': productID
            },
            success: function (data) {
                var productID = data.id;
                var productName = data.product_name;
                var productCategory = data.category.category_id;
                var productImage = data.product_image;
                var productDesc = data.product_description;
                var productPrice = data.price;
                var productStock = data.stock;

                var formEditContent = $("#formEditProduct");

                formEditContent.find("#product_id").val(productID);
                formEditContent.find("#product_name").val(productName);
                formEditContent.find("#price").val(productPrice);
                formEditContent.find("#product_description").val(productDesc);
                formEditContent.find(".product_image").attr("src", productImage);
                formEditContent.find("#stock").val(productStock);

                $.ajax({
                    url: "{{ route('get-category') }}", // Route for categories
                    type: "GET",
                    success: function (categories) {
                        var categoryOptions =
                            '<option value="">Pilih Kategori</option>';
                        categories.forEach(function (category) {
                            categoryOptions +=
                                `<option value="${category.id}">${category.category_name}</option>`;
                        });

                        formEditContent.find(".category_id").html(categoryOptions);

                        if (productCategory) {
                            formEditContent.find(".category_id").val(productCategory);
                        }


                    },
                    error: function (data) {
                        console.log("Gagal mengambil kategori");
                    }
                });

            },
            error: function (data) {
                console.log("gagal");
            }
        })

    });

    $(document).on("click", ".btn-delete-data", function () {
        if (confirm("Apakah Anda ingin menghapus data ini?")) { 
            var itemContent = $(this).closest(".content-item");
            var productID = itemContent.find(".hdnProductID").val();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('delete-product', '') }}/" +
                    productID, 
                type: "DELETE", 
                data: {
                        '_token': csrfToken,          
                    },
                success: function (data) {
                    alert("Data Berhasil Dihapus"); 
                    fetchProducts();
                },
                error: function (data) {
                    console.log("Gagal menghapus data");
                }
            });
        }

    });

</script>
@endsection