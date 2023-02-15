<?php

namespace Adamsafr\FormRequestBundle\Http;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;

class FormRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return null|Constraint
     */
    public function rules()
    {
        return null;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData(): array
    {
        return $this->all();
    }

    /**
     * The validation groups to validate.
     *
     * @return array
     */
    public function validationGroups(): array
    {
        return [];
    }

    public function validated() : array
    {
        $rules = $this->rules();
        $validationData = $this->validationData();

        if (!$rules instanceof Collection) {
            return $validationData;
        }

        $validated = [];

        foreach (array_keys($rules->fields) as $field) {
            if (isset($validationData[$field])) {
                $validated[$field] = $validationData[$field];
            }
        }

        return $validated;
    }
}
