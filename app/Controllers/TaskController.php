<?php

namespace app\Controllers;

use app\Models\Task;
use app\Models\User;
use app\Models\View;
use http\Header;

class TaskController
{
    public function index()
    {
        $per_page = 3;
        $cur_page = 1;
        if (isset($_GET['page']) && $_GET['page'] > 0) {
            $cur_page = $_GET['page'];
        }
        $start = ($cur_page - 1) * $per_page;
        //$tasks = Task::offset($start)->limit($per_page)->orderBy()->get();
        $tasks = Task::offset($start)->limit($per_page)->get();
        $count = Task::all()->count();
        $num_pages = ceil($count / $per_page);
        $page = 1;


        $this->sorting();
        $params = $_GET;
        echo View::render(['title' => 'BeeJee Index', 'method_view' => 'task/index', 'method_data' => ['tasks' => $tasks,
            'page' => $page, 'num_pages' => $num_pages, 'cur_page' => $cur_page, 'params' => $params]]);
    }

    private function sorting()
    {
        $params = $_GET;
        $pattern_login = "/^[A-z0-9]+$/";
        if (!empty($params['sort'])) {
            $sortname = $params['sort'];
            $field = mb_strstr($sortname, $pattern_login);
            var_dump($field);
        }
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $statuses = [
            'ready' => 'Выполнена',
            'in_process' => 'В процессе'
        ];
        echo View::render(['title' => 'Task #' . $task->id, 'method_view' => 'task/show', 'method_data' => ['task' => $task, 'statuses' => $statuses]]);
    }

    public function edit($id = null)
    {
        $task = Task::find($id);
        $post = $_POST;
        if ($task == null) {
            $title = 'Add new task';
        } else {
            $title = 'Edit task #' . $task->id;
        }
        if (!empty($post) && $task == null) {
            $task = new Task();
            $task->text = htmlspecialchars(trim($post['text']));
            $task->username = htmlspecialchars(trim($post['username']));
            $task->email = htmlspecialchars(trim($post['email']));
            $task->status = 'in_process';
            $task->is_edited = 0;
            if ($task->save()) {
                $_SESSION['success'] = true;
                header('Location: /');
            }
        } elseif (!empty($post) && User::isAdmin()) {
            $task->is_edited = (htmlspecialchars(trim($post['text'])) != $task->text) ? 1 : 0;
            $task->text = htmlspecialchars(trim($post['text']));
            $task->username = htmlspecialchars(trim($post['username']));
            $task->email = htmlspecialchars(trim($post['email']));
            $task->status = htmlspecialchars(trim($post['status'])) ?? 'in_process';
            if ($task->save()) {
                $_SESSION['success'] = true;
                header('Location: /');
            }
        } elseif (!empty($post) && !User::isAdmin()) {
            header("Location: /login");
        }
        $statuses = [
            'ready' => 'Выполнена',
            'in_process' => 'В процессе'
        ];
        echo View::render(['title' => $title, 'method_view' => 'task/form', 'method_data' => ['task' => $task, 'statuses' => $statuses]]);
    }

    public function add()
    {
        $task = new Task();
        $statuses = [
            'in_process' => 'В процессе',
            'ready' => 'Выполнена'
        ];
        echo View::render(['title' => 'Add new task', 'method_view' => 'task/form', 'method_data' => ['task' => $task, 'statuses' => $statuses]]);
    }
}
