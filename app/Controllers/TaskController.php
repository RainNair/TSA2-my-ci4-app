<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class TaskController extends BaseController
{
    protected $taskModel;
    protected $userModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
        $this->userModel = new UserModel();
    }

    // Welcome Page (/) - Displays only today's tasks
    public function welcome()
    {
        $data = [
            'page_title' => "Today's Tasks Dashboard",
            'tasks'      => $this->taskModel->getTodayTasks(),
            'today'      => date('F j, Y')
        ];
        return view('TS2/welcome_page', $data);
    }

    // Task List (/tasks) - Displays all tasks ordered by date
    public function index()
    {
        $data = [
            'page_title' => 'All Tasks',
            'tasks'      => $this->taskModel->getAllTasksOrdered()
        ];
        return view('TS2/tasks_index', $data);
    }

    public function newTask()
    {
        return view('TS2/task_form', [
            'page_title' => 'New Task',
            'task'      => null,
            'action'    => site_url('tasks'),
        ]);
    }

    public function create()
    {
        $rules = [
            'title'     => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status'    => 'permit_empty|in_list[pending,in_progress,completed]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->insert([
            'title'       => trim((string) $this->request->getPost('title')),
            'status'      => $this->request->getPost('status') ?: 'pending',
            'task_date'   => $this->request->getPost('task_date'),
            'created_at'  => date('Y-m-d H:i:s'),
            'is_archived' => 0,
        ]);

        return redirect()->to(site_url('tasks'))->with('success', 'Task created successfully.');
    }

    public function edit(int $id)
    {
        $task = $this->taskModel->where('is_archived', 0)->find($id);
        if (! $task) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Task not found.');
        }

        return view('TS2/task_form', [
            'page_title' => 'Edit Task',
            'task'      => $task,
            'action'    => site_url('tasks/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $task = $this->taskModel->where('is_archived', 0)->find($id);
        if (! $task) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Task not found.');
        }

        $rules = [
            'title'     => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status'    => 'permit_empty|in_list[pending,in_progress,completed]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->update($id, [
            'title'     => trim((string) $this->request->getPost('title')),
            'status'    => $this->request->getPost('status') ?: 'pending',
            'task_date' => $this->request->getPost('task_date'),
        ]);

        return redirect()->to(site_url('tasks'))->with('success', 'Task updated successfully.');
    }

    public function delete(int $id)
    {
        $task = $this->taskModel->where('is_archived', 0)->find($id);
        if (! $task) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Task not found.');
        }

        $this->taskModel->update($id, ['is_archived' => 1]);
        return redirect()->to(site_url('tasks'))->with('success', 'Task archived successfully.');
    }

    // Profile Page (/profile) - Displays single demo user info
    public function profile()
    {
        $data = [
            'page_title' => 'User Profile',
            'user'       => $this->userModel->getDemoUser()
        ];
        return view('TS2/profile', $data);
    }

    // About Page (/about) - Static page identifying developer
    public function about()
    {
        $data = [
            'page_title' => 'About the Developer',
            'developer'  => [
                'name'    => 'Rainier Louis Espino',
                'section' => 'AC-31',
                'course'  => 'IT0049 - Web System Technologies'
            ]
        ];
        return view('TS2/about', $data);
    }
}
