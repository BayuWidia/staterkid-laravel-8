<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Http\Requests\IsAdmin;

// =============== start default use request ===============
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseFormRequest;
// =============== end default use request ===============


class UserImportRequest extends BaseFormRequest
{

    /**
     * Determine if the user is authorized to make this request.
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
        switch($this->method())
         {
             case 'GET':
             {
                 return [];
             }

             case 'POST':
             {
                 return [
                     'file' => 'required|mimes:csv,xls,xlsx',
                 ];
             }

             case 'PUT':
             {
                 return [];
             }

             case 'PATCH':
             {
                 return [];
             }

             case 'DELETE':
             {
                 return [];
             }

             default:break;
         }
     }

    /**
     * Custom message for validation
     *
     * @return array
     */
     public function messages()
     {
        switch($this->method())
         {
             case 'GET':
             {
                 return [];
             }

             case 'POST':
             {
                 return [
                     'file.required' => 'componentName is required!',
                     'file.mimes' => 'File Harus berupa csv,xls,xlsx',
                 ];
             }

             case 'PUT':
             {
                 return [];
             }

             case 'PATCH':
             {
                 return [];
             }

             case 'DELETE':
             {
                 return [];
             }

             default:break;
         }
     }

     /**
      * Custom filter for validation
      *
      * @return array
      */
     public function filters()
     {
         switch($this->method())
          {
              case 'GET':
              {
                  return [];
              }

              case 'POST':
              {
                  return [
                      'componentName' => 'trim',
                  ];
              }

              case 'PUT':
              {
                  return [];
              }

              case 'PATCH':
              {
                  return [];
              }

              case 'DELETE':
              {
                  return [];
              }

              default:break;
          }
     }
}
