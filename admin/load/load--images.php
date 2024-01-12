<?php
$sql = "SELECT * FROM page_tools WHERE page_id = :id ORDER BY item_order ASC";
$query = $PDO->prepare($sql);
$query->bindParam(':id', $pageId, PDO::PARAM_INT);
$query->execute();
$tools = $query->fetchAll();
?>
<?php foreach($tools as $tool): ?>
<div id="<?= $tool->tool_id ?>" class="image-container image-container-<?= $tool->tool_id ?>">
    <img src="upload/thumb/<?= $tool->tool_content ?>" alt="<?= $tool->tool_content ?>" width="300">
    <div class="image-actions">
        <button class="edit-btn" data-tool-id="<?= $tool->tool_id ?>">Éditer</button>
        <button class="delete-btn" data-tool-id="<?= $tool->tool_id ?>">Supprimer</button>
    </div>
</div>
<?php endforeach ?>
