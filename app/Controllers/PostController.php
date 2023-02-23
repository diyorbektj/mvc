<?php

namespace App\Controllers;

use App\Models\Posts;
use Core\Request;

class PostController
{
    public function index()
    {
        return json(Posts::all());
    }
    public function show($id)
    {
        return json(Posts::query()->find($id));
    }
    public function store()
    {
        $request = new Request();
        return json(Posts::query()->insert([
            'title' => $request->get('title'),
            'description' => $request->get('description')
        ]));
    }

    public function update($id)
    {
        $request = new Request();
        return json(Posts::query()->where('id', '=', $id)->update([
            'title' => $request->get('title'),
            'description' => $request->get('description')
        ]));
    }

    public function destroy($id)
    {
        return json(Posts::query()->where('id', '=', $id)->delete());
    }

}