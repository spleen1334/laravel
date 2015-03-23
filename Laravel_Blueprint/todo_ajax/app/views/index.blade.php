<html>
<head>
<title>To-do List Application</title>
<!-- <link rel="stylesheet" href="assets/css/style.css"> -->
<!--[if lt IE 9]><script
src="//html5shim.googlecode.com/svn/trunk/html5.js">
</script><![endif]-->
</head>
<body>
<!-- GLAVNA SEKCIJA -->
<div class="container">
  <section id="data_section" class="todo">
    <ul class="todo-controls">
      <li><img src="/assets/img/add.png" width="14px"
      onClick="show_form('add_task');" />ADD</li>
    </ul>


    <!-- TODO STAvKE -->
    <ul id="task_list" class="todo-list">
      @foreach($todos as $todo)

          <!-- TODO STATUS(da li je checkirano) -->
        @if($todo->status)
        <li id="{{$todo->id}}" class="done">
          <a href="#" class="toggle">
          <span id="span_{{$todo->id}}">{{$todo->title}}</span></a>
          <a href="#" onClick="delete_task('{{$todo->id}}');"
          class="icon-delete">Delete</a>
           <a href="#"
          onClick="edit_task('{{$todo->id}}', '{{$todo->title}}');" class="icon-edit">Edit</a></li>
        @else
        <li id="{{$todo->id}}"><a href="#"
        onClick="task_done('{{$todo->id}}');"
        class="toggle"><span id="span_{{$todo->id}}">{{$todo->title}}</span></a>
        <a href="#" onClick="delete_task('{{$todo->id}}');" class="icon-delete">Delete</a>
        <a href="#" onClick="edit_task('{{$todo->id}}','{{$todo->title}}');"
        class="icon-edit">Edit</a></li>
        @endif
      @endforeach
    </ul>
  </section>

  <!-- ADD,EDIT TODO -->
  <section id="form_section">
      <form id="add_task" class="todo"
      style="display:none">
      <input id="task_title" type="text" name="title"
      placeholder="Enter a task name" value=""/>
      <button name="submit">Add Task</button>
      </form>
      <form id="edit_task" class="todo"
      style="display:none">
      <input id="edit_task_id" type="hidden" value="" />
      <input id="edit_task_title" type="text"
      name="title" value="" />
      <button name="submit">Edit Task</button>
      </form>
    </section>
      </div>

      <!-- JAVASCRIPT -->
      <script src="//code.jquery.com/jquery-1.11.0.min.js"type="text/javascript"></script>
      <script src="assets/js/todo.js"
    type="text/javascript"></script>
</body>
</html>
