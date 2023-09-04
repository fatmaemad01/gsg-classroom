<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Auth\Access\Response;

class ClassworkPolicy
{

    public function viewAny(User $user, Classroom $classroom): bool
    {
        // Check if the user is associated with the given classroom
        return $user->classrooms()
            ->wherePivot('classroom_id', $classroom->id)
            ->exists();
    }



    public function view(User $user, Classwork $classwork): bool
    {
        // Check if the user is a teacher of the associated classroom
        $teacher = $user->classrooms()
            ->wherePivot('classroom_id', $classwork->classroom_id)
            ->wherePivot('role', 'teacher')->exists();

        // Check if the user is assigned to the classwork
        $assigned = $user->classworks()
            ->wherePivot('classwork_id', $classwork->id)
            ->exists();

        // Return true if the user is a teacher or assigned to the classwork
        return ($teacher || $assigned);
    }



    public function create(User $user, Classroom $classroom): bool
    {
        $result =  $user->classrooms()
            ->withoutGlobalScope(UserClassroomScope::class)
            ->wherePivot('classroom_id', $classroom->id)
            ->wherePivot('role', 'teacher')->exists();

        return $result;
    }



    public function update(User $user, Classwork $classwork): bool
    {
        // Check if the user is a teacher of the associated classroom
        return  $user->classrooms()
            ->wherePivot('classroom_id', $classwork->classroom_id)
            ->wherePivot('role', 'teacher')->exists();
    }



    public function delete(User $user, Classwork $classwork): bool
    {
        return  $user->classrooms()
            ->wherePivot('classroom_id', $classwork->classroom_id)
            ->wherePivot('role', 'teacher')->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Classwork $classwork): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Classwork $classwork): bool
    // {
    //     //
    // }
}
