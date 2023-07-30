

<?php $__env->startSection('title', 'Karyawan'); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-12">
            <p class="text-muted">
                <i class="fa fa-home px-1"></i> Home
                <i class="fa fa-angle-right px-2"></i> Absensi
            </p>
            <div class="d-flex pb-2"> 
                <div class="">
                    <form action="<?php echo e(route('karyawan.index')); ?>" class="search-form" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="<?php echo e(request()->search); ?>">
                            <button class="btn btn-outline-primary" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="ms-auto">
                    <?php if(Auth::user()->username == "staff"): ?>
                        <a class="btn btn-success" href="<?php echo e(route('karyawan.create')); ?>"> 
                            <span class="fa fa-plus"></span> Tambah Karyawan
                        </a>    
                    <?php endif; ?>     
                </div>
            </div>

            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>                    
                            <th class="nomor-urut">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tempat</th>
                            <th>Tgl Lahir</th>
                            <th>Gender</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th> 
                            <th>Tgl Masuk</th>   
                            <th>BPJS</th>   
                            <th>Cetak</th>  
                            <th>Edit</th>  
                            <th>Del</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datae): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="tablecenter nomor-urut"><?php echo e(++$i); ?></td>
                            <td class="tablecenter"><?php echo e($datae->nik); ?></td>
                            <td class="tableleft"><?php echo e($datae->nama); ?></td>
                            <td class="tableleft"><?php echo e($datae->tempat_lahir); ?></td>
                            <td class="tablecenter"><?php echo e($datae->tgl_lahir); ?></td>
                            <td class="tableleft"><?php echo e(($datae->gender == "L") ? "Laki - Laki" : "Perempuan"); ?></td>
                            <td class="tablecenter"><?php echo e($datae->jabatan); ?></td>
                            <td class="tablecenter"><?php echo e($datae->status); ?></td>
                            <td class="tablecenter"><?php echo e(number_format($datae->gaji_pokok ,0, ',', '.')); ?></td> 
                            <td class="tablecenter"><?php echo e(number_format($datae->tunjangan ,0, ',', '.')); ?></td> 
                            <td class="tablecenter"><?php echo e($datae->tgl_masuk); ?></td>
                            <td class="tableleft"><?php echo e(($datae->bpjs == "Y") ? "Ya" : "Tidak"); ?></td>                              
                            <td class="tablecenter">   
                                <?php if(Auth::user()->username == "staff"): ?>
                                    <a class="btn btn-sm btn-info" href="<?php echo e(route('karyawan.show',$datae->id)); ?>"><span class="fa fa-print"></span> Print</a>
                                <?php endif; ?>    
                            </td>  
                            <td class="tablecenter">   
                                <?php if(Auth::user()->username == "staff"): ?>          
                                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('karyawan.edit',$datae->id)); ?>"><span class="fa fa-pencil"></span> Edit</a> 
                                <?php endif; ?>    
                            </td>  
                            <td class="tablecenter">   
                                <?php if(Auth::user()->username == "staff"): ?>
                                    <form action="<?php echo e(route('karyawan.destroy',$datae->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>                                                
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="fa fa-times"></span> Del</button>
                                    </form>
                                <?php endif; ?>    
                            </td>                   
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>                    
            </div>            
                        
            <div class="pt-2 ps-2">
                <?php echo $karyawan->links(); ?>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp816\htdocs\payrollbhs\resources\views/karyawan/index.blade.php ENDPATH**/ ?>