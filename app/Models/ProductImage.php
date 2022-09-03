<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_images';

    protected $guarded=[];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function saveNewProductImages($product, $productImage, $imageURL)
    {
        $productImage->product_id   = $product->id;
        $productImage->pi_sub_image = $imageURL;

        $productImage->save();
    }
}
