<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
trait UploadImageTrait {
    public function uploadImage(Request $request, $folder, $fieldname = 'image')
    {
        if ($request->hasFile($fieldname) && $request->file($fieldname)->isValid()) {
            $image = $request->file($fieldname);
            $extension = $image->getClientOriginalExtension();
            $imageName = Str::uuid() . '.' . $extension;
            return $image->storeAs($folder, $imageName, 'public');
        }
        return null;
    }
}
