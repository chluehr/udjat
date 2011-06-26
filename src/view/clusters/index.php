<h2>Clusters</h2>

    <ul>
        <? FOREACH ($this->clusters as $clusterItem): ?>
        <li><a href="/dashboard/view/<?=$clusterItem['key']?>"><?=$clusterItem['label']?></a>
        <? ENDFOREACH; ?>
    </ul>

    