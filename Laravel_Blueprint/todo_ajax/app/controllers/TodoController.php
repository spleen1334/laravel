<?php
class TodoController extends BaseController
{
  // Aktivira restful methode
  public $restful = true;

  // Kao sto je Jeffry objasnio
  // Konvencija za restful domene (resorse)
  // NPR: tip http req = post
  // link = add
  // naziv method u kontroleru je onda: postAdd()


  // INDEX
  public function getIndex() {
    $todos = Todo::all();

    return View::make('index')
      ->with('todos', $todos);
  }

  // post sa /add adrese
  // js >> $ajax za add_task
  public function postAdd() {
    // Filter
    if(Request::ajax()) {

      $todo = new Todo();
      $todo->title = Input::get('title');
      $todo->save();

      // mysql_insert_id() -> poslednji insert row
      $last_todo = $todo->id;

      $todos = Todo::whereId($last_todo)->get();
      return View::make("ajaxData")
        ->with("todos", $todos);
    }
  }

  // post sa /update adrese
  // js >> $ajax za edit_task
  public function postUpdate($id) {
    // Filter
    if(Request::ajax()) {

      $task = Todo::find($id);
      $task->title = Input::get("title");
      $task->save();

      return "OK";
    }
  }

  public function getDelete($id) {
    if(Request::ajax()) {
      $todo = Todo::whereId($id)->first();
      $todo->delete();

      return "OK";
    }
  }


  public function getDone($id) {
    if(Request::ajax()) {
      $task = Todo::find($id);
      $task->status = 1;
      $task->save();

      return "OK";
    }
  }



}
