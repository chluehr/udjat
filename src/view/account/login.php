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
                                </td>
                                <td align="right">
                                    <input name="login" value="Login »" tabindex="5" type="submit">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
