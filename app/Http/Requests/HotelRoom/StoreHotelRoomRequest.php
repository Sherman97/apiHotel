<?php

namespace App\Http\Requests\HotelRoom;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_type_id' => 'required|exists:room_types,id',
            'accommodation_id' => 'required|exists:accommodations,id',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
