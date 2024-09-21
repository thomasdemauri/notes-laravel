<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request) {

        // Validação de formulário, uma das formas de usar o validate
        // Guarda um conjunto de erros e volta para a rota de origem
        $request->validate([
            'text_username' => 'required|email',
            'text_password' => 'required|min:4|max:10'
        ],  
        [
            // Mensagens que serão exibidas
            'text_username.required' => 'O usuário é obrigatório.',
            'text_username.email'    => 'O usuário deve ser um email válido.',
            'text_password.required' => 'A senha é obrigatória.',
            'text_password.min'      => 'A senha deve conter no mínimo :min caracteres.',
            'text_password.max'      => 'A senha deve conter no máximo :max caracteres.',
            
        ]);

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // Check if users exists
        // Retorne o PRIMEIRO REGISTRO onde usuario é igual ao desejado e não foi excluído.
        $user = User::where('username', $username)->where('deleted_at', NULL)->first();

        // Se não tiver nenhum usuário
        if (!$user) {
            // Faça um redirecionamento para a localização anterior, com os inputs preenchidos conforme estavam
            // e adicione na sessão o erro 'login_error'
            return redirect()->back()->withInput()->with('login_error', 'Usuário ou senha incorretos.');
        }

        // Check if password is correct
        // password_verify é uma função nativa do PHP que na prática
        // identifica qual algoritmo de encriptação foi usado na senha já encriptada, no caso a que esta no banco de dados
        // e utiliza o mesmo algoritmo para encriptar a senha que deseja verificar, após isso, verifica se as duas são iguais
        // retorna falso caso não sejam
        if (!password_verify($password, $user->password)) {
            // Tudo isso poderia ser feito apenas num bloco, mas está aqui para mostrar o passo a passo mais detalhado.
            return redirect()->back()->withInput()->with('login_error', 'Usuário ou senha incorretos.');
        }


        // Update do last_login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // Colocar na sessão os dados do usuário logado
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        //$_SESSION['user']['id'];

        return 'Login com sucesso';
    }

    public function login() {
        return view('login');
    }

    public function logout() {
        // Logout da aplicação

        // Limpa da sessão as informações do usuário logado
        session()->forget('user');

        return redirect()->to('/login');
    }
}   
