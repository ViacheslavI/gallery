<div class=" ml-3">
    <div class="container">
        <div class="row">

            <?php foreach ($objImage as $item): ?>
                <div class="col-xs-2 mr-5 mb-3">
                    <a href="/pages/<?= $item['id'] ?>">
                        <img class="w-90 shadow-1-strong rounded mb-4 mt-2" src="<?= $item['file_name']; ?>"
                             alt="lorem"/></a><br><span><?= $item['user']; ?> </span>
                    <button class="btn btn-primary like" value="<?= $item['likes'] . '/' . $item['id'] ?>"><img
                                width="25"
                                src="/images/like.png"><div id="lik"><?= ($item['likes'] != 0) ? $item['likes'] : ''; ?></div>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    $('.like').click(function () {
        value = $(this).val();
        splits = value.split('/');
        $.ajax({
            url: '/main/ajaxdata',
            type: 'post',
            data: {
                'likes': splits[0],
                'user_id': splits[1],
            },
            success: function (res) {
                tmp = JSON.parse(res)
                console.log(tmp.it[0]['likes']);
               sel= document.getElementById("lik")
            console.log($('div').attr('lik'))

                document.getElementById("lik").innerHTML = parseInt(tmp.it[0]['likes']);
            },

        });
    });
</script>
