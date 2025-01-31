@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Stock</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Stok</li>
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
                        <h3 class="card-title">Data Stock</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="myTable table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nama Produk</th>
                                    <th>Stok</th>
                                    <th style="width: 10%;">Penambahan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="stockTableBody">

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
@endsection

@section('scripts')
<script>
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
                            <td class="stock-now">${product.stock}</td>
                            <td>
                                <input type="number" class="form-control txtStock">    
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-edit-data">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $("#stockTableBody").empty().append(rows);
            },
            error: function (xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        });
    }

    $(document).ready(function () {
        fetchProducts();
    });


    $(document).on("click", ".btn-edit-data", function () {
        var itemContent = $(this).closest(".content-item");

        var productID = itemContent.find(".hdnProductID").val();
        var stockOld = parseInt(itemContent.find(".stock-now").html());
        var stockAdd = parseInt(itemContent.find(".txtStock").val());

        var totalStock = stockOld + stockAdd;

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('update-stock', '') }}/" +
                productID,
            type: "PATCH",
            data: {
                '_token': csrfToken,
                'stock': totalStock
            },
            success: function (data) {
                alert("Data Berhasil DiUbah");

                fetchProducts();

            },
            error: function (data) {
                console.log("gagal");
            }
        })
    });

</script>
@endsection
