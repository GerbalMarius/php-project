<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = "products";

    public $timestamps = false;
    protected $fillable = ["title", "manufacturer", "model", "category", "image_data", "unit_price" , "discount", "total_units"];

    public static function image_str($id) :string{
        $product = Product::find($id);
        $compressed_data = $product->image_data;

        $deComp = gzuncompress($compressed_data);
        if ($deComp !== false) {
            // Decode Base64 string back to image data
            $imageData = base64_decode($deComp);
            if ($imageData !== false) {
                // Output the image using a data URL
                return '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="' . htmlspecialchars($product->title) . '" style="width:200px;height:200px;">';
            } else {
                return "Error decoding image.";
            }
        } else {
            return "Error decompressing image.";
        }
    }

    public function carts(){
        return $this->belongsToMany(Cart::class, "cart_products")
                                    ->withPivot("quantity", "price");
    }
}