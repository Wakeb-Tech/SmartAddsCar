<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdverisementRequest extends FormRequest
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
            'url' => 'nullable|file|mimes:mp4,mov,ogg,webm,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|max:25000',
            'screens' => 'required',
            'classes' => 'nullable',
        ];
    }
    
    public function messages()
      {
        return [            
          'url.required' => "You must use the 'Choose file' button to select which file you wish to upload",
          'url.max' => "Maximum file size to upload is 25MB . try to reduce it to make it under 25MB"
        ];
      }
      
}
