<?php

namespace App\Http\Requests\Livre;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class LivreModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return env('APP_ENV') === 'testing'
            ? true
            : Auth::user()->can('livre-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @example https://laravel.com/docs/validation#available-validation-rules
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $rules['title'] = ['string', 'required', Rule::unique('livres')->ignore(request('id'))];
        $rules['author'] = 'string|required';
        $rules['description'] = 'string|required';
        $rules['release_date'] = 'date_format:d/m/Y|required';
        $rules['price'] = 'numeric|min:1|max:999999.99|nullable';

        // $rules['files.*'] = ['nullable', 'file', 'max:10240'];
        // $rules['telephone_mobile'] = 'nullable|digits:10';

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'price' => 'Le prix n’est pas valide',
            'price.min' => 'Le prix doit être au moins de :min€',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'price' => supprimer_decoration($this->price),
            // 'telephone_mobile' => $this->telephone_mobile = str_replace(' ', '', $this->telephone_mobile),
        ]);
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation()
    {
        $this->merge([
            'release_date' => Carbon::createFromFormat('d/m/Y', $this->release_date)->format('Y-m-d'),
        ]);
    }
}
