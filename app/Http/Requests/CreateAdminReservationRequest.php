<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'sheet_id' => ['required','unique:reservations,sheet_id,NULL,id,schedule_id,' . $this->schedule_id],
            'name' => ['required'],
            'email' => ['required', 'email:strict,dns'],
        ];
    }
}
