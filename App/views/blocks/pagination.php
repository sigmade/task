<nav>
    <ul class="pagination justify-content-center">

        <? if($stack["first"]){?><li class="page-link"><a class="page-link" href="<? echo $paginationUrl.$stack["first"]; ?>">Previous</a></li><? } ?>
        <? if($stack["left"]) {
            foreach ($stack["left"] as $p_item) { ?>
            <li class="page-item"><a class="page-link" href="<? echo $paginationUrl.$p_item; ?>"><? echo $p_item; ?></a></li>
        <? }} ?>
            <li class="active"><span><? echo $stack["center"]; ?></span></li>
        <? if($stack["right"]) {
            foreach ($stack["right"] as $p_item) { ?>
                <li class="page-item"><a class="page-link" href="<? echo $paginationUrl.$p_item; ?>"><? echo $p_item; ?></a></li>
        <? }} ?>

        <? if($stack["last"] != $stack["center"]){?><li class="page-link"><a class="page-link" href="<? echo $paginationUrl.$stack["last"]; ?>">Next</a></li><? } ?>
    </ul>
</nav>