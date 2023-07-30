

<?php $__env->startSection('title', 'Edit Karyawan'); ?>

<?php $__env->startSection('content'); ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mainbox">
                <div class="card-header">
                    <div class="pull-left">
                        Edit Karyawan
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info" href="<?php echo e(route('karyawan.index')); ?>"><span class="fa fa-chevron-left"></span> Back</a>
                    </div>
                </div>
                <div class="card-body mainbox-form">            

                    <form id="myform" class="row p-0" action="<?php echo e(route('karyawan.update',$karyawan->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">NIK</label>
                            <div class="col-9">
                                <input class="form-control" type="text"name="nik" value="<?php echo e($karyawan->nik); ?>" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Nama</label>
                            <div class="col-9">
                                <input class="form-control" type="text"name="nama" value="<?php echo e($karyawan->nama); ?>" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tempat Lahir</label>
                            <div class="col-9">
                                <input class="form-control" type="text"name="tempat_lahir" value="<?php echo e($karyawan->tempat_lahir); ?>" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tgl Lahir</label>
                            <div class="col-9">
                                <div class="input-group">                                    
                                    <input type="text" name="tgl_lahir" class="form-control start-date pe-3" value="<?php echo e($karyawan->tgl_lahir); ?>" required/>
                                    <span class="input-group-text">
                                    <i class="fa fa-calendar fa-fw text-muted"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-9">
                                <select class="form-select" name="gender" required>
                                    <option value="L" <?php echo e($karyawan->gender=='L' ? 'selected' : ''); ?>>Laki - Laki</option>
                                    <option value="P" <?php echo e($karyawan->gender=='P' ? 'selected' : ''); ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Jabatan</label>
                            <div class="col-9">
                                <select class="form-select" name="jabatan" required>
                                    <option value="supervisor" <?php echo e($karyawan->jabatan=='supervisor' ? 'selected' : ''); ?>>Supervisor</option>
                                    <option value="staff" <?php echo e($karyawan->jabatan=='staff' ? 'selected' : ''); ?>>Staff</option>
                                    <option value="ob" <?php echo e($karyawan->jabatan=='ob' ? 'selected' : ''); ?>>OB</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Status Kerja</label>
                            <div class="col-9">
                                <select class="form-select" name="status" required>
                                    <option value="TETAP" <?php echo e($karyawan->status=='TETAP' ? 'selected' : ''); ?>>TETAP</option>
                                    <option value="KONTRAK" <?php echo e($karyawan->status=='KONTRAK' ? 'selected' : ''); ?>>KONTRAK</option>
                                    <option value="HL" <?php echo e($karyawan->status=='HL' ? 'selected' : ''); ?>>HL</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Gaji Pokok</label>
                            <div class="col-9">
                                <input class="form-control" type="number" step="any" name="gaji_pokok" value="<?php echo e($karyawan->gaji_pokok); ?>" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tunjangan</label>
                            <div class="col-9">
                                <input class="form-control" type="number" step="any" name="tunjangan" value="<?php echo e($karyawan->tunjangan); ?>" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tgl Masuk Kerja</label>
                            <div class="col-9">
                                <div class="input-group">                                    
                                    <input type="text" name="tgl_masuk" class="form-control start-date pe-3" value="<?php echo e($karyawan->tgl_masuk); ?>" required/>
                                    <span class="input-group-text">
                                    <i class="fa fa-calendar fa-fw text-muted"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Pakai BPJS</label>
                            <div class="col-9">
                                <select class="form-select" name="bpjs" required>
                                    <option disable selected hidden></option>
                                    <option value="Y" <?php echo e($karyawan->bpjs=='Y' ? 'selected' : ''); ?>>Ya</option>
                                    <option value="N" <?php echo e($karyawan->bpjs=='N' ? 'selected' : ''); ?>>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <div class="col-9 offset-3">
                                <button type="submit" class="btn btn-success"> 
                                    <span class="fa fa-save"></span> Simpan
                                </button>
                                <span id="infoloading2" style="padding-bottom:5px;"></span>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp816\htdocs\payrollbhs\resources\views/karyawan/edit.blade.php ENDPATH**/ ?>