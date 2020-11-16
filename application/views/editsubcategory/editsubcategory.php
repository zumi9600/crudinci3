  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header   ">
          <div class="container-fluid">
              <div class="row mb-1 ">
                  <div class="col-sm-6">
                      <h1>Subategory</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('index.php/welcome') ?>">Home</a></li>
                          <li class="breadcrumb-item active">Subategory</li>
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
                          <form action="<?= base_url() . 'index.php/subcategory/edit/' . $subcategory['id']; ?>" method="post">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Name</label>
                                      <input type="text" class="form-control" value="<?= set_value('name', $subcategory['name']) ?>" name="name" id="exampleInputEmail1" placeholder="Enter brand name">
                                      <?php echo form_error('name'); ?>
                                  </div>
                                  <div class="form-group">
                                      <label>Select</label>
                                      <?php if (!empty($brands)) { ?>
                                          <select name="brand" id="brand" class="form-control">
                                              <option value="">Select Brand</option>
                                              <?php foreach ($brands as $brand) { ?>
                                                  <option value="<?= $brand['id'] ?>" <?= $subcategory['brand'] == $brand['id'] ? 'selected' : '' ?>><?= $brand['name'] ?></option>
                                              <?php } ?>
                                          </select>
                                      <?php   }
                                        echo form_error('brand'); ?>
                                  </div>
                                  <div class="form-group">
                                      <label>Select</label>
                                      <?php if (!empty($brands)) { ?>
                                          <select name="category" id="category" class="form-control">
                                              <option value="">Select Brand</option>
                                              <?php foreach ($categories as $category) { ?>
                                                  <option value="<?= $category['id'] ?>" <?= $subcategory['category'] == $category['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                              <?php } ?>
                                          </select>
                                      <?php   }
                                        echo form_error('category'); ?>
                                  </div>
                              </div>

                              <!-- /.card-body -->
                              <div class="form-group">
                                  <div class="card-footer text-center">
                                      <button class="btn btn-primary ">Update</button>
                                      <a class="btn btn-secondary" href="<?= base_url() . 'index.php/subcategory' ?>">Cancel</a>
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

      });
  </script>