<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    use HasFactory;

    protected $table ='site_images';
    protected $fillable = ['site_id', 'image_path','description'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    
}
