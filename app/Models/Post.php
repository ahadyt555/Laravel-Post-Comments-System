<?php
namespace App\Models;
use App\Http\Controllers\PostController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Post extends Model {
    public function user():
        BelongsTo {
            return $this->belongsTo(User::class, 'user_id');
        }
        use HasFactory;
        protected $guarded = ['id'];
    }
    