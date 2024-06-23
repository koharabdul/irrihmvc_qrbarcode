<?php $this->load->view('template/backend_template/header'); ?>
<?php $this->load->view('template/backend_template/navbar'); ?>
<?php $this->load->view($content_view); ?>
<div class="row  border-bottom white-bg dashboard-header" style="display: none;" >
    <div class="col-md-12">
        <div class="row text-center">
            <div class="col-lg-6">
                <canvas id="doughnutChart2" width="80" height="80" style="margin: 18px auto 0"></canvas>
                <h5 >Kolter</h5>
            </div>
            <div class="col-lg-6">
                <canvas id="doughnutChart" width="80" height="80" style="margin: 18px auto 0"></canvas>
                <h5 >Maxtor</h5>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/backend_template/footer'); ?>

