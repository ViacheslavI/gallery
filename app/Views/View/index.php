<div class=" ml-3">
    <div class="container">
        <div class="row">
            <?php foreach ($imagesUser as $item): ?>
                <div class="col-xs-2 mr-3 mb-3">
                    <img class="w-90 shadow-1-strong rounded mb-4 mt-2" src="<?= $item['file_name']; ?>" width="189"
                         height="255" alt="lorem"/><br>
                    <button class="btn btn-primary"><img width="25" src="/images/like.png"><?= $item['likes'] ?>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
