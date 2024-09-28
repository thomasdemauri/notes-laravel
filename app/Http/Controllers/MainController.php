<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index() 
    {

        $user_id = session('user.id');
        $notes = User::find($user_id)->notes()->whereNull('deleted_at')->get()->toArray();
        
        return view('home', ['notes' => $notes]);
    }

    // Mostra o formulário de criação
    public function create() 
    {
        return view('create_note');
    }

    // Armazena no banco de dados a nova nota
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:3000'
        ],  
        [
            // Mensagens que serão exibidas
            'text_title.required' => 'O título é obrigatório.',
            'text_title.min'      => 'O título deve conter no mínimo :min caracteres.',
            'text_title.max'      => 'O título deve conter no mínimo :max caracteres.',

            'text_note.required' => 'O texto é obrigatório.',
            'text_note.min'      => 'O texto deve conter no mínimo :min caracteres.',
            'text_note.max'      => 'O texto deve conter no máximo :max caracteres.',
            
        ]);

        $note = new Note();
        
        $id = session('user.id');
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
        // Save 



        // Return to home
    }

    // Mostra o formulário de edição
    public function edit($id) 
    {
        $id = Operations::decrypt($id);

        $note = Note::find($id);
        
        return view('edit_note', ['note' => $note]);
    }

    // Atualiza no banco de dados a nota
    public function update(Request $request)
    {
        // Valida
        $request->validate([
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:3000'
        ],  
        [
            // Mensagens que serão exibidas
            'text_title.required' => 'O título é obrigatório.',
            'text_title.min'      => 'O título deve conter no mínimo :min caracteres.',
            'text_title.max'      => 'O título deve conter no mínimo :max caracteres.',

            'text_note.required' => 'O texto é obrigatório.',
            'text_note.min'      => 'O texto deve conter no mínimo :min caracteres.',
            'text_note.max'      => 'O texto deve conter no máximo :max caracteres.',
            
        ]);

        
        // Obtem o id e descriptografa
        if (!$request->note_id) {
            return redirect()->route('home');
        }

        // Obtem a nota do banco de dados
        $id = Operations::decrypt($request->note_id);

        // Atualiza os dados
        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    } 

    public function delete($id) 
    {
        $id = Operations::decrypt($id);

        // Soft delete sem estar configurado no model;
        /* 
        $note = Note::find($id);
        $note->deleted_at = date('Y-m-d H:i:s');
        $note->save();
        */

        // Estando configurado no model fica como se fosse um delete normal
        $note = Note::find($id);
        $note->delete();

        // Caso queira um hard delete com o model estando configurado para softDelete
        // $note->forceDelete();

        
        return redirect()->route('home');
    }
}
