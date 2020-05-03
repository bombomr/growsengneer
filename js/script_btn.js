function backPage(btnNo){
  if (btnNo == 1){
    link = "メニュー画面";
    href = "http://localhost:8000/main/adminMainMenue.php";
  } else if (btnNo == 2) {
    link = "ログイン画面"
    href = "http://localhost:8000/login/login.php";
  }else{
    //エラー
  }
  ret = confirm(link + "へ戻ります。宜しいですか？");
  if (ret == true){
    location.href = href;
  }
}
