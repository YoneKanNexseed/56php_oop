$(function () {

  // 追加ボタンがクリックされた時
  $('#add-button').on('click', function(e) {
    // formタグの送信を無効化する（二重投稿を防ぐため）
    e.preventDefault();

    // 入力されたタスク名を取得
    let taskName = $('#input-task').val();

    // ajax開始
    $.ajax({
      // キー（決まった文言）：値
      url: 'create.php',
      type: 'POST',
      dataType: 'json',
      data: {
        // 送信する値を書くブロック
        task: taskName
      }
    }).done((data) => {
      console.log(data);

      // $('tbody').prepend(`<p>${data['name']}</p>`);
      $('tbody').prepend(
              `<tr>` + 
                `<td>${data['name']}</td>` + 
                `<td>${data['due_date']</td>`
                <td>NOT YET</td>
                <td>
                    <a class="text-success" href="edit.php?id=<?php echo h($task['id']); ?>">EDIT</a>
                </td>
                <td>
                    <a class="text-danger" href="delete.php?id=<?php echo h($task['id']); ?>">DELETE</a>
                </td>
              </tr>
      );


    }).fail((error) => {

    })


  });

})