<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','assunto','user_id','user_name','user_setor','nivel_de_prioridade','is_resolved','feedback','rating'];

    public function user()
    {
           return $this->belongsTo(User::class);
    }
}
