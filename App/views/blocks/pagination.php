<nav>
    <ul class="pagination justify-content-center">

        <? if($stack["first"]){?><li class="page-link"><a class="page-link" href="<? echo $paginationUrl.$stack["first"]; ?>">Previous</a></li><? } ?>
        <? if($stack["first"] as) { ?>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>