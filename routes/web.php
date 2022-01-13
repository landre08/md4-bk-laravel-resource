<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Criando rotas com resource, onde 1 parâmetro é o prefixo e o segundo o nome do controller.
Route::resource('todo', 'TodoController');
// Código acima cria automaticamente as seguinte rotas, inclusive com o name da rota:
/*
Método http  - rota - Método Controller - Descrição

GET - /todo - index - todo.index - Lista os Itens
GET - /todo/create - create - todo.create - Form de Criação
POST - /todo - store - todo.store - Receber os Dados e ADD Item
GET - /todo/{id} - show - todo.show p Item Individual
GET - /todo/{id}/edit - edit - todo.edit - Form edição
PUT - /todo/{id} - update - todo.update - Receber os Dados e Update Item
DELETE - /todo/{id} - destroy - todo.destroy - Deletar o Item
*/

// O middleware estão entre a rota e a aplicação, com ela posso interceptar a requisição
// Um middleware padrão de autenticação é o auth, só de colocar ele eu protejo a rota de acesso a quem não está logado
// Ele verifica se não tiver logado jogar para ROTA de login. Esse middlware precisa ter uma rota de /login criada:
// Cai aqui se não tiver logado
Route::get('/login', function() {
    echo "Não está logado quando usou a rota protegido";
})->name('login');
// Aqui verificar
Route::get('/protegido', 'TodoController@proteger')->name('proteger')->middleware('auth');

Route::prefix('/tarefas')->group(function() {
    
    Route::get('/', 'TarefaController@list')->name('tarefas.list'); // Listagem de tarefas

    Route::get('add', 'TarefaController@add')->name('tarefas.add'); // Tela de adição
    Route::post('add', 'TarefaController@addAction'); // Ação de adição

    Route::get('edit/{id}', 'TarefaController@edit')->name('tarefas.edit'); // Tela de edição
    Route::post('edit/{id}', 'TarefaController@editAction'); // Ação de edição

    Route::get('delete/{id}', 'TarefaController@del')->name('tarefas.del'); // Ação de deletar

    Route::get('marcar/{id}', 'TarefaController@done')->name('tarefas.done'); // Marcar resolvido/não.
});
