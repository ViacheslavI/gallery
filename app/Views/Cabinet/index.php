<form action="/cabinet/index" method="POST" enctype="multipart/form-data">
    <div class="form-group w-50 ml-3">
        <label for="InputFile">Added Photo</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image">
                <label class="custom-file-label">Choice image</label>
            </div>
            <div class="input-group-append">
                <button type="submit" class="btn btn-success">Load</button>
            </div>
        </div>
    </div>
</form>
<div class="container ml-5">
    <h2 class="text-danger">If you press on the edge it will be removed</h2>
    <div class="column">
        <?php
        foreach ($urlimage as $image): ?>
            <a href="/delete/<?=$image['id']?>"> <img src="<?= $image['file_name']; ?>" width="189" height="255" alt="lorem"/></a>
        <?php endforeach; ?>

    </div>
</div>
