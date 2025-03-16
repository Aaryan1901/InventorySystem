<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <?php if ($is_admin == true) : ?>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $total_products ?></h3>
              <p>Total Products</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('products/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $total_paid_orders ?></h3>
              <p>Total Paid Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url('orders/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $total_users; ?></h3>
              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-people"></i>
            </div>
            <a href="<?php echo base_url('users/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $total_stores ?></h3>
              <p>Total Stores</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-home"></i>
            </div>
            <a href="<?php echo base_url('stores/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    <?php endif; ?>

    <!-- Graph Analytics Section -->
    <div class="row">
      <!-- Sales Analytics -->
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Sales Analytics</h3>
          </div>
          <div class="box-body">
            <canvas id="salesChart" style="height: 250px;"></canvas>
          </div>
        </div>
      </div>

      <!-- User Growth Analytics -->
      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">User Growth</h3>
          </div>
          <div class="box-body">
            <canvas id="userGrowthChart" style="height: 250px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- Product Category Distribution -->
      <div class="col-md-6">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Product Category Distribution</h3>
          </div>
          <div class="box-body">
            <canvas id="productCategoryChart" style="height: 250px;"></canvas>
          </div>
        </div>
      </div>

      <!-- Order Status Distribution -->
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Order Status Distribution</h3>
          </div>
          <div class="box-body">
            <canvas id="orderStatusChart" style="height: 250px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#dashboardMainMenu").addClass('active');

    // Sales Chart Data
    var salesData = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
        label: 'Sales',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        data: [28, 48, 40, 19, 86, 27, 90]
      }]
    };

    // User Growth Chart Data
    var userGrowthData = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
        label: 'New Users',
        backgroundColor: 'rgba(0,166,90,0.9)',
        borderColor: 'rgba(0,166,90,0.8)',
        data: [10, 25, 30, 40, 50, 60, 70]
      }]
    };

    // Product Category Distribution Data
    var productCategoryData = {
      labels: ["Electronics", "Clothing", "Home & Kitchen", "Books", "Toys"],
      datasets: [{
        label: 'Product Categories',
        backgroundColor: ['#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#ff851b'],
        data: [30, 20, 15, 10, 25]
      }]
    };

    // Order Status Distribution Data
    var orderStatusData = {
      labels: ["Paid", "Pending", "Cancelled", "Refunded"],
      datasets: [{
        label: 'Order Status',
        backgroundColor: ['#00a65a', '#f39c12', '#dd4b39', '#00c0ef'],
        data: [60, 20, 10, 10]
      }]
    };

    // Render the Sales Chart
    var salesChartCanvas = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(salesChartCanvas, {
      type: 'line',
      data: salesData,
      options: {
        maintainAspectRatio: false,
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Render the User Growth Chart
    var userGrowthChartCanvas = document.getElementById('userGrowthChart').getContext('2d');
    var userGrowthChart = new Chart(userGrowthChartCanvas, {
      type: 'bar',
      data: userGrowthData,
      options: {
        maintainAspectRatio: false,
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Render the Product Category Chart
    var productCategoryChartCanvas = document.getElementById('productCategoryChart').getContext('2d');
    var productCategoryChart = new Chart(productCategoryChartCanvas, {
      type: 'pie',
      data: productCategoryData,
      options: {
        maintainAspectRatio: false,
        responsive: true
      }
    });

    // Render the Order Status Chart
    var orderStatusChartCanvas = document.getElementById('orderStatusChart').getContext('2d');
    var orderStatusChart = new Chart(orderStatusChartCanvas, {
      type: 'doughnut',
      data: orderStatusData,
      options: {
        maintainAspectRatio: false,
        responsive: true
      }
    });
  });
</script>