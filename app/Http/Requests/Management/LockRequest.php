<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseFormRequest;

class LockRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

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
                    'password' => 'required|min:3|max:50',
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
                     'password.required' => 'Password is required!',
                     'password.min' => 'Untuk Password minimal 3 karakter',
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
                      'password' => 'trim',
                      // 'email' => 'trim|lowercase',
                      // 'name' => 'trim|capitalize|escape'
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
