<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAdminReservationRequest extends FormRequest
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
        return [
            'movie_id' => ['required'],
            'schedule_id' => ['required'],
            'sheet_id' => [
                'required',
                Rule::unique('reservations')
                    ->where('schedule_id', $this->schedule_id)
                    ->where('screen_id', $this->screen_id)
            ],
            'name' => ['required'],
            'email' => ['required', 'email:strict,dns'],
        ];
    }
}
