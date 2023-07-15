<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Infrastructure\Repositories;

use App\Models\ToDo as EloquentToDoModel;
use Illuminate\Support\Facades\Auth;
use Src\TodoApi\ToDo\Domain\Contracts\ToDoRepositoryContract;
use Src\TodoApi\ToDo\Domain\ToDo;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoId;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoUserId;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoName;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoDescription;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoStatus;

use Illuminate\Support\Facades\DB;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoCategories;
use Src\Shared\Functions;

//use Src\TodoApi\ToDo\Infrastructure\Exceptions\ToDoUnaunthenticatedException;

final class EloquentToDoRepository implements ToDoRepositoryContract
{
    private $eloquentToDoModel;

    public function __construct()
    {
        $this->eloquentToDoModel = new EloquentToDoModel;
    }

    public function find(ToDoId $id): ?string
    {
        //$ToDo = $this->eloquentToDoModel->findOrFail($id->value());
        $ToDo=
        DB::select(
                "SELECT  categories.name as category, categories.id as category_id, to_dos.id,to_dos.user_id,to_dos.name,to_dos.description,to_dos.status 
                FROM to_dos 
                LEFT JOIN 
                    (SELECT to_dos.id,to_dos.name, to_dos.description,to_dos.status, to_dos_categories.category_id cid 
                    FROM to_dos left join to_dos_categories ON to_dos.id=to_dos_categories.to_do_id 
                    WHERE to_dos_categories.category_id IS NOT NULL) 
                AS c2 ON to_dos.id=c2.id and c2.status IS NOT NULL LEFT JOIN categories ON c2.cid=categories.id
                WHERE to_dos.id= :toDoId
                "
            ,array(
                'toDoId'=>$id->value()
        ));
        
        //convert stdClass to Array
        $ToDo=array_map(function ($value) {
            return (array)$value;
        }, $ToDo);
        
        $ToDo=Functions::reorganise_duplicate_categories_array($ToDo);
        
        return json_encode($ToDo);
    }

    public function findAllByUser(): ?string
    {
        /** SIN CATEGORIAS */
        /*$ToDos = $this->eloquentToDoModel
            ->where('user_id', Auth::id())
            ->get()
            ->toArray();*/

        
        /** CON CATEGORIAS */
        $ToDos=
        DB::select(
            "SELECT to_dos.id,to_dos.user_id,to_dos.name,to_dos.description,to_dos.status, categories.name as category, categories.id as category_id
            FROM to_dos 
            LEFT JOIN 
                (SELECT to_dos.id,to_dos.name, to_dos.description,to_dos.status, to_dos_categories.category_id cid
                FROM to_dos left join to_dos_categories ON to_dos.id=to_dos_categories.to_do_id 
                WHERE to_dos_categories.category_id IS NOT NULL) 
            AS c2 ON to_dos.id=c2.id and c2.status IS NOT NULL LEFT JOIN categories ON c2.cid=categories.id
            INNER JOIN users ON users.id = to_dos.user_id WHERE users.id= :user_id
            "
            ,array(
                'user_id'=>Auth::id()
        ));
        
        //convert stdClass to Array
        $ToDos=array_map(function ($value) {
            return (array)$value;
        }, $ToDos);

        error_log(json_encode($ToDos));

        $ToDos=Functions::reorganise_duplicate_categories_array($ToDos);
       
        return json_encode($ToDos);
    }

    public function save(ToDo $ToDo): int
    {
        //$newToDo = $this->eloquentToDoModel;

        $data = [
            'user_id'         => $ToDo->user_id()->value(),
            'name'            => $ToDo->name()->value(),
            'description'     => $ToDo->description()->value(),
            'status'          => $ToDo->status()->value()
        ];
        
        $toDoId=DB::table('to_dos')->insertGetId($data,'id');
       
        //Si viene con categorias
        if ($ToDo->categories()->value() !== null) {

           /** OPTIMIZED */
           $sqlInsert='INSERT INTO to_dos_categories (to_do_id,category_id) VALUES ';

           foreach ($ToDo->categories()->value() as $cat) {
               $sqlInsert.="( ".$toDoId." , ".$cat." )," ;
           }
           $sqlInsert=substr_replace($sqlInsert,"",-1);
           DB::insert($sqlInsert);
           /** END QUERY OPTIMIZED */
        }

        return $toDoId;
        
    }

    public function update(ToDoId $id, ToDo $ToDo): ?string
    {
        $ToDoToUpdate = $this->eloquentToDoModel;
        //$id=$id->value();

        $data = [
            'name'            => $ToDo->name()->value(),
            'description'     => $ToDo->description()->value(),
            'status'          => ($ToDo->status()->value() !== '') ? $ToDo->status()->value() : 'pending'
        ];

        if (  $ToDo->categories()->value() !== null ) {
            
            $deleteSql='DELETE FROM to_dos_categories WHERE to_do_id = ?';
            DB::delete($deleteSql,[$id->value()]);

            $sqlInsert='INSERT INTO to_dos_categories (to_do_id,category_id) VALUES ';

            foreach ($ToDo->categories()->value() as $cat) {
               $sqlInsert.="( ".$id->value()." , ".$cat." )," ;
            }
            $sqlInsert=substr_replace($sqlInsert,"",-1);
            DB::insert($sqlInsert);

        }

        $ToDoToUpdate
            ->findOrFail($id->value())
            ->update($data);

        return $this->find($id);
        
    }

    public function delete(ToDoId $id): void
    {
        $deleteSql="DELETE FROM to_dos_categories WHERE to_do_id = ?";
        DB::delete($deleteSql,[$id->value()]);

        $this->eloquentToDoModel
            ->findOrFail($id->value())
            ->delete();
    }
}
