<div class="content-wrapper" style="min-height: 1074px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- <div class="row">
                <div class="col-lg-3 col-6">
                
                    <div class="small-box bg-info">
                        <div class="inner">
                            <p>150</p>
                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
            </div> -->
            <!-- <div>
                    <i class="fa fa-camera bg-purple"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                        <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                        </div>
                    </div>
                </div> -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sale</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sale</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-8 connectedSortable ui-sortable">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <?php if (!empty($products)) {
                                    foreach ($products as $product) { ?>
                                        <div class="col-sm-2">
                                            <a class="product-details" href="#" data-id="<?= $product['id'] ?>" data-name='<?= $product['name'] ?>' data-price='<?= $product['price'] ?>' data-quantity='<?= $product['quantity'] ?>' data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                                                <?php if (!empty($product['photo'])) { ?>
                                                    <img style="width: 100px; height:100px" class="img-fluid mb-2" src="<?= base_url() . '/public/images/product/' . $product['photo'] ?>" alt="Product Photo" />
                                                <?php } else { ?>
                                                    <img src="http://placehold.it/150x150" alt="..." class="img-fluid mb-2">
                                                <?php }  ?>
                                                <small>
                                                    <p class="users-list-name">
                                                        <?= $product['name'] ?>
                                                    </p>
                                                    <p class="users-list-date">
                                                        &#8360 <?= $product['price'] ?>
                                                    </p>
                                                </small>
                                            </a>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>

                    <div class="card collapsed-card col-lg-5">
                        <div class="card-header ui-sortable-handle">
                            <h3 class="card-title">Customers Data</h3>
                            <div class="card-tools">
                                <span data-toggle="tooltip" class="badge badge-primary">0</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: none;">
                            <div>
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="col-4">ID</th>
                                            <th>Customer</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customer-details">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable ui-sortable">
                    <div class="card">
                        <div class="card-body p-0">
                            <?php if (!empty($customers)) { ?>
                                <select name="customer" id="customer" class="form-control">
                                    <option value="">Select Customer</option>
                                    <?php foreach ($customers as $customer) { ?>
                                        <option class="customerValue" data-customerId="<?= $customer['id'] ?>" data-customerName="<?= $customer['firstname'] . " " . $customer['lastname'] ?>" value="<?= $customer['id'] ?>"><?= $customer['firstname'] . " " . $customer['lastname'] ?></option>
                                    <?php } ?>
                                </select>
                            <?php   }
                            echo form_error('customer'); ?>
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
                                <tbody class="added-item">
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
                    <button type="button" onclick="reload()" class="btn btn-danger">Cancel</button>
                    <button type="button" onclick="storeData()" class="btn btn-warning">Suspend</button>
                    <button type="button" class="btn btn-success" onclick="addPaymentDetails()" data-toggle="modal" data-target="#modal-default">Payment</button>
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
                                                                    <select name="customer_id" id="customer_id" class="form-control" disabled>
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
                                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-download"></i> Generate PDF
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
    var productArray = [];
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

        // Deleting an item from cart and updating cart
        $(document).on("click", ".deleteButton", function() {
            $(this).parent().parent().remove();
            var clickedItem = $(this).data('id');
            for (var i = 0; i < productArray.length; i++) {
                if (productArray[i].id === clickedItem) {
                    updateCart(); //Calling the update function before deleting the object
                    productArray.splice(i, 1);
                    i--;
                }
            }
        });
    });

    var fadeTime = 300;
    // Update Quantity when the input changes
    function updateQuantity(quantityInput) {
        var linePrice = 0;
        /* Calculate price */
        var productRow = $(quantityInput).parent().parent();
        var price = productRow.children('.price').attr('data-price');
        var id = productRow.children().children('.deleteButton').attr('data-id');
        var quantity = $(quantityInput).val();
        for (i = 0; i < productArray.length; i++) {
            if (productArray[i].id == id) { //Check if the item is already in the cart then show only once while updating the quanitity and price
                var newQuantity = quantity;
                productArray[i].quantity = newQuantity;
                var linePrice = productArray[i].actualPrice * newQuantity;
                productArray[i].price = linePrice;
                updateCart();
                inCart = 1;
            }
        }
        /* Update price display and recall updateCart */
        productRow.children('.price').each(function() {
            $(this).fadeOut(fadeTime, function() {
                $(this).text(linePrice);
                updateCart();
                $(this).fadeIn(fadeTime);
            });
        });
    }

    // This funciton every time when any action is perform in cart to update the cart
    function updateCart() {
        var totalPrice = 0;
        var totalQuantity = 0;

        // Getting quantity and price from each elements by using loop
        for (i = 0; i < productArray.length; i++) {

            // On change of quantity update price
            $('#' + productArray[i].id).find('.pass-quantity input').change(function() {
                updateQuantity(this);
            });

            $('#' + productArray[i].id).find(".pass-quantity input").each(function() {
                totalQuantity += parseFloat($(this).val());
            });

            $('#' + productArray[i].id).find(".price").each(function() {
                totalPrice += parseFloat($(this).html());
            });
            // console.log(totalPrice);

            // var priceTotal = '<input type="number" class=" form-control" value="' + totalPrice + '" >';
            // var quantityTotal = '<input type="number" class=" form-control" value="' + totalQuantity + '">';

            $("#totalPrice").html(totalPrice);
            $("#totalQuantity").html(totalQuantity);
        }
        return productArray;
    }

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

    function remeberCustomers() {
        for (var i = 0, len = localStorage.length; i < len; i++) {
            var key = localStorage.key(i);
            var value = JSON.parse(localStorage[key]);
            suspendedData.push(value);
            var html = '<tr class="suspend" data-id=' + value.id + '><td>' + value.id + '</td><td>' + value.customer + '</td></tr></a>';
            $("#customer-details").append(html);
        }
        var customers = localStorage.length;
        $('.badge-primary').html(customers);
    }

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

    function addPaymentDetails() {
        var paymentDetails = [];
        paymentDetails = productArray;
        // console.log(paymentDetails);
        if (paymentDetails.length > 0) {
            var customer_id = $('#customer option:selected').val();
            var customer_name = $('#customer option:selected').text();
            var sale_amount = $("#totalPrice").html();
            var sale_quantity = $("#totalQuantity").html();
            var sold_by = <?= $user_id; ?>;
            $('#customer_id option:selected').val(customer_id);
            $('#customer_id option:selected').text(customer_name);
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
                type: "POST",
                url: "<?= base_url() . 'index.php/sale/create'; ?>",
                data: {
                    saleDetails: paymentDetails,
                    customer_id: customer_id,
                    sale_quantity: sale_quantity,
                    sale_amount: sale_amount,
                    sale_amount_paid: sale_amount_paid,
                    sold_by: sold_by,
                },
                cache: false,
                async: true,
                success: function(result) {
                    console.log("Ok");
                    // location.reload();
                    console.log(result);
                }
            });
        })
    }


    remeberCustomers();
</script>
<!-- <div id="toastsContainerTopRight" class="toasts-top-right fixed">
//     <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
//         <div class="toast-header"><strong class="mr-auto">Toast Title</strong><small>Subtitle</small><button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button></div>
//         <div class="toast-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</div>
//     </div>
// </div> -->