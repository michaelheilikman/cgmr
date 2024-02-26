<?php
$sql = "SELECT * FROM page_tools WHERE page_id = :id ORDER BY item_order ASC";
$query = $PDO->prepare($sql);
$query->bindParam(':id', $pageId, PDO::PARAM_INT);
$query->execute();
$tools = $query->fetchAll();
?>
<?php foreach($tools as $tool): ?>

<?php if($tool->tool_type == 'image'): ?>
<div id="<?= $tool->tool_id ?>" class="image-container image-container-<?= $tool->tool_id ?>">
    <img src="upload/thumb/<?= $tool->tool_content ?>" alt="<?= $tool->tool_content ?>" width="300">
    <div class="image-actions">
        <button class="edit-btn" data-tool-id="<?= $tool->tool_id ?>">Éditer</button>
        <button class="delete-btn" data-tool-id="<?= $tool->tool_id ?>">Supprimer</button>
    </div>
</div>
<?php elseif($tool->tool_type == 'two-columns'): ?>
    <div id="<?= $tool->tool_id ?>" class="two-columns-module bg-light mb-4 d-block" style="width:300px;height:300px;" data-tool-type="two-columns">
        <div class="column" data-column="1">
            <button class="add-image-btn" data-column="1">Ajouter une Image</button>
        </div>
        <div class="column" data-column="2">
            <button class="add-image-btn" data-column="2">Ajouter une Image</button>
        </div>
    </div>
<?php endif ?>
<?php endforeach ?>
