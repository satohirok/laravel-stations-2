<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateReservationRequest extends FormRequest
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
            'schedule_id' => ['required'],
            'screen_id' => ['required'],
            'user_id' => ['required'],
            'date' => ['required', 'date_format:Y-m-d'],
            'sheet_id' => [
            'required',
            // schedule_id, sheet_id, screen_id の組み合わせで一意性を確認
            Rule::unique('reservations')
                ->where('schedule_id', $this->schedule_id)
                ->where('sheet_id', $this->sheet_id)
                ->where('screen_id', $this->screen_id)
            ],
        ];
    }
}
