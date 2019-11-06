// HTMLが読み込まれたら、カッコの中を実行
// $(function {
// HTML読み込みが終わったらここが実行される
// })

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
                `<td>${data['due_date']}</td>` + 
                `<td>NOT YET</td>` + 
                `<td>` + 
                    `<a class="text-success" href="edit.php?id=${data['id']}">EDIT</a>` + 
                `</td>` +
                `<td>` +
                    `<a class="text-danger delete-button" href="delete.php?id=${data['id']}">DELETE</a>` + 
                `</td>` +
              `</tr>`
      );

    }).fail((error) => {
      console.log(error);
    })
  });

  // 削除のボタンがクリックされたときの処理
  // $('.delete-button').on('click', function(e){
  $(document).on('click', '.delete-button', function(e) {

    // 二重送信の無効化
    e.preventDefault();

    // 削除対象のIDを取得
    let selectedId = $(this).data('id');
    alert(selectedId);

    // ajax開始

  });

});