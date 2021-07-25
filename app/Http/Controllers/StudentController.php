<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
// chamar o response do Http **
use Illuminate\Http\Response;
// caso nao queira usar os numeros dos codigos de respostas, pode usar uma classe padrao q tem constantes com cada um dos codigos
// use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Student as StudentResources;
use App\Http\Resources\Students as StudentCollection;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) // se colocarmos o response da classe q la em cima do Http **, passamos o parametro Response $response
    {
        // return $request->query('includes');
        // return Student::get();

        // podemos ter uma resposta personalizada, usando o setContent e dentro dela colocar a classe, mudar o tipo de retorno, colocar o codigo, o header e etc
        // return $response->setContent(Student::get()->toJson())
        // ->setStatusCode(200)
        // ->header('Content-Type', 'application/json');

        // caso nao queira usar a forma acima, podemos fazer usando um helper do laravel, sem precisar chamar a classe do http **
        // return response(Student::get(), 200)
        // ->header('Content-Type', 'application/json');

        // ou caso nao queira modificar o header manualmente, no proprio helper tem um metodo para o retorno, pesquisar

        // podemos mostrar ou esconder campos na serializacao local, msm q na global esteja outra regra
        // return response()->json(Student::get()->makeHidden('gerder'), Response::HTTP_OK);

        // return response()->json(
        //     new StudentCollection(Student::with('classroom')->paginate(1)),
        //     Response::HTTP_OK
        // );

        // para que o conteudo retorne os dados padroes de paginacao do laravel retire o response formatado
        return new StudentCollection(Student::with('classroom')->paginate(1));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        // try {
        //     return Student::create($request->all());
        // } catch (\Throwable $e) {
        //     return response()->json([
        //         'message' => $e->getMessage()
        //     ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        // criando um tratamento de erro para o outro tipo, o 500 (erro interno) podemos remover o tratamento de erro do controller e deixar por conta do laravel, porem ainda precisa ser melhorando para uma precisão de tipo de erro

        return Student::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Student $student)
    {
        return new StudentResources($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        // try {
        //     $student->update($request->all());
        //     return [];
        // } catch (\Throwable $e) {
        //     return response()->json([
        //         'message' => $e->getMessage()
        //     ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        $student->update($request->all());
        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // try {
        //     $student->delete();
        //     return [];
        // } catch (\Throwable $e) {
        //     return response()->json([
        //         'message' => $e->getMessage()
        //     ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        $student->delete();
        return [];
    }
}
