@extends('layouts.portal')

@section('content')
<div class="bg-dark"></div>
<div class="cart-panel">
    <div class="cart-header">
        <p class="cart-title text-center">Daftar Keranjang</p>
    </div>
    <div class="cart-body">
        <div class="cart-item-list">
        </div>
    </div>
    <div class="cart-footer">
        <div class="btn-cart" data-toggle="modal" data-target="#modalCheckout">
            <p class="text-center">Proses</p>
        </div>
    </div>
</div>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 mr-2 justify-content-end">
            <div id="openCart" class="btn btn-success">Buka Keranjang</div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="menus-content">
            <div class="row item-list" id="product-list">

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="modalProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalProductLabel">Detail Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" class="hdnProductID">
                    <input type="hidden" class="hdnProductPrice">
                    <div class="col-lg-6">
                        <img src="" width="100%" class="img-product" alt="">
                    </div>
                    <div class="col-lg-6" style="display: flex; flex-direction:column; justify-content: center;">
                        <h3 class="product-name"></h3>
                        <p class="category"></p>
                        <p class="stock"></p>
                        <h2 class="price"></h2>

                    </div>
                    <div class="col-lg-12 mt-3">
                        <h4>Deskripsi Produk</h4>
                        <p class="description"></p>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalOrder"
                    id="btnOrder">Pesan Produk</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="modalOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalOrderLabel">Pemesanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="width: 100%; display: flex; justify-content: space-between; ">
                    <input type="hidden" class="hdnProductID" value="" />
                    <input type="hidden" class="hdnProductPrice" value="" />
                    <p class="title"> </p>
                    <p class="price"></p>
                </div>
                <p class="stock"></p>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <input type="number" class="txtProductTotal form-control" placeholder="Jumlah Pembelian"
                            value="1">
                    </div>
                    <div class="col-lg-6">
                        <input type="number" class="txtProductPrice form-control" disabled placeholder="Total Harga">
                    </div>
                    <div class="col-lg-12 mt-3">
                        <textarea class="form-control txtDesc" cols="30" rows="5"
                            placeholder="Masukkan Catatan"></textarea>
                    </div>
                </div>
                <div class="mt-3">
                    <h4>
                        Data Pemesan
                    </h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" class="txtName form-control" placeholder="Masukkan Nama">
                        </div>
                        <div class="col-lg-6">
                            <input type="email" class="txtEmail form-control" placeholder="Masukkan Email">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <textarea class="form-control txtAddress" cols="30" rows="5"
                                placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div>
                    <div class="final-price mt-4" style="width: 100%; display: flex; justify-content: space-between;">
                        <p class="title-price" style="font-size: 20px">Total Harga</p>
                        <input type="hidden" class="hdnFinalPrice" value="">
                        <p class="price-final" style="font-size: 20px; font-weight: bold;"></p>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnCheckout">Pesan Sekarang</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script type="text/template" id="tmpCardProduct">
    <div class="col-lg-2 col-md-4 col-sm-6 my-2" data-bs-toggle="modal" data-bs-target="#modalProduct">
      <div class="card-product shadow" id="">
        <input type="hidden" class="hdnPrice" value="">
        <div class="card-image">
          <img class="img-product" src="" width="100%" height="200px" alt="">
        </div>
        <div class="card-content">
          <p class="title"></p>
          <p class="category"></p>
          <p class="price"></p>
        </div>
      </div>
    </div>
</script>

<script>
    function fetchProducts() {

        $.ajax({
            url: "{{ route('get-product') }}",
            type: "GET",
            success: function (response) {
                $("#product-list").empty();
                $.each(response, function (index, value) {


                    var newDiv = $($('#tmpCardProduct').html());
                    newDiv.find(".card-product").attr("id", value
                        .id);
                    newDiv.find(".hdnPrice").val(value.price);
                    newDiv.find(".img-product").attr("src", value.product_image);
                    newDiv.find(".category").html(value.category.category_name);
                    newDiv.find(".title").html(value.product_name);
                    newDiv.find(".price").html(new Intl
                        .NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(value.price).replace(
                            "IDR", ""));

                    $("#product-list").append(newDiv);

                });


            },
            error: function (xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        });
    }

    $(document).ready(function () {
        fetchProducts();

        $("#btnOrder").click(function () {
            var item = $(this).closest("#modalProduct");

            var productID = item.find(".hdnProductID").val();


            $.ajax({
                url: "{{ route('get-one-product') }}",
                type: "GET",
                data: {
                    'query': productID
                },
                success: function (data) {
                    var productID = data.id;
                    var productName = data.product_name;
                    var productCategory = data.category.category_name;
                    var productImage = data.product_image;
                    var productDesc = data.product_description;
                    var productPrice = data.price;
                    var productStock = data.stock;

                    var modalContent = $("#modalOrder");

                    modalContent.find(".title").html(productName);
                    modalContent.find(".price").html(
                        new Intl
                        .NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(productPrice).replace(
                            "IDR", "")
                    );

                    modalContent.find(".hdnProductPrice").val(productPrice);
                    modalContent.find(".hdnProductID").val(productID);
                    modalContent.find(".stock").html("Jumlah Stok : " + productStock);

                    modalContent.find(".txtProductPrice").val(productPrice);
                    modalContent.find(".price-final").html(
                        new Intl
                        .NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(productPrice).replace(
                            "IDR", "")
                    )




                },
                error: function (data) {
                    console.log("gagal");
                }
            })

        });

        $(".txtProductTotal").on("change", function () {
            var jumlah = parseInt($(this).val());

            var item = $(this).closest("#modalOrder");
            var priceProduct = parseInt(item.find(".hdnProductPrice").val());

            // alert(jumlah);
            // alert(priceProduct);

            var totalPrice = jumlah * priceProduct;

            item.find(".txtProductPrice").val(totalPrice);

            item.find(".price-final").html(
                new Intl
                .NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(totalPrice).replace(
                    "IDR", "")
            )

        });

        $("#btnCheckout").click(function () {

            var modalItem = $(this).closest("#modalOrder");

            var productID = modalItem.find(".hdnProductID").val();
            var totalItem = modalItem.find(".txtProductTotal").val();
            var totalPrice = modalItem.find(".txtProductPrice").val();
            var notes = modalItem.find(".txtDesc").val();
            var name = modalItem.find(".txtName").val();
            var email = modalItem.find(".txtEmail").val();
            var address = modalItem.find(".txtAddress").val();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('store-order') }}",
                type: "POST",
                data: {
                    '_token': csrfToken,
                    'product_id': productID,
                    'name': name,
                    'email': email,
                    'address': address,
                    'notes': notes,
                    'total_item': totalItem,
                    'total_price': totalPrice
                },
                success: function (response) {
                    alert("Pemesanan Berhasil");
                },
                error: function (xhr, status, error) {
                    console.error("Gagal Menyimpan data:", error);
                    alert("gagal memesan");
                }
            });
        });



    });


    $(document).on("click", ".card-product", function () {
        var productID = $(this).attr("id");

        $.ajax({
            url: "{{ route('get-one-product') }}",
            type: "GET",
            data: {
                'query': productID
            },
            success: function (data) {
                var productID = data.id;
                var productName = data.product_name;
                var productCategory = data.category.category_name;
                var productImage = data.product_image;
                var productDesc = data.product_description;
                var productPrice = data.price;
                var productStock = data.stock;

                var modalProduct = $("#modalProduct");

                modalProduct.find(".img-product").attr("src", productImage);
                modalProduct.find(".product-name").html(productName);
                modalProduct.find(".category").html(productCategory);
                modalProduct.find(".price").html(
                    new Intl
                    .NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(productPrice).replace(
                        "IDR", "")
                )
                modalProduct.find(".description").html(productDesc);
                modalProduct.find(".stock").html("Jumlah Stok : " + productStock);
                modalProduct.find(".hdnProductID").val(productID);


            },
            error: function (data) {
                console.log("gagal");
            }
        })


    });

</script>

@endsection
