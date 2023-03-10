<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'cover',
        'description',
        'price',
        'authors_id',
        'genres_id',
        'stock',
    ];

    public function rules() {
        return [
            'name' => 'required|unique:books,name,'.$this->id.'|min:3',
            'cover' => 'file',
            'description' => 'required',
            'price' => 'required',
            'authors_id' => 'required|integer',
            'genres_id' => 'required|integer',
            'stock' => 'required|integer'
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'file' => 'O campo :attribute precisa ser um arquivo',
            'integer' => 'O valor de :attribute precisa ser um número inteiro',
            'name.unique' => 'O nome do livro já existe',
            'name.min' => 'O nome deve ter no minímo 3 caracteres'
        ];
    }

    /**
     * Summary of authors
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authors() : BelongsTo 
    {
        // 1-N - Um livro pertence a um autor
        return $this->belongsTo('App\Models\Authors');
    }

    /**
     * Summary of genres
     * @return BelongsTo
     */
    public function genres() : BelongsTo
    {
        // 1-N - Um livro pertence a um autor
        return $this->belongsTo('App\Models\Genres');
    }
}