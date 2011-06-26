<h1>Setup</h1>

    <ul>
        <li><a href="/auth/logout">logout</a></li>
        <li><a href="/setup">Setup</a></li>
    </ul>

    <table>
        <tr>
            <th>Host</th>
            <th>Metric</th>
        </tr>
        <? FOREACH ($this->metrics as $metric): ?>
        <tr>
            <td><?=$metric['host']?></td>
            <td><?=$metric['metric']?></td>
        </tr>
        <? ENDFOREACH; ?>
    </table>