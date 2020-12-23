<div class="content-wrapper" style="min-height: 1074px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Refund</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Refund</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <form class="form-inline ml-4">
            <div class="input-group input-group-md">
                <input class="form-control" type="text" name="search_sale" id="search_sale" placeholder="Enter Invoice ID" aria-label="Search" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </div>
        </form>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-8 connectedSortable ui-sortable">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-striped projects text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">
                                                Customer
                                            </th>
                                            <th style="width: 5%">
                                                Amount
                                            </th>
                                            <th style="width: 5%">
                                                Quantity
                                            </th>
                                            <th style="width: 5%">
                                                Amount Paid
                                            </th>
                                            <th style="width: 5%">
                                                Remaining Amount
                                            </th>
                                            <th style="width: 5%">
                                                Sold By
                                            </th>
                                        </tr>
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoice">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable ui-sortable">
                    <div class="card">
                        <div class="card-body p-0">
                            <select name="customer_id" id="customer_id" class="form-control">
                                <option class="customerValue" data-customerId="" data-customerName="" value=""></option>
                            </select>
                        </div>
                    </div>
                    <!-- Product Cart -->
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th class="col-4">Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody id="added-item">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Cart Total -->
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th class="col-4"></th>
                                        <th>_____</th>
                                        <th>_____</th>
                                    </tr>
                                </thead>
                                <tbody class="total">
                                    <td>Total</td>
                                    <td id="totalQuantity"></td>
                                    <td id="totalPrice"></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <button type="button" onclick="reload()" class="btn btn-danger">Cancel</button> -->
                    <!-- <button type="button" onclick="storeData()" class="btn btn-warning">Suspend</button> -->
                    <button type="button" class="btn btn-success" id="payment-button" data-toggle="modal" data-target="#modal-default">Proceed</button>
                    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-default">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Payment</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="invoice p-3 mb-3">
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>
                                                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                                                    <small class="float-right">Date: 2/10/2014</small>
                                                </h4>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- /.col -->
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody class="sale-details">
                                                            <tr>
                                                                <th>Customer</th>
                                                                <td>
                                                                    <select name="customer_id" id="customer" class="form-control" disabled>
                                                                        <option></option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Salesman</th>
                                                                <td id="sold_by"><input name="sold_by" class="form-control" value="<?= $user->first_name . ' ' . $user->last_name ?>" disabled> </td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:50%">Total Quantity</th>
                                                                <td id="sale_quantity"> <input type="number" class="form-control" disabled></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Price</th>
                                                                <td id="sale_amount"><input type="number" class="form-control" disabled></td>
                                                            </tr>
                                                            <!-- <tr>
                                                                <th>Total:</th>
                                                                <td id="sale_total"></td>
                                                            </tr> -->
                                                            <tr>
                                                                <th>Enter Amount to be Paid:</th>
                                                                <td id="sale_amount_paid"><input class="form-control" type="number" name="sale_amount_paid"></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-12">
                                                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                                <button type="button" class="btn btn-success float-right" id="submit-payment"><i class="far fa-credit-card"></i> Submit
                                                    Payment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </section>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    var totalPriceHTML = $("#totalPrice");
    var totalQuantityHTML = $("#totalQuantity");
    var customerId = $('#customer_id option:selected');
    var customer = $('#customer option:selected');
    var fadeTime = 300;
    $(document).ready(function() {
        $('#search_sale').keyup(function() {
            var productArray = [];
            var products = [];
            customerId.val('');
            customerId.text('');
            totalPriceHTML.html('');
            totalQuantityHTML.html('');
            var id = $(this).val();
            $.ajax({
                method: "POST",
                url: "<?= base_url() . 'index.php/refund/getInvoice'; ?>",
                data: {
                    id: id,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var invoice = '';
                    for (var i = 0; i < data.length; i++) {
                        invoice = "<tr data-id=" + data[i]['id'] + " ><td>" + data[i]['customer_first_name'] + " " + data[i]['customer_last_name'] + "<br/><small> " + data[i]['time_created'] + "</small></td><td>" + data[i]['sale_amount'] + "</td><td>" + data[i]['sale_quantity'] + "</td><td>" + data[i]['sale_amount_paid'] + "</td><td>" + data[i]['balance'] + "</td><td>" + data[i]['user_first_name'] + " " + data[i]['user_last_name'] + "</td></tr>";
                        const customer_name = data[i]['customer_first_name'] + ' ' + data[i]['customer_last_name'];
                        const customer_id = data[i]['customer_id'];
                        customerId.val(customer_id);
                        customerId.text(customer_name);
                    }

                    $('#invoice').html(invoice);
                },
                error: function() {
                    $('#invoice').html('');
                }
            });
            $.ajax({
                method: "POST",
                url: "<?= base_url() . 'index.php/refund/getProductsByInvoiceId'; ?>",
                data: {
                    id: id,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    products = data;
                    $('#added-item').html('');
                    var productsHTML = '';
                    for (var i = 0; i < products.length; i++) {
                        productsHTML = '<tr id=' + products[i]['product_id'] + '><td><a class="deleteButton" data-id=' + products[i]["product_id"] + '><i class="fas fa-times-circle"></i></a> ' + products[i]["product_name"] + '</td><td class="pass-quantity" contenteditable="true"><input class="form-control" type="number" value="' + products[i]["product_quantity"] + '" min="1"></td><td class="price" data-price="' + products[i]["product_price"] + '">' + products[i]["product_price"] + '</td></tr>';
                        // invoice = "<tr data-id=" + data[i]['id'] + "><td>" + data[i]['customer_first_name'] + " " + data[i]['customer_last_name'] + "<br/><small> " + data[i]['time_created'] + "</small></td><td>" + data[i]['sale_amount'] + "</td><td>" + data[i]['sale_quantity'] + "</td><td>" + data[i]['sale_amount_paid'] + "</td><td>" + data[i]['balance'] + "</td><td>" + data[i]['user_first_name'] + " " + data[i]['user_last_name'] + "</td></tr>";
                        // products = "";
                        $('#added-item').append(productsHTML);
                        productArray.push(products[i]);


                    }
                    updateCart();
                    // console.log(data.customer_fisrt_name);
                },
                error: function() {
                    $('#added-item').html('');
                }
            });

            // This funciton every time when any action is perform in cart to update the cart
            function updateCart() {
                var totalPrice = 0;
                var totalQuantity = 0;


                // var id = productArray[0].product_id;
                // console.log(id);
                // debugger;
                // Getting quantity and price from each elements by using loop
                for (i = 0; i < productArray.length; i++) {

                    // On change of quantity update price
                    $('#' + productArray[i].product_id).find('.pass-quantity input').change(function() {
                        updateQuantity(this);
                    });

                    $('#' + productArray[i].product_id).find(".pass-quantity input").each(function() {
                        totalQuantity += parseFloat($(this).val());
                    });

                    $('#' + productArray[i].product_id).find(".price").each(function() {
                        totalPrice += parseFloat($(this).html());
                    });
                    // console.log(totalPrice);

                    // var priceTotal = '<input type="number" class=" form-control" value="' + totalPrice + '" >';
                    // var quantityTotal = '<input type="number" class=" form-control" value="' + totalQuantity + '">';

                    $("#totalPrice").html(totalPrice);
                    $("#totalQuantity").html(totalQuantity);
                }
            }


            // Update Quantity when the input changes
            function updateQuantity(quantityInput) {
                var linePrice = 0;
                /* Calculate price */
                var productRow = $(quantityInput).parent().parent();
                var price = productRow.children('.price').attr('data-price');
                var id = productRow.children().children('.deleteButton').attr('data-id');
                var quantity = $(quantityInput).val();

                for (i = 0; i < productArray.length; i++) {
                    if (productArray[i].product_id == id) { //Check if the item is already in the cart then show only once while updating the quanitity and price
                        var newQuantity = quantity;
                        productArray[i].product_quantity = newQuantity;
                        var linePrice = JSON.stringify(productArray[i].actual_price * newQuantity);
                        productArray[i].product_price = linePrice;

                        inCart = 1;
                    }
                }
                updateCart();
                /* Update price display and recall updateCart */
                productRow.children('.price').each(function() {
                    $(this).fadeOut(fadeTime, function() {
                        $(this).text(linePrice);
                        updateCart();
                        $(this).fadeIn(fadeTime);
                    });
                });
                // console.log(productArray);
            }

            // Deleting an item from cart and updating cart
            $(document).on("click", ".deleteButton", function() {
                $(this).parent().parent().remove();
                var clickedItem = $(this).data('id');

                for (var i = 0; i < productArray.length; i++) {
                    var t = productArray[i].product_id;
                    if (productArray[i].product_id == clickedItem) {
                        updateCart(); //Calling the update function before deleting the object
                        productArray.splice(i, 1);
                        i--;
                    }
                }
                // console.log(productArray);
            });

            // Adding payment and products details into table
            $("#payment-button").on('click', function() {
                var paymentDetails = [];
                paymentDetails = productArray;
                // console.log(paymentDetails);
                if (paymentDetails.length > 0) {
                    var actual_sale_id = $('#invoice').children().attr('data-id');
                    var customer_id = customerId.val();
                    var customer_name = customerId.text();
                    var sale_amount = $("#totalPrice").html();
                    var sale_quantity = $("#totalQuantity").html();
                    var sold_by = <?= $user_id; ?>;
                    customer.val(customer_id);
                    customer.text(customer_name);
                    $('.sale-details').find('#sale_amount input').val(sale_amount);
                    $('.sale-details').find('#sale_quantity input').val(sale_quantity);
                    $('#sale_total').html(sale_amount);
                    $('.sale-details').find('#sale_amount_paid input').val(sale_amount);
                    $('.sale-details').find('#sale_amount_paid input').attr({
                        'max': sale_amount,
                        'min': 1
                    });

                }
                $("#submit-payment").on('click', function() {
                    // console.log(customer_id);
                    // console.log(sale_quantity);
                    // console.log(sale_amount);
                    // console.log(sale_amount_paid);
                    // console.log(paymentDetails);
                    // var jsonString = JSON.stringify(paymentDetails);
                    var sale_amount_paid = $('.sale-details').find('#sale_amount_paid input').val();

                    $.ajax({
                        method: "POST",
                        url: "<?= base_url() . 'index.php/refund/refundItem'; ?>",
                        data: {
                            actual_sale_id: actual_sale_id,
                            saleDetails: paymentDetails,
                            customer_id: customer_id,
                            sale_quantity: sale_quantity,
                            sale_amount: sale_amount,
                            sale_amount_paid: sale_amount_paid,
                            sold_by: sold_by,
                        },
                        cache: false,
                        success: function(result) {
                            console.log("Ok");
                            // console.log(result);
                            location.reload();
                        }
                    });
                })
            });
        })
    })


    $(".product-details").click(function() {
        var inCart = 0;
        var name = $(this).data('name');
        var price = $(this).data('price');
        var id = $(this).data('id');
        var quantity = $(this).data('quantity');
        var product = {
            'id': id,
            'name': name,
            'actualPrice': price,
            'price': price,
            'quantity': 1,
            'maxQuantity': quantity,
            'inCart': 0,
        };
        // if (productArray.length < 0) { 
        //     // var html = '<tr class=' + product.id + '><td>' + product.name + '</td><td> ' + product.quantity + '</td><td>' + product.price + '</td></tr>';
        //     // $('.added-item').append(html);
        //     productArray.push(product);
        // } else {
        // 

        // If array has a same clicked item or more than one item
        for (i = 0; i < productArray.length; i++) {
            if (productArray[i].id == id) { //Check if the item is already in the cart then show only once while updating the quanitity and price
                var newQuantity = productArray[i].quantity + 1;
                productArray[i].quantity = newQuantity;
                productArray[i].price = productArray[i].actualPrice * newQuantity;
                var html = '<tr id=' + productArray[i].id + '><td><a class="deleteButton" data-id=' + productArray[i].id + '><i class="fas fa-times-circle"></i></a> ' + productArray[i].name + '</td><td class="pass-quantity" contenteditable="true"><input class="form-control" type="number" value="' + productArray[i].quantity + '" min="1" max="' + productArray[i].maxQuantity + '"></td><td class="price" data-price="' + productArray[i].price + '">' + productArray[i].price + '</td></tr>';
                $('#' + productArray[i].id).replaceWith(html);
                updateCart();
                inCart = 1;
            }
        }

        // If the clicked item is not in the cart then push it in array
        if (inCart == 0) {
            productArray.push(product);
            var html = '<tr id=' + productArray[i].id + '><td><a class="deleteButton"  data-id=' + productArray[i].id + ' ><i class="fas fa-times-circle"></i></a> ' + productArray[i].name + '</td><td class="pass-quantity" contenteditable="true"><input class="form-control" type="number" value="' + productArray[i].quantity + '" min="1" max="' + productArray[i].maxQuantity + '"></td><td class="price" data-price="' + productArray[i].price + '">' + productArray[i].price + '</td></tr>';
            $('.added-item').append(html);
            updateCart();
        }



    });







    function reload() {
        location.reload();
    }

    function storeData() {
        var suspended = [];
        var products = [];
        products = productArray;
        var id = $('#customer option:selected').val();
        var name = $('#customer option:selected').text();
        var customerSuspendData = {
            id: id,
            customer: name,
            product: productArray
        };
        suspended = customerSuspendData;
        var customerData = JSON.parse(localStorage.getItem(id));
        if (id.length == 0) {
            alert("Kindly select a customer");
        } else if (products.length == 0) {
            alert("No item selected.Kindly select an item!")
        } else if (customerData) {
            alert("Customer already existed!");
            location.reload();
        } else {
            localStorage.setItem(id, JSON.stringify(suspended));
            location.reload();
        }
    }

    var suspendedData = [];

    $(document).on("click", ".suspend", function showSuspend() {
        if (productArray.length > 0) {
            alert("Product already selected");
        } else {
            id = $(this).data('id');
            for (var i = 0; i < suspendedData.length; i++) {
                if (suspendedData[i].id == id) {
                    $(this).remove();
                    for (var j = 0; j < suspendedData[i].product.length; j++) {
                        var html = '<tr id=' + suspendedData[i].product[j].id + '><td><a class="deleteButton" data-id=' + suspendedData[i].product[j].id + '><i class="fas fa-times-circle"></i></a> ' + suspendedData[i].product[j].name + '</td><td class="pass-quantity" contenteditable="true"><input class="form-control" type="number" value="' + suspendedData[i].product[j].quantity + '" min="1" max="' + suspendedData[i].product[j].maxQuantity + '"></td><td class="price" data-price="' + suspendedData[i].product[j].price + '">' + suspendedData[i].product[j].price + '</td></tr>';
                        $('.added-item').append(html);
                        productArray.push(suspendedData[i].product[j]);
                        $('#customer option:selected').val(suspendedData[i].id);
                        $('#customer option:selected').text(suspendedData[i].customer);
                        localStorage.removeItem(id);
                        var customers = localStorage.length;
                        $('.badge-primary').html(customers);
                    }
                    updateCart();
                }
            }
        }
    });
</script>
<!-- <div id="toastsContainerTopRight" class="toasts-top-right fixed">
//     <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
//         <div class="toast-header"><strong class="mr-auto">Toast Title</strong><small>Subtitle</small><button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button></div>
//         <div class="toast-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</div>
//     </div>
// </div> -->