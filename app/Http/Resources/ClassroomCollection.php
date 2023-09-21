<?php

namespace App\Http\Resources;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClassroomCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        $collection = $this->collection;

        foreach ($collection as $model) {
            $data [] = [
                'id' => $model->id,
                'name' => $model->name,
                'code' => $model->code,
                'cover_image' => $model->cover_image_url,
                'meats' => [
                    'section' => $model->section,
                    'room' => $model->room,
                    'subject' => $model->subject,
                    'theme' => $model->theme,
                    'students_count' => $model->students_count,
                ],
                'user' => [
                    'name' => $model->user?->name,
                ],
            ];
        }
        
        return $data;
    }
}
