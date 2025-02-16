@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pesanan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pesanan</li>
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
                        <h3 class="card-title">Data Pesanan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="myTable table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Email Pemesan</th>
                                    <th>Alamat Pemesan</th>
                                    <th>Catatan</th>
                                    <th>Nama Product</th>
                                    <th>Total Pesanan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody id="orderTableBody">

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
    function fetchOrder() {
        $.ajax({
            url: "{{ route('get-order') }}",
            type: "GET",
            success: function (response) {
                let rows = "";
                response.forEach(order => {
                    rows += `
                    <tr class="text-center content-item">
                        <td>
                            <input type="hidden" value="${order.id}" class="hdnorderID">
                            ${order.id}</td>
                        <td>${order.name}</td>
                        <td>${order.email}</td>
                        <td>${order.address}</td>
                        <td>${order.notes}</td>
                        <td>${order.product.product_name}</td>
                        <td>${order.total_item}</td>
                        <td>${order.total_price}</td>
                    </tr>
                `;
                });

                $("#orderTableBody").empty().append(rows);
            },
            error: function (xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        });

    }

    $(document).ready(function () {
        fetchOrder();
    });

</script>
@endsection
