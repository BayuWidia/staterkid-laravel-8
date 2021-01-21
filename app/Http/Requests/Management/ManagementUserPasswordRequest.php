<?php

/**
 * full-stack-developer
 * @author https://github.com/BayuWidia
 * Jakarta 01-Juli-2020
 */

namespace App\Http\Requests\Management;

// =============== start default use request ===============
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseFormRequest;
// =============== end default use request ===============

class ManagementUserPasswordRequest extends BaseFormRequest
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
                         'fullname' => 'required',
                         'oldPassword' => 'required',
                         'password' => 'required',
                         'passwordConfirmation' => 'required'
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
                         'fullname.required' => 'Fullname harus diisi.',
                         'oldPassword.required' => 'Password lama harus diisi.',
                         'password.required' => 'Password baru harus diisi.',
                         'passwordConfirmation.required' => 'Konfirmasi password baru harus diisi.',
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
                          'fullname' => 'trim',
                          'oldPassword' => 'trim',
                          'password' => 'trim',
                          'passwordConfirmation' => 'trim'
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
