<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
   
class Karyawan extends Model
{
    protected $table="karyawan";
    protected $guarded = ['id'];

    public function scopeSearch($q)
    {
        return empty(request()->search) ? $q : $q->where('nik', 'like', '%'.request()->search.'%')
                                                ->orWhere('nama', "like", "%" . request()->search . "%")
                                                ->orWhere('status', "like", "%" . request()->search . "%")
                                                ->orWhere('jabatan', "like", "%" . request()->search . "%");
    }

}