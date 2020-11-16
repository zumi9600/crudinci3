  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header   ">
          <div class="container-fluid">
              <div class="row mb-1 ">
                  <div class="col-sm-6">
                      <h1>Category</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('index.php/welcome') ?>">Home</a></li>
                          <li class="breadcrumb-item active">Add</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                      <!-- general form elements -->
                      <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title">Add</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="<?= base_url('index.php/category/create') ?>" method="post">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Name</label>
                                      <input type="text" class="form-control" name="name" value="<?= set_value('name') ?>" id="exampleInputEmail1" placeholder="Enter category name">
                                      <?php echo form_error('name'); ?>
                                  </div>
                                  <div class="form-group">
                                      <label>Brand</label>
                                      <?php if (!empty($brands)) { ?>
                                          <select name="brand" class="form-control">
                                              <option value="">Select Brand</option>
                                              <?php foreach ($brands as $brand) { ?>
                                                  <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                                              <?php } ?>
                                          </select>
                                      <?php   }
                                        echo form_error('brand'); ?>
                                  </div>
                              </div>
                              <!-- /.card-body -->
                              <div class="form-group">
                                  <div class="card-footer text-center">
                                      <button class="btn btn-primary ">Add</button>
                                      <a class="btn btn-secondary" href="<?= base_url() . 'index.php/category' ?>">Cancel</a>
                                  </div>
                              </div>
                          </form>
                      </div>
                      <!-- /.card -->

                      <!-- Form Element sizes -->

                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              </div>
              <!--/.col (right) -->
          </div>
          <!-- /.row -->
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->