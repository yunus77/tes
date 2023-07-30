

<?php $__env->startSection('title', 'Detail Karyawan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Detail Karyawan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?php echo e(route('karyawan.index')); ?>"> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NIK:</strong>
                <?php echo e($karyawan->nik); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama:</strong>
                <?php echo e($karyawan->nama); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tempat & Tgl lahir:</strong>
                <?php echo e($karyawan->tempat_lahir); ?> , <?php echo e($karyawan->tgl_lahir); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Kelamin:</strong>
                <?php echo e(($karyawan->gender == "L") ? "Laki - Laki" : "Perempuan"); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jabatan:</strong>
                <?php echo e($karyawan->jabatan); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                <?php echo e($karyawan->status); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Gaji Pokok:</strong>
                <?php echo e(number_format($karyawan->gaji_pokok ,0, ',', '.')); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tunjangan:</strong>
                <?php echo e(number_format($karyawan->tunjangan ,0, ',', '.')); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tgl masuk kerja:</strong>
                <?php echo e($karyawan->tgl_masuk); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>BPJS:</strong>
                <?php echo e(($karyawan->bpjs == "Y") ? "Ya" : "Tidak"); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp816\htdocs\payrollbhs\resources\views/karyawan/show.blade.php ENDPATH**/ ?>