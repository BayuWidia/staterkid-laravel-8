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

class ManagementRoleRequest extends BaseFormRequest
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
                    'roleName' => 'required|string|min:1|max:50',
                    'description' => 'required|string|min:1|max:50',
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
                    'roleName.required' => 'role name is required!',
                    'roleName.min' => 'Untuk role name minimal 1 karakter',
                    'roleName.max' => 'Untuk role name maximal 50 karakter',
                    'roleName.string' => 'Untuk role name hanya karakter berlaku saja',
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
                    'roleName' => 'trim',
                    'description' => 'trim',
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
