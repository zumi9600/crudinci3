<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/welcome') ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url('index.php/product') ?>">Products</a></li>
                        <li class="breadcrumb-item active">Edit</li>

                    </ol>
                </div>
            </div>
            <hr>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form name="addProduct" action="<?= base_url() . 'index.php/product/edit/' . $product['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" name="name" value="<?= set_value('name', $product['name']) ?>" class="form-control">
                                <?php echo form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription"> Price</label>
                                <input type="text" id="inputName" name="price" value="<?= set_value('price', $product['price']) ?>" class="form-control">
                                <?php echo form_error('price'); ?>
                            </div>
                            <!-- <div class="form-group">
                            <label for="inputStatus">Status</label>
                            <select class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option>Success</option>
                            </select>
                            </div> -->
                            <div class="form-group">
                                <label for="inputClientCompany"> Quantity</label>
                                <input type="text" id="inputClientCompany" name="quantity" value="<?= set_value('quantity', $product['quantity']) ?>" class="form-control">
                                <?= form_error('quantity'); ?>
                            </div>
                            <div class="form-group">
                                <label>Brand</label>
                                <?php if (!empty($brands)) { ?>
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select Brand</option>
                                        <?php foreach ($brands as $brand) { ?>
                                            <option value="<?= $brand['id'] ?>" <?= $product['brand'] == $brand['id'] ? 'selected' : '' ?>><?= $brand['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                <?php   }
                                echo form_error('brand'); ?>
                            </div>
                            <div class="form-group">
                                <label> Category</label>
                                <?php if (!empty($categories)) { ?>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?= $category['id'] ?>" <?= $product['category'] == $category['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                <?php   }
                                echo form_error('category'); ?>
                            </div>
                            <div class="form-group">
                                <label>Subcategory</label>
                                <?php if (!empty($subcategories)) { ?>
                                    <select name="subcategory" id="subcategory" class="form-control">
                                        <option value="">Select Subcategory</option>
                                        <?php foreach ($subcategories as $subcategory) { ?>
                                            <option value="<?= $subcategory['id'] ?>" <?= $product['subcategory'] == $subcategory['id'] ? 'selected' : '' ?>><?= $subcategory['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                <?php   }
                                echo form_error('subcategory'); ?>
                            </div>
                            <div class="form-group">
                                <?php if (!empty($product['photo'])) { ?>
                                    <img style="width: 200px; height:200px" src="<?= base_url() . '/public/images/product/' . $product['photo'] ?>" alt="Product Photo" />
                                <?php } else {
                                    echo "No image found."; ?>
                                <?php } ?>
                                <br><label>Photo</label><br>
                                <input type="file" id="photo" name="photo">
                                <hr>
                            </div>
                            <div class="form-group">
                                <?php if (!empty($photos)) { ?>
                                    <?php foreach ($photos as $photo) { ?>
                                        <div id="<?= $photo['id'] ?>">
                                            <img class="img-responsive" style="width: 200px; height:200px" src="<?= base_url() . '/public/images/product/' . $photo['name'] ?>" alt="Product Photo" /><br>
                                            <a onclick="deleteImage(<?= $photo['id'] ?>)" class="btn btn-danger btn-sm">Delete <i class="fa fa-trash"></i></a><br>
                                            <!-- <a class="btn btn-danger"><i class="fas fa-trash"></i></a> -->
                                        </div>
                                <?php }
                                } else {
                                    echo "No images found.";
                                } ?>
                                <br><label>Photos</label><br>
                                <input type="file" id="files" name="files[]" multiple>

                            </div>
                            <div class="form-group">
                                <div class="card-footer text-center">
                                    <button class="btn btn-primary ">Update</button>
                                    <a class="btn btn-secondary" href="<?= base_url() . 'index.php/product' ?>">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // Fetching categories by brand
        $('#brand').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url() . 'index.php/subcategory/getCategory'; ?>",
                method: "POST",
                data: {
                    id: id,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '<option>Select Category</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].name + '</option>';
                    }
                    $('#category').html(html);

                }
            });
            return false;
        });
        // Fetching subcategories by category
        $('#category').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url() . 'index.php/subcategory/getSubcategory'; ?>",
                method: "POST",
                data: {
                    id: id,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '<option>Select Subcategory</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].name + '</option>';
                    }
                    $('#subcategory').html(html);

                }
            });
            return false;
        });
    });
    // Delete product images from db
    function deleteImage(id) {
        if (confirm('Photo will be permanently deleted. Are you sure?') == true) {
            // alert($id);
            $.ajax({
                url: "<?= base_url() . 'index.php/product/deleteImage'; ?>",
                method: "post",
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == 1) {
                        alert('Image Deleted Successfully.');
                    } else {
                        alert('Deletion Failed');
                    }
                }
            })
        }
    }
</script>