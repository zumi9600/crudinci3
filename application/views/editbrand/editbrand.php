  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header   ">
          <div class="container-fluid">
              <div class="row mb-1 ">
                  <div class="col-sm-6">
                      <h1>Brand</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('index.php/welcome') ?>">Home</a></li>
                          <li class="breadcrumb-item active">Brand</li>
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
                              <h3 class="card-title">Edit</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="<?= base_url() . 'index.php/brand/edit/' . $brand['id']; ?>" method="post">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Name</label>
                                      <input type="text" class="form-control" value="<?= set_value('name', $brand['name']) ?>" name="name" id="exampleInputEmail1" placeholder="Enter brand name">
                                      <?php echo form_error('name'); ?>
                                  </div>
                              </div>
                              <!-- /.card-body -->
                              <div class="form-group">
                                  <div class="card-footer text-center">
                                      <button class="btn btn-primary ">Update</button>
                                      <a class="btn btn-secondary" href="<?= base_url() . 'index.php/brand' ?>">Cancel</a>
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