<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Boolean;

class StoreAdvertisementRequest extends FormRequest
{
    /**
     * Determine if the usersTableSeeder is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'url' => 'required|file|mimes:mp4,mov,ogg,webm,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|max:2000',
            'screens' => 'required',
            'classes' => 'nullable',
        ];
    }
    
    public function messages()
      {
        return [            
          'url.required' => "You must use the 'Choose file' button to select which file you wish to upload",
          'url.max' => "Maximum file size to upload is 2MB (2192 KB). If you are uploading a photo, try to reduce its resolution to make it under 2MB"
        ];
      }
}
