<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'status', 'task_date', 'created_at', 'is_archived'];

    /**
     * Fetch tasks scheduled for today's date
     */
    public function getTodayTasks()
    {
        $today = date('Y-m-d');
        return $this->where('task_date', $today)
            ->where('is_archived', 0)
            ->findAll();
    }

    /**
     * Fetch all tasks ordered chronologically by task_date
     */
    public function getAllTasksOrdered()
    {
        return $this->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->findAll();
    }
}
