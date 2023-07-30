

<?php $__env->startSection('title', 'Payroll'); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-12">
            <p class="text-muted">
                <i class="fa fa-home px-1"></i> Home
                <i class="fa fa-angle-right px-2"></i> Payroll
            </p>
            <div class="d-flex pb-2"> 
                <div class="">
                    <form action="<?php echo e(route('payroll.index')); ?>" class="search-form" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="<?php echo e(request()->search); ?>">
                            <button class="btn btn-outline-primary" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="ms-auto">   
                </div>
            </div>
            
            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="nomor-urut">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Lama Kerja</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Hari Efektif</th>
                            <th>Masuk Kerja</th>
                            <th>Bolos</th> 
                            <th>Lembur</th> 
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Insentif</th>
                            <th>Upah Lembur</th> 
                            <th>NPWP</th> 
                            <th>BPJS</th> 
                            <th>Total Gaji</th> 
                            <th>Valid</th> 
                            <th>Export</th> 
                            <th>Hapus</th> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $payroll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datae): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="tablecenter nomor-urut"><?php echo e(++$i); ?></td>
                            <td class="tablecenter"><?php echo e($datae->nik); ?></td>
                            <td class="tableleft"><?php echo e($datae->nama); ?></td>
                            <td class="tableleft"><?php echo e($datae->status); ?></td>
                            <td class="tablecenter"><?php echo e($datae->lama_kerja); ?> Thn</td>
                            <td class="tablecenter"><?php echo e($datae->tahun); ?></td>
                            <td class="tablecenter"><?php echo e($datae->bulan); ?></td>
                            <td class="tablecenter"><?php echo e($datae->hari_efektif); ?></td>
                            <td class="tablecenter"><?php echo e($datae->hari_kerja); ?></td>
                            <td class="tablecenter"><?php echo e(($datae->bolos != 0) ? $datae->bolos." Hari" : "-"); ?></td>
                            <td class="tablecenter"><?php echo e(($datae->jam_lembur != 0) ? $datae->jam_lembur ." Jam" : "-"); ?></td>
                            <td class="tablecenter"><?php echo e(number_format($datae->gaji_pokok ,0, ',', '.')); ?></td> 
                            <td class="tablecenter"><?php echo e(number_format($datae->tunjangan ,0, ',', '.')); ?></td> 
                            <td class="tablecenter"><?php echo e(number_format($datae->insentif ,0, ',', '.')); ?></td> 
                            <td class="tablecenter"><?php echo e(number_format($datae->upah_lembur ,0, ',', '.')); ?></td> 
                            <td class="tablecenter"><?php echo e(number_format($datae->npwp ,0, ',', '.')); ?></td> 
                            <td class="tablecenter"><?php echo e(number_format($datae->bpjs ,0, ',', '.')); ?></td> 
                            <td class="tablecenter"><?php echo e(number_format($datae->total_gaji ,0, ',', '.')); ?></td>
                            <td class="tablecenter">
                                <?php if($datae->valid=="Y"): ?>
                                    <span class="text-success fa fa-check" data-bs-toggle="tooltip" title="sudah di Validasi" style="font-size:18px;"></span>
                                <?php else: ?> 
                                    <?php if(Auth::user()->username == "supervisor"): ?>
                                        <form action="<?php echo e(route('payroll.store')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>       
                                            <input type="hidden" name="idx" value="<?php echo e($datae->id); ?>">                                    
                                            <button type="submit" class="btn btn-sm btn-success validasi"><span class="fa fa-check"></span></button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>  
                            <td class="tablecenter">   
                                <?php if(Auth::user()->username == "staff"): ?>
                                    <a class="btn btn-sm btn-warning" href="<?php echo e(route('payroll.show',$datae->id)); ?>"><span class="fa fa-file-pdf-o"></span> Pdf</a>
                                <?php endif; ?>    
                            </td>  
                            <td class="tablecenter">
                                <?php if(Auth::user()->username == "staff"): ?>
                                    <form action="<?php echo e(route('payroll.destroy',$datae->id)); ?>" method="POST">
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
                <?php echo $payroll->links(); ?>

            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".validasi").submit(function(e) {
                console.log("dd");
                $(this).html('<span class="spinner-border spinner-border-sm"></span>'); 
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp816\htdocs\payrollbhs\resources\views/payroll/index.blade.php ENDPATH**/ ?>