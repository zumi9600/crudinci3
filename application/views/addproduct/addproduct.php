<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
            <hr>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form name="addBrand" action="<?= base_url() . 'index.php/product/create' ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" name="name" value="<?= set_value('name') ?>" class="form-control">
                                <?php echo form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription"> Price</label>
                                <input type="number" id="inputName" name="price" value="<?= set_value('price') ?>" class="form-control">
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
                                <input type="number" id="inputClientCompany" name="quantity" value="<?= set_value('quantity') ?>" class="form-control">
                                <?= form_error('quantity'); ?>
                            </div>

                            <div class="form-group">
                                <label>Brand</label>
                                <?php if (!empty($brands)) { ?>
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select Brand</option>
                                        <?php foreach ($brands as $brand) { ?>
                                            <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                <?php   }
                                echo form_error('brand'); ?>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                </select>
                                <?php echo form_error('category'); ?>
                            </div>
                            <div class="form-group">
                                <label>Subcategory</label>
                                <select name="subcategory" id="subcategory" class="form-control">
                                    <option value="">Select Subcategory</option>
                                </select>
                                <?php echo form_error('subcategory'); ?>
                            </div>
                            <div class="form-group">
                                <label>Photo</label><br>
                                <input type="file" id="photo" name="photo">
                            </div>
                            <div class="form-group">
                                <label>Photos</label><br>
                                <input type="file" id="files" name="files[]" multiple>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="form-group">
                            <div class="card-footer text-center">
                                <button class="btn btn-primary ">Add</button>
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
</script>