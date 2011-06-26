<h2>Register</h2>
                <div id="login-form">
                    <form action="/account/register" method="post">
                        <div style="margin: 0pt; padding: 0pt; display: inline;">
                            <input name="xtk" value="<?=@$this->xtk?>" type="hidden">
                        </div>
                        <input id="back_url" name="back_url" value="<?=@$this->backUrl?>" type="hidden">
                        <table>
                            <tbody>
                            <tr>
                                <td align="right">
                                    <label for="username">Login:</label></td>
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
                                <td align="right">
                                    <label for="password_repeat">Password (repeat):</label></td>
                                <td align="left">
                                    <input id="password_repeat" name="password_repeat" tabindex="3" type="password">
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                </td>
                                <td align="right">
                                    <input name="register" value="Register »" tabindex="5" type="submit">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>