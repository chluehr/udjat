<h2>Sign in</h2>
                <div id="login-form">
                    <form action="/account/login" method="post">
                        <div style="margin: 0pt; padding: 0pt; display: inline;">
                            <input name="xtk" value="<?=@$this->xtk?>" type="hidden">
                        </div>
                        <input id="back_url" name="back_url" value="<?=@$this->backUrl?>" type="hidden">
                        <table>
                            <tbody>
                            <tr>
                                <td align="right">
                                    <label for="username">Login (email):</label></td>
                                <td align="left">
                                    <input id="username" name="email" tabindex="1" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <label for="password">Password:</label></td>
                                <td align="left">
                                    <input id="password" name="password" tabindex="2" type="password">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="left">
                                    <label for="autologin"><input id="autologin" name="autologin" tabindex="4" value="1" type="checkbox"> Stay logged in</label>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <a href="/account/lostpassword">Lost password</a>
                                    <a class="rpxnow" onclick="return false;" href="https://monitoringrocks.rpxnow.com/openid/v2/signin?token_url=http%3A%2F%2Fudjat.local.basilicom.de%2Frpx%2Ftoken">Social Sign In</a>
                                </td>
                                <td align="right">
                                    <input name="login" value="Login »" tabindex="5" type="submit">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>


<script type="text/javascript">
  var rpxJsHost = (("https:" == document.location.protocol) ? "https://" : "http://static.");
  document.write(unescape("%3Cscript src='" + rpxJsHost +
"rpxnow.com/js/lib/rpx.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
  RPXNOW.overlay = true;
  RPXNOW.language_preference = 'en';
</script>