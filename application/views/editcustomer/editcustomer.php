<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer</h1>
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
        <form name="addBrand" action="<?= base_url() . 'index.php/customer/edit/' . $customer['id']; ?>" method="post" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="firstname" class="form-control" value="<?= set_value('fisrtname', $customer['firstname']) ?>" placeholder="First Name">
                                        <?php echo form_error('firstname'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" class="form-control" value="<?= set_value('lastname', $customer['lastname']) ?>" placeholder="Last Name">
                                        <?php echo form_error('lastname'); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- radio -->

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="gender" value="Female" <?= $customer['gender'] ? "checked" : "" ?>>
                                            <label for="customRadio1" class="custom-control-label">Female</label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="gender" value="Male" <?= $customer['gender'] ? "checked" : "" ?>>
                                            <label for="customRadio2" class="custom-control-label">Male</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="tel" name="phone" value="<?= set_value('phone', $customer['phone']) ?>" class="form-control" placeholder="0300-1251002" pattern="[0-9]{4}-[0-9]{7}">
                                </div>
                                <?php echo form_error('phone'); ?>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" value="<?= set_value('email', $customer['email']) ?>" class="form-control" placeholder="Email">
                                </div>
                                <?php echo form_error('email'); ?>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Date of Birth</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" id="birthday" name="birthdate" value="<?= set_value('birthdate', $customer['birthdate']) ?>" class="form-control" name="birthday">
                                </div>
                                <?php echo form_error('birthdate'); ?>
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="country" value="<?= set_value('country', $customer['country']) ?>" class="form-control" placeholder="Country">
                                <?php echo form_error('country'); ?>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" value="<?= set_value('city', $customer['city']) ?>" class="form-control" placeholder="City">
                                <?php echo form_error('city'); ?>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" value="" class="form-control" rows="4" placeholder="Address"><?= set_value('address', $customer['address']) ?></textarea>
                                <?php echo form_error('address'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Photo</label><br>
                                <?php if (!empty($customer['photo'])) { ?>
                                    <img style="width: 200px; height:200px" src="<?= base_url() . '/public/images/customer/' . $customer['photo'] ?>" alt="Product Photo" />
                                <?php } else {
                                    echo "No image found."; ?>
                                <?php } ?><br><br>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="photo" id="photo" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose photo</label>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="form-group">
                            <div class="card-footer text-center">
                                <button class="btn btn-primary ">Update</button>
                                <a class="btn btn-secondary" href="<?= base_url() . 'index.php/customer' ?>">
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
<!-- /.content-wrapper -->