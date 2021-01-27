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

class ManagementUserRequest extends BaseFormRequest
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
                    'roleId' => 'required',
                    'username' => 'required',
                    'fullname' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'urlPhoto' => 'image|mimes:jpeg,jpg,png|max:20000'

                ];
            }

            case 'PUT':
            {
                return [
                    'roleIdEdit' => 'required',
                    'usernameEdit' => 'required',
                    'fullnameEdit' => 'required',
                    'emailEdit' => 'required',
                    'urlPhotoEdit' => 'image|mimes:jpeg,jpg,png|max:20000'
                ];
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
                        'roleId.required' => 'Wajib Role di isi',
                        'username.required' => 'Wajib Username di isi',
                        'fullname.required' => 'Wajib Fullname di isi',
                        'email.required' => 'Wajib Email di isi',
                        'password.required' => 'Wajib Password di isi',
                        'urlPhoto.image' => 'File upload harus image.',
                        'urlPhoto.mimes' => 'Ekstensi file tidak valid.',
                        'urlPhoto.max' => 'Ukuran file terlalu besar.'
                ];
            }

            case 'PUT':
            {
                return [
                        'roleIdEdit.required' => 'Wajib Roleaa di isi',
                        'usernameEdit.required' => 'Wajib Username di isi',
                        'fullnameEdit.required' => 'Wajib Fullname di isi',
                        'emailEdit.required' => 'Wajib Email di isi',
                        'urlPhotoEdit.image' => 'File upload harus image.',
                        'urlPhotoEdit.mimes' => 'Ekstensi file tidak valid.',
                        'urlPhotoEdit.max' => 'Ukuran file terlalu besar.'
                ];
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
                        'roleId' => 'trim',
                        'username' => 'trim',
                        'fullname' => 'trim',
                        'email' => 'trim',
                        'password' => 'trim',
                ];
            }

            case 'PUT':
            {
                return [
                        'roleIdEdit' => 'trim',
                        'usernameEdit' => 'trim',
                        'fullnameEdit' => 'trim',
                        'emailEdit' => 'trim',
                        'statusEdit' => 'trim',
                ];
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
