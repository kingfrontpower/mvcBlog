<h5>按連結後重設您的密碼:</h5>
<a href="{{ $link = url("password/reset/".$token."?email=".$user->getEmailForPasswordReset()) }}" >{{ $link }}<br /></a>